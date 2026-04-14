<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $fillable = [
        'nama',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function laporanSampah() {
        return $this->hasMany(LaporanSampah::class);
    }

    public function jadwalDibuat() {
        return $this->hasMany(JadwalPengangkutan::class, 'dibuat_oleh');
    }

    public function jadwalPetugas() {
        return $this->belongsToMany(
            JadwalPengangkutan::class,
            'penugasan_petugas',
            'petugas_id',
            'jadwal_id',
        );
    }

    public function logPetugas() {
        return $this->hasMany(LogPetugas::class);
    }
}
