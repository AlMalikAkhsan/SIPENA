<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatStatus extends Model
{
    use HasFactory;

    protected $table = 'riwayat_status';

    protected $fillable = [
        'laporan_id',
        'status_lama',
        'status_baru',
        'changed_by'
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
