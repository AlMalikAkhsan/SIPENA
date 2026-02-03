<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Saran;
use Illuminate\Support\Facades\Auth;

class SaranController extends Controller
{
    public function index()
    {
        $saran = Saran::where('user_id', Auth::id())
                    ->latest()
                    ->paginate(10);

        return view('warga.saran.index', compact('saran'));
    }

    public function create()
    {
        return view('warga.saran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Saran::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('warga.saran.index')
            ->with('success', 'Saran berhasil dikirim.');
    }

    public function show($id)
    {
        $saran = Saran::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('warga.saran.show', compact('saran'));
    }

    public function edit($id)
    {
        $saran = Saran::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return view('warga.saran.edit', compact('saran'));
    }

    public function update(Request $request, $id)
    {
        $saran = Saran::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $saran->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
        ]);

        return redirect()->route('warga.saran.index')
            ->with('success', 'Saran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $saran = Saran::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $saran->delete();

        return redirect()->route('warga.saran.index')
            ->with('success', 'Saran berhasil dihapus.');
    }
}
