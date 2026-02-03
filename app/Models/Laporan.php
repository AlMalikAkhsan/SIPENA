<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'foto',
        'lokasi',
        'status',
        'alasan_penolakan',
        'archived_at',  // TAMBAHKAN INI
        'closed_at'     // TAMBAHKAN INI
    ];

    protected $casts = [
        'archived_at' => 'datetime',
        'closed_at' => 'datetime',
        'foto' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class)->latest();
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    public function riwayatStatus()
    {
        return $this->hasMany(RiwayatStatus::class);
    }

    public function fotos()
    {
        return $this->hasMany(LaporanFoto::class)->orderBy('urutan');
    }

    // Scope untuk laporan aktif
    public function scopeActive($query)
    {
        return $query->whereNull('archived_at');
    }

    // Scope untuk riwayat
    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }

    // Helper method
    public function isArchived()
    {
        return !is_null($this->archived_at);
    }

    public function archive()
    {
        $this->archived_at = now();
        $this->save();
    }

    public function unarchive()
    {
        $this->archived_at = null;
        $this->save();
    }
}