<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPengangkutan extends Model
{
    protected $table = 'jadwal_pengangkutan';

    protected $fillable = [
        'tanggal',
        'waktu',
        'area',
        'keterangan',
        'dibuat_oleh',
    ];

    public function admin() {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function petugas() {
        return $this->belongsToMany(
            User::class,
            'penugasan_petugas',
            'jadwal_id',
            'petugas_id',
        );
    }

    public function log() {
        return $this->hasMany(LogPetugas::class, 'jadwal_id');
    }
}
