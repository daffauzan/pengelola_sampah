<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanSampah extends Model
{
    protected $table = 'laporan_sampah';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'foto',
        'latitude',
        'longitude',
        'status',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
