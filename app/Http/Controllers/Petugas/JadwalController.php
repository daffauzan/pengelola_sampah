<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\LogPetugas;
use Illuminate\Http\Request;
use App\Models\JadwalPengangkutan;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPengangkutan::with(['admin', 'petugas', 'log' => function ($query) {
                $query->where('user_id', Auth::id())->latest('waktu_log');
            }])
            ->whereHas('petugas', function ($query) {
                $query->where('users.id', Auth::id());
            })
            ->orderBy('tanggal')
            ->orderBy('waktu')
            ->get();

        return view('petugas.jadwal.index', compact('jadwal'));
    }

    public function show($id)
    {
        $jadwal = JadwalPengangkutan::with(['admin', 'petugas', 'log' => function ($query) {
                $query->where('user_id', Auth::id())->latest('waktu_log');
            }])
            ->where('id', $id)
            ->whereHas('petugas', function ($query) {
                $query->where('users.id', Auth::id());
            })
            ->firstOrFail();

        return view('petugas.jadwal.show', compact('jadwal'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:berangkat,di_lokasi,selesai',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $jadwal = JadwalPengangkutan::where('id', $id)
            ->whereHas('petugas', function ($query) {
                $query->where('users.id', Auth::id());
            })
            ->firstOrFail();

        LogPetugas::create([
            'user_id' => Auth::id(),
            'jadwal_id' => $jadwal->id,
            'status' => $validated['status'],
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
        ]);

        return redirect()->route('petugas.jadwal.show', $jadwal->id)
            ->with('success', 'Status berhasil diperbarui');
    }
}
