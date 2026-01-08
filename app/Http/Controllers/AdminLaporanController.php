<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);
        $tanggapan = Tanggapan::where('laporan_id', $id)->first();

        return view('admin.laporan.show', compact('laporan', 'tanggapan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = $request->status;
        $laporan->save();

        return back()->with('success', 'Status berhasil diubah.');
    }

    public function storeTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required'
        ]);

        Tanggapan::create([
            'laporan_id' => $id,
            'admin_id' => auth()->id(),
            'isi_tanggapan' => $request->isi_tanggapan,
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('admin.laporan.index')->with('success', 'Laporan dihapus.');
    }
}
