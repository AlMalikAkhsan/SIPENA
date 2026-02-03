<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\LaporanFoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Tampilkan laporan milik user yang login (dengan filter & search)
     */
    public function index(Request $request)
    {
        $query = Laporan::where('user_id', Auth::id());
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('isi', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $query->orderBy('created_at', 'desc');
        
        $laporan = $query->paginate(9)->withQueryString();

        return view('warga.laporan.index', compact('laporan'));
    }

    /**
     * Form create laporan baru
     */
    public function create()
    {
        return view('warga.laporan.create');
    }

    /**
     * Simpan laporan baru dengan multiple foto
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required|min:20',
            'fotos.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120', // Max 5MB per foto
            'lokasi' => 'nullable|string|max:255'
        ], [
            'judul.required' => 'Judul laporan harus diisi',
            'judul.max' => 'Judul maksimal 255 karakter',
            'isi.required' => 'Isi laporan harus diisi',
            'isi.min' => 'Isi laporan minimal 20 karakter',
            'fotos.*.image' => 'File harus berupa gambar',
            'fotos.*.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'fotos.*.max' => 'Ukuran gambar maksimal 5MB'
        ]);

        DB::beginTransaction();
        try {
            // Simpan laporan
            $laporan = Laporan::create([
                'user_id' => Auth::id(),
                'judul' => $request->judul,
                'isi' => $request->isi,
                'lokasi' => $request->lokasi,
                'status' => 'menunggu'
            ]);

            // Simpan multiple foto jika ada
            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $index => $foto) {
                    $fotoPath = $foto->store('laporan', 'public');
                    
                    LaporanFoto::create([
                        'laporan_id' => $laporan->id,
                        'foto_path' => $fotoPath,
                        'urutan' => $index + 1
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('warga.laporan.index')
                ->with('success', 'Laporan berhasil dikirim dan sedang menunggu verifikasi.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Detail laporan milik user
     */
    public function show($id)
    {
        $laporan = Laporan::with('fotos')
                    ->where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('warga.laporan.show', compact('laporan'));
    }

    /**
     * Form edit laporan
     */
    public function edit($id)
    {
        $laporan = Laporan::with('fotos')
                    ->where('id', $id)
                    ->where('user_id', Auth::id())
                    ->where('status', 'menunggu')
                    ->firstOrFail();

        return view('warga.laporan.edit', compact('laporan'));
    }

    /**
     * Update laporan dengan multiple foto
     */
    public function update(Request $request, $id)
    {
        $laporan = Laporan::with('fotos')
                    ->where('id', $id)
                    ->where('user_id', Auth::id())
                    ->where('status', 'menunggu')
                    ->firstOrFail();

        $request->validate([
            'judul' => 'required|max:255',
            'isi' => 'required|min:20',
            'fotos.*' => 'nullable|image|mimes:jpeg,jpg,png|max:5120',
            'lokasi' => 'nullable|string|max:255',
            'hapus_foto' => 'nullable|array'
        ], [
            'judul.required' => 'Judul laporan harus diisi',
            'isi.required' => 'Isi laporan harus diisi',
            'isi.min' => 'Isi laporan minimal 20 karakter',
            'fotos.*.image' => 'File harus berupa gambar',
            'fotos.*.mimes' => 'Format gambar harus jpeg, jpg, atau png',
            'fotos.*.max' => 'Ukuran gambar maksimal 5MB'
        ]);

        DB::beginTransaction();
        try {
            // Update data laporan
            $laporan->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'lokasi' => $request->lokasi,
            ]);

            // Hapus foto yang dipilih untuk dihapus
            if ($request->has('hapus_foto')) {
                foreach ($request->hapus_foto as $fotoId) {
                    $foto = LaporanFoto::where('id', $fotoId)
                                      ->where('laporan_id', $laporan->id)
                                      ->first();
                    if ($foto) {
                        Storage::disk('public')->delete($foto->foto_path);
                        $foto->delete();
                    }
                }
            }

            // Upload foto baru jika ada
            if ($request->hasFile('fotos')) {
                $urutanTerakhir = $laporan->fotos()->max('urutan') ?? 0;
                
                foreach ($request->file('fotos') as $index => $foto) {
                    $fotoPath = $foto->store('laporan', 'public');
                    
                    LaporanFoto::create([
                        'laporan_id' => $laporan->id,
                        'foto_path' => $fotoPath,
                        'urutan' => $urutanTerakhir + $index + 1
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('warga.laporan.index')
                ->with('success', 'Laporan berhasil diperbarui.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::with('fotos')
                    ->where('id', $id)
                    ->where('user_id', Auth::id())
                    ->where('status', 'menunggu')
                    ->firstOrFail();

        DB::beginTransaction();
        try {
            // Hapus semua foto
            foreach ($laporan->fotos as $foto) {
                Storage::disk('public')->delete($foto->foto_path);
            }

            // Hapus foto lama jika ada
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }

            $laporan->delete();

            DB::commit();

            return redirect()->route('warga.laporan.index')
                ->with('success', 'Laporan berhasil dihapus.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // ========================
    // JAKI MODE (PUBLIK)
    // ========================

    /**
     * Tampilkan semua laporan dari semua warga
     */
    public function semua(Request $request)
    {
        $query = Laporan::with('user', 'fotos');
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('isi', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->sort == 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }
        
        $laporan = $query->paginate(9)->withQueryString();
        
        $total = Laporan::count();
        $menunggu = Laporan::where('status', 'menunggu')->count();
        $diproses = Laporan::where('status', 'diproses')->count();
        $selesai = Laporan::where('status', 'selesai')->count();
        
        return view('warga.laporan.semua', compact(
            'laporan',
            'total',
            'menunggu',
            'diproses',
            'selesai'
        ));
    }

    /**
     * Detail laporan umum
     */
    public function detailUmum($id)
    {
        $laporan = Laporan::with('user', 'fotos')->findOrFail($id);
        
        return view('warga.laporan.detail_umum', compact('laporan'));
    }

    public function riwayat()
{
    $laporan = Laporan::where('user_id', Auth::id())
                ->archived()
                ->latest('archived_at')
                ->paginate(10);

    return view('warga.laporan.riwayat', compact('laporan'));
}

public function archive($id)
{
    $laporan = Laporan::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    $laporan->archive();

    return redirect()->route('warga.laporan.index')
        ->with('success', 'Laporan berhasil diarsipkan.');
}

public function unarchive($id)
{
    $laporan = Laporan::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    $laporan->unarchive();

    return redirect()->route('warga.laporan.riwayat')
        ->with('success', 'Laporan berhasil dikembalikan dari arsip.');
}
}