<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'name',
        'username',
        'email',
        'google_id',
        'password',
        'avatar',
        'nik',
        'tanggal_lahir',
        'gender',
        'no_hp',
        'alamat',
        'rt',
        'rw',
        'role',
    ];

    // Warga → banyak laporan
    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    // Warga → banyak saran
    public function sarans()
    {
        return $this->hasMany(Saran::class);
    }

    // Admin → banyak tanggapan
    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'admin_id');
    }

    // Warga → banyak feedback
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    // Riwayat perubahan status
    public function riwayatStatus()
    {
        return $this->hasMany(RiwayatStatus::class, 'changed_by');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

}
