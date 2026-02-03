<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'tanggapans';

    /**
     * Field yang bisa diisi
     */
    protected $fillable = [
        'laporan_id',
        'user_id',
        'isi'
    ];

    /**
     * Relasi ke Laporan
     */
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    /**
     * Relasi ke User (Admin yang memberikan tanggapan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}