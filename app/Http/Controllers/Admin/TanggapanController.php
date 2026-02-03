<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tanggapan;
use App\Models\Laporan;

class TanggapanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'isi' => 'required|string|min:5|max:2000'
        ], [
            'isi.required' => 'Isi tanggapan wajib diisi',
            'isi.min' => 'Tanggapan minimal 5 karakter',
            'isi.max' => 'Tanggapan maksimal 2000 karakter'
        ]);

        $laporan = Laporan::findOrFail($request->laporan_id);

        // Cek apakah laporan sudah ditolak
        if ($laporan->status === 'ditolak') {
            return redirect()->back()
                ->with('error', 'Tidak dapat menambahkan tanggapan pada laporan yang ditolak.');
        }

        Tanggapan::create([
            'laporan_id' => $request->laporan_id,
            'user_id' => auth()->id(),
            'isi' => $request->isi
        ]);

        return redirect()->route('admin.laporan.show', $request->laporan_id)
            ->with('success', 'Tanggapan berhasil dikirim ke user.');
    }
}