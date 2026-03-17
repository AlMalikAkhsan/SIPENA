<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Laporan;

class DashBoardController extends Controller
{
    public function warga()
    {
        // Query utama dengan eager loading fotos
        $query = Laporan::with('fotos')->where('user_id', Auth::id());
        $userId = auth()->id();

        $total    = Laporan::where('user_id', $userId)->count();
        $menunggu = Laporan::where('user_id', $userId)->where('status', 'menunggu')->count();
        $diproses = Laporan::where('user_id', $userId)->where('status', 'diproses')->count();
        $selesai  = Laporan::where('user_id', $userId)->where('status', 'selesai')->count();
        $ditolak  = Laporan::where('user_id', $userId)->where('status', 'ditolak')->count();

        $latest   = Laporan::where('user_id', $userId)->latest()->take(3)->get();
        $laporan  = Laporan::where('user_id', $userId)->latest()->paginate(9);

        return view('warga.dashboard', compact(
            'total',
            'menunggu',
            'diproses',
            'selesai',
            'ditolak',
            'latest',
            'laporan',
        ));
    }

    /**
     * Menampilkan semua laporan dari semua warga dengan filter
     */
    public function semua(Request $request)
    {
        // Query builder untuk laporan
        $query = Laporan::with(['user', 'fotos']);
        
        // Filter berdasarkan pencarian (judul atau isi)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('isi', 'like', '%' . $search . '%');
            });
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Sorting (default: terbaru)
        $sort = $request->get('sort', 'terbaru');
        if ($sort === 'terlama') {
            $query->oldest();
        } else {
            $query->latest();
        }
        
        // Paginate dengan append query parameters
        $laporan = $query->paginate(12)->withQueryString();
        
        return view('warga.laporan.semua', compact('laporan'));
    }

    // Menampilkan halaman profile (read-only)
    public function profile()
    {
        return view('warga.profile.index');
    }

    // Menampilkan form edit profile
    public function editProfile()
    {
        return view('warga.profile.edit');
    }   

    // Memproses update profile
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validasi data dengan field yang sesuai database
        $validatedData = $request->validate([
            // Personal Info
            'name' => 'required|string|max:255',
            'username' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^\S*$/',  // tidak boleh ada spasi
                Rule::unique('users')->ignore($user->id)
            ],
            'nik' => [
                'nullable',
                'string',
                'digits:16',
                Rule::unique('users')->ignore($user->id)
            ],
            'tanggal_lahir' => 'nullable|date|before:today',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            
            // Contact Info
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            
            // Avatar
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Password
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
            
            // Upload avatar baru
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validatedData['avatar'] = $avatarPath;
        }

        // Handle password change
        if ($request->filled('current_password')) {
            // Verifikasi password lama
            if (!Hash::check($request->current_password, $user->password)) {
                return back()
                    ->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])
                    ->withInput();
            }
            
            // Update password baru
            $validatedData['password'] = Hash::make($request->new_password);
            
            // Hapus field password dari input
            unset($validatedData['current_password'], $validatedData['new_password']);
        } else {
            // Hapus field password jika tidak diisi
            unset($validatedData['current_password'], $validatedData['new_password']);
        }

        // Update user data
        $user->update($validatedData);

        return redirect()->route('warga.profile')->with('success', 'Profile berhasil diperbarui.');
    }
}