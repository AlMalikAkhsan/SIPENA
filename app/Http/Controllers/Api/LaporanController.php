<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\LaporanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::where('user_id', auth()->id())
            ->latest()
            ->get();

        return response()->json([
            'status' => true,
            'data' => $laporan,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lokasi' => 'nullable|string',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $files = $this->normalizeFiles($request);
        if (count($files) > 5) {
            return response()->json([
                'status' => false,
                'message' => 'Maksimal 5 foto',
            ], 422);
        }

        $laporan = Laporan::create([
            'user_id' => auth()->id(),
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lokasi' => $request->lokasi,
            'status' => 'menunggu',
        ]);

        foreach ($files as $index => $file) {
            $path = $file->store('laporan', 'public');

            LaporanFoto::create([
                'laporan_id' => $laporan->id,
                'foto_path' => $path,
                'urutan' => $index,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Laporan berhasil dikirim',
            'data' => $laporan,
        ]);
    }

    public function show($id)
    {
        $laporan = Laporan::where('user_id', auth()->id())->find($id);

        if (!$laporan) {
            return response()->json([
                'status' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $laporan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $laporan = Laporan::where('user_id', auth()->id())->find($id);

        if (!$laporan) {
            return response()->json([
                'status' => false,
                'message' => 'Laporan tidak ditemukan',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'lokasi' => 'nullable|string',
            'foto.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'hapus_foto' => 'nullable|array',
            'hapus_foto.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        $files = $this->normalizeFiles($request);
        $requestedPhotoIds = $request->input('hapus_foto', []);
        $photosToDelete = collect();

        if (!empty($requestedPhotoIds)) {
            $photosToDelete = $laporan->fotos()
                ->whereIn('id', $requestedPhotoIds)
                ->get();

            if ($photosToDelete->count() !== count($requestedPhotoIds)) {
                return response()->json([
                    'status' => false,
                    'message' => 'Foto yang dipilih tidak valid',
                ], 422);
            }
        }

        $remainingPhotoCount = $laporan->fotos()->count() - $photosToDelete->count();
        if (($remainingPhotoCount + count($files)) > 5) {
            return response()->json([
                'status' => false,
                'message' => 'Total foto maksimal 5',
            ], 422);
        }

        $laporan->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lokasi' => $request->lokasi,
        ]);

        foreach ($photosToDelete as $foto) {
            Storage::disk('public')->delete($foto->foto_path);
            $foto->delete();
        }

        $nextOrder = (int) ($laporan->fotos()->max('urutan') ?? -1) + 1;
        foreach ($files as $index => $file) {
            $path = $file->store('laporan', 'public');

            LaporanFoto::create([
                'laporan_id' => $laporan->id,
                'foto_path' => $path,
                'urutan' => $nextOrder + $index,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Laporan berhasil diupdate',
        ]);
    }

    private function normalizeFiles(Request $request): array
    {
        if (!$request->hasFile('foto')) {
            return [];
        }

        $files = $request->file('foto');

        return is_array($files) ? $files : [$files];
    }
}
