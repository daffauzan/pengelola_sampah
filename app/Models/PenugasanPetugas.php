<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenugasanPetugas extends Model
{
    protected $table = 'penugasan_petugas';

    protected $fillable = [
        'jadwal_id',
        'petugas_id',
    ];

    public function jadwal() {
        return $this->belongsTo(JadwalPengangkutan::class, 'jadwal_id');
    }

    public function petugas() {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
