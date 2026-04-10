<?php

namespace App\Http\Controllers;

use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('google_id', $googleUser->id)
                    ->orWhere('email', $googleUser->email)
                    ->first();

        if (!$user) {
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => Hash::make(rand(100000,999999)),
                'role' => 'warga',
                'email_verified_at' => now(),
            ]);
        } else {
            $updates = [];

            if (!$user->google_id) {
                $updates['google_id'] = $googleUser->id;
            }

            if (!$user->hasVerifiedEmail()) {
                $updates['email_verified_at'] = now();
            }

            if (!empty($updates)) {
                $user->update($updates);
            }
        }

        if ($user->role !== 'warga') {
            return redirect('/login')->with('error', 'Akun ini bukan akun warga.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('warga.dashboard');
    }
}
