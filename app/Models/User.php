<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nik',
        'no_hp',
        'alamat',
        'rt',
        'rw',
        'role'
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
}
