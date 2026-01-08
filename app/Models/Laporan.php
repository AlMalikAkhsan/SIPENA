<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $fillable = [
        'user_id',
        'judul',
        'isi',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class);
    }

}
