<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'status',
        'tanggapan_admin',
        'tanggapan_at'
    ];

    protected $casts = [
        'tanggapan_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}