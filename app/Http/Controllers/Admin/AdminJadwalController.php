<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPengangkutan;
use App\Models\User;

class AdminJadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPengangkutan::with(['admin', 'petugas'])
            ->latest('tanggal')
            ->latest('waktu')
            ->get();

        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $petugas = User::where('role', 'petugas')->orderBy('nama')->get();

        return view('admin.jadwal.create', compact('petugas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'area' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'petugas_id' => 'nullable|array',
            'petugas_id.*' => 'exists:users,id',
        ]);

        $jadwal = JadwalPengangkutan::create([
            'tanggal' => $validated['tanggal'],
            'waktu' => $validated['waktu'],
            'area' => $validated['area'],
            'keterangan' => $validated['keterangan'] ?? null,
            'dibuat_oleh' => auth()->id(),
        ]);

        $jadwal->petugas()->sync($validated['petugas_id'] ?? []);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalPengangkutan::findOrFail($id);
        $petugas = User::where('role', 'petugas')->orderBy('nama')->get();

        return view('admin.jadwal.edit', compact('jadwal', 'petugas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required|date_format:H:i',
            'area' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'petugas_id' => 'nullable|array',
            'petugas_id.*' => 'exists:users,id',
        ]);

        $jadwal = JadwalPengangkutan::findOrFail($id);

        $jadwal->update([
            'tanggal' => $validated['tanggal'],
            'waktu' => $validated['waktu'],
            'area' => $validated['area'],
            'keterangan' => $validated['keterangan'] ?? null,
        ]);

        $jadwal->petugas()->sync($validated['petugas_id'] ?? []);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal diupdate');
    }

    public function destroy($id)
    {
        JadwalPengangkutan::destroy($id);
        return back()->with('success', 'Jadwal dihapus');
    }
}