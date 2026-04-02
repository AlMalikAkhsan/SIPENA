<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Laporan;
use App\Models\Notification;
use App\Mail\TanggapanMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'isi'        => 'required|string|min:5|max:2000'
        ], [
            'isi.required' => 'Isi tanggapan wajib diisi',
            'isi.min'      => 'Tanggapan minimal 5 karakter',
            'isi.max'      => 'Tanggapan maksimal 2000 karakter'
        ]);

        $laporan = Laporan::with('user')->findOrFail($request->laporan_id);

        if ($laporan->status === 'ditolak') {
            return back()->with('error', 'Tidak dapat menambahkan tanggapan pada laporan yang ditolak.');
        }

        DB::beginTransaction();
        try {
            $tanggapan = Tanggapan::create([
                'laporan_id' => $laporan->id,
                'user_id'    => auth()->id(),
                'isi'        => $request->isi
            ]);

            Notification::create([
                'user_id' => $laporan->user_id,
                'judul'   => 'Tanggapan Baru pada Laporan Anda',
                'pesan'   => 'Admin telah menanggapi laporan: ' . $laporan->judul,
                'tipe'    => 'tanggapan',
                'link'    => route('warga.laporan.show', $laporan->id),
            ]);

            if ($laporan->user?->email) {
                Mail::to($laporan->user->email)
                    ->send(new TanggapanMail($laporan, $tanggapan));
            }

            DB::commit();

            return redirect()->route('admin.laporan.show', $laporan->id)
                ->with('success', 'Tanggapan berhasil dikirim dan email notifikasi telah dikirim ke user.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan tanggapan: ' . $e->getMessage());
        }
    }
    // ✅ Tidak ada method reject() di sini
}