<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class WargaLaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::where('user_id', auth()->id());

        if ($request->search) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $laporan = $query->latest()->paginate(6);
        return view('warga.laporan.index', compact('laporan'));
    }

    public function create()
    {
        return view('warga.laporan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fotoName = null;

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
        }

        Laporan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'foto' => $fotoName,
            'status' => 'menunggu',
        ]);

        return redirect()->route('warga.laporan.index')->with('success', 'Laporan berhasil dikirim.');
    }

    public function show($id)
    {
        $laporan = Laporan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('warga.laporan.show', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = Laporan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('warga.laporan.edit', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $fotoName);
            $laporan->foto = $fotoName;
        }

        $laporan->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('warga.laporan.index')->with('success', 'Laporan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $laporan = Laporan::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $laporan->delete();

        return redirect()->route('warga.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
