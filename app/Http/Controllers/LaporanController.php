<?php

namespace App\Http\Controllers;

use App\Models\LaporanSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    private function normalizeCoordinate(?string $value): ?float
    {
        if ($value === null) {
            return null;
        }

        $normalized = str_replace(',', '.', trim($value));

        return is_numeric($normalized) ? (float) $normalized : null;
    }

    public function index()
    {
        $laporan = auth()->user()
            ->laporanSampah()
            ->latest()
            ->get();

        return view('user.index', compact('laporan'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'latitude' => $this->normalizeCoordinate($request->input('latitude')),
            'longitude' => $this->normalizeCoordinate($request->input('longitude')),
        ]);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'foto' => 'nullable|image|max:2048',
        ], [
            'latitude.between' => 'Latitude harus berada di antara -90 sampai 90.',
            'longitude.between' => 'Longitude harus berada di antara -180 sampai 180.',
        ]);

        $fotoPath = null;

        $fotoPath = Storage::disk('s3')->putFile(
            'laporan-sampah',
            $request->file('foto')
        );

        dd($fotoPath);

        LaporanSampah::create([
            'user_id' => auth()->id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'foto' => $fotoPath,
            'status' => 'pending',
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Laporan pungutan sampah berhasil dikirim.');
    }
}
