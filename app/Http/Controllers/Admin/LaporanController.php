<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Tanggapan;
use App\Models\Notification;
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
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('isi', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $query->when($request->sort === 'terlama', fn ($q) => $q->oldest(), fn ($q) => $q->latest());

        $laporan = $query->paginate(15)->withQueryString();

        return view('admin.laporan.index', compact('laporan'));
    }

    /**
     * Detail laporan
     */
    public function show($id)
    {
        $laporan = Laporan::with(['user', 'tanggapans.user'])->findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Update status laporan + notifikasi
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => $request->status]);

        Notification::create([
            'user_id' => $laporan->user_id,
            'judul'   => 'Status Laporan Diperbarui',
            'pesan'   => 'Laporan Anda kini berstatus: ' . ucfirst($laporan->status),
            'tipe'    => 'laporan',
            'link'    => route('warga.laporan.show', $laporan->id),
        ]);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    /**
     * Tolak laporan + alasan + notifikasi
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10|max:1000'
        ]);

        DB::beginTransaction();
        try {
            $laporan = Laporan::findOrFail($id);

            $laporan->update([
                'status' => 'ditolak',
                'alasan_penolakan' => $request->alasan_penolakan
            ]);

            Tanggapan::create([
                'laporan_id' => $laporan->id,
                'user_id' => auth()->id(),
                'isi' => "⚠️ LAPORAN DITOLAK\n\n{$request->alasan_penolakan}"
            ]);

            Notification::create([
                'user_id' => $laporan->user_id,
                'judul'   => 'Laporan Ditolak',
                'pesan'   => 'Laporan Anda ditolak. Silakan cek alasan penolakan.',
                'tipe'    => 'laporan',
                'link'    => route('warga.laporan.show', $laporan->id),
            ]);

            DB::commit();
            return redirect()->route('admin.laporan.show', $id)
                ->with('success', 'Laporan ditolak dan notifikasi terkirim.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menolak laporan.');
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
            ->with('success', 'Laporan berhasil dihapus.');
    }
}
