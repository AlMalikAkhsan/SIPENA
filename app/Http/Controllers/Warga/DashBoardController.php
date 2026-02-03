<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Laporan;
use App\Models\User;

class DashBoardController extends Controller
{
    public function warga()
    {
        $userId = auth()->id();

        $total = Laporan::where('user_id', $userId)->count();
        $menunggu = Laporan::where('user_id', $userId)->where('status', 'menunggu')->count();
        $diproses = Laporan::where('user_id', $userId)->where('status', 'diproses')->count();
        $selesai = Laporan::where('user_id', $userId)->where('status', 'selesai')->count();

        $latest = Laporan::where('user_id', $userId)->latest()->take(3)->get();

        return view('warga.dashboard', compact(
            'total', 'menunggu', 'diproses', 'selesai', 'latest'
        ));
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

        // Validasi data
        $validatedData = $request->validate([
            // Personal Info
            'name' => 'required|string|max:255',
            'username' => [
                'required',
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
            'bio' => 'nullable|string|max:500',
            
            // Contact Info
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
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
            if ($user->avatar) {
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
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai.'])->withInput();
            }
            
            // Update password baru
            $validatedData['password'] = Hash::make($request->new_password);
        }

        // Hapus field password dari validatedData jika tidak diisi
        if (!$request->filled('current_password')) {
            unset($validatedData['current_password'], $validatedData['new_password']);
        }

        // Update user data
        $user->update($validatedData);

        return redirect()->route('warga.profile')->with('success', 'Profile berhasil diperbarui.');
    }
}