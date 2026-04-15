<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

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

    protected $appends = [
        'foto_url',
    ];

    public function getFotoUrlAttribute(): ?string
    {
        if (! $this->foto) {
            return null;
        }

        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('s3');

        return $disk->url($this->foto);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
