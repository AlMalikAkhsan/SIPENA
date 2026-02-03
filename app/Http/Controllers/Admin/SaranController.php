<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saran;
use Illuminate\Support\Facades\DB;

class SaranController extends Controller
{
    /**
     * Tampilkan semua saran dari warga
     */
    public function index(Request $request)
    {
        $query = Saran::with('user');
        
        // Filter search
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
        
        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Sorting
        if ($request->sort == 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }
        
        $saran = $query->paginate(15)->withQueryString();
        
        // Statistik
        $total = Saran::count();
        $menunggu = Saran::where('status', 'menunggu')->count();
        $dibaca = Saran::where('status', 'dibaca')->count();
        $ditinjau = Saran::where('status', 'ditinjau')->count();
        $diterapkan = Saran::where('status', 'diterapkan')->count();
        $ditolak = Saran::where('status', 'ditolak')->count();
        
        return view('admin.saran.index', compact(
            'saran',
            'total',
            'menunggu',
            'dibaca',
            'ditinjau',
            'diterapkan',
            'ditolak'
        ));
    }

    /**
     * Tampilkan detail saran
     */
    public function show($id)
    {
        $saran = Saran::with('user')->findOrFail($id);
        
        // Update status menjadi dibaca jika masih menunggu
        if ($saran->status === 'menunggu') {
            $saran->update(['status' => 'dibaca']);
        }
        
        return view('admin.saran.show', compact('saran'));
    }

    /**
     * Update status saran
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dibaca,ditinjau,diterapkan,ditolak'
        ]);

        $saran = Saran::findOrFail($id);
        
        $saran->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.saran.show', $id)
            ->with('success', 'Status saran berhasil diperbarui.');
    }

    /**
     * Berikan tanggapan pada saran
     */
    public function tanggapi(Request $request, $id)
    {
        $request->validate([
            'tanggapan_admin' => 'required|string|min:10|max:2000',
            'status' => 'required|in:ditinjau,diterapkan,ditolak'
        ], [
            'tanggapan_admin.required' => 'Tanggapan wajib diisi',
            'tanggapan_admin.min' => 'Tanggapan minimal 10 karakter',
            'tanggapan_admin.max' => 'Tanggapan maksimal 2000 karakter',
            'status.required' => 'Status harus dipilih'
        ]);

        $saran = Saran::findOrFail($id);
        
        $saran->update([
            'status' => $request->status,
            'tanggapan_admin' => $request->tanggapan_admin,
            'tanggapan_at' => now()
        ]);

        return redirect()->route('admin.saran.show', $id)
            ->with('success', 'Tanggapan berhasil dikirim ke user.');
    }

    /**
     * Hapus saran
     */
    public function destroy($id)
    {
        $saran = Saran::findOrFail($id);
        $saran->delete();

        return redirect()->route('admin.saran.index')
            ->with('success', 'Saran berhasil dihapus.');
    }
}