<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogPetugas extends Model
{
    protected $table = 'log_petugas';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'jadwal_id',
        'status',
        'latitude',
        'longitude',
        'waktu_log',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function jadwal() {
        return $this->belongsTo(JadwalPengangkutan::class, 'jadwal_id');
    }
}
