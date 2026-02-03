<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Tampilkan semua laporan dengan filter dan search
     */
    public function index(Request $request)
    {
        $query = Laporan::with('user');
        
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('judul', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('isi', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                      $userQuery->where('name', 'LIKE', "%{$searchTerm}%");
                  });
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
        
        $laporan = $query->paginate(15)->withQueryString();
        
        return view('admin.laporan.index', compact('laporan'));
    }

    /**
     * Tampilkan detail laporan dengan tanggapan
     */
    public function show($id)
    {
        $laporan = Laporan::with(['user', 'tanggapans.user'])
                    ->findOrFail($id);
        
        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Update status laporan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai'
        ], [
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid'
        ]);

        $laporan = Laporan::findOrFail($id);
        
        $laporan->update([
            'status' => $request->status,
            'alasan_penolakan' => null // Reset alasan jika status berubah
        ]);

        return redirect()->route('admin.laporan.show', $id)
            ->with('success', 'Status laporan berhasil diperbarui menjadi ' . ucfirst($request->status));
    }

    /**
     * ⭐ TAMBAHKAN METHOD REJECT INI
     * Tolak laporan dengan alasan
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10|max:1000'
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi',
            'alasan_penolakan.min' => 'Alasan penolakan minimal 10 karakter',
            'alasan_penolakan.max' => 'Alasan penolakan maksimal 1000 karakter'
        ]);

        DB::beginTransaction();
        try {
            $laporan = Laporan::findOrFail($id);
            
            // Update status dan alasan
            $laporan->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan
            ]);

            // Buat tanggapan otomatis dari admin
            Tanggapan::create([
                'laporan_id' => $laporan->id,
                'user_id' => auth()->id(),
                'isi' => "⚠️ LAPORAN DITOLAK\n\n" . $request->alasan_penolakan . "\n\nSilakan perbaiki laporan Anda dan kirim kembali dengan informasi yang lebih lengkap dan sesuai."
            ]);

            DB::commit();

            return redirect()->route('admin.laporan.show', $id)
                ->with('success', 'Laporan berhasil ditolak dan notifikasi telah dikirim ke user.');
                
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menolak laporan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus laporan
     */
    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        
        if ($laporan->foto && \Storage::disk('public')->exists($laporan->foto)) {
            \Storage::disk('public')->delete($laporan->foto);
        }
        
        $laporan->delete();

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan dan semua tanggapan terkait berhasil dihapus.');
    }
}