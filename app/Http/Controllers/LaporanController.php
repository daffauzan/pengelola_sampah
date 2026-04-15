<?php

namespace App\Http\Controllers;

use App\Models\LaporanSampah;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
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
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('laporan-sampah', 'public');
        }

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
