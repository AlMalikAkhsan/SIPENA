<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => true,
            'message' => 'Data profile berhasil diambil',
            'data' => [
                'name' => $user->name,
                'email' => $user->email,
                'nik' => $user->nik,
                'tanggal_lahir' => $user->tanggal_lahir,
                'gender' => $user->gender,
                'no_hp' => $user->no_hp,
                'alamat' => $user->alamat,
                'rw' => $user->rw,
                'rt' => $user->rt,
                'avatar' => $user->avatar,
                'created_at' => $user->created_at,
            ]
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nik' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string',
            'rw' => 'nullable|string|max:5',
            'rt' => 'nullable|string|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update data
        $user->update($request->only([
            'name',
            'nik',
            'tanggal_lahir',
            'gender',
            'no_hp',
            'alamat',
            'rw',
            'rt'
        ]));

        return response()->json([
            'status' => true,
            'message' => 'Profile berhasil diupdate',
            'data' => $user
        ]);
    }
}