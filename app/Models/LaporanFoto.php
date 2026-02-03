<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'foto_path',
        'urutan'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}