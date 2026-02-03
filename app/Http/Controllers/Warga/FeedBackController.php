<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = Feedback::with(['laporan', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('warga.feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil laporan milik user yang statusnya 'selesai' dan belum diberi feedback
        $laporans = Laporan::where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->whereDoesntHave('feedback') // Hanya laporan yang belum diberi feedback
            ->latest()
            ->get();

        return view('warga.feedback.create', compact('laporans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'laporan_id' => 'required|exists:laporans,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000'
        ], [
            'laporan_id.required' => 'Silakan pilih laporan',
            'laporan_id.exists' => 'Laporan tidak ditemukan',
            'rating.required' => 'Rating wajib diisi',
            'rating.integer' => 'Rating harus berupa angka',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'komentar.max' => 'Komentar maksimal 1000 karakter'
        ]);

        // Cek apakah laporan adalah milik user yang login
        $laporan = Laporan::where('id', $request->laporan_id)
            ->where('user_id', Auth::id())
            ->where('status', 'selesai')
            ->firstOrFail();

        // Cek apakah sudah pernah memberi feedback untuk laporan ini
        $existingFeedback = Feedback::where('laporan_id', $request->laporan_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingFeedback) {
            return redirect()->back()
                ->with('error', 'Anda sudah memberikan feedback untuk laporan ini.');
        }

        Feedback::create([
            'user_id' => Auth::id(),
            'laporan_id' => $request->laporan_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return redirect()->route('warga.feedback.index')
            ->with('success', 'Terima kasih! Feedback Anda berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = Feedback::with(['laporan', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('warga.feedback.show', compact('feedback'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $feedback->delete();

        return redirect()->route('warga.feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }
}