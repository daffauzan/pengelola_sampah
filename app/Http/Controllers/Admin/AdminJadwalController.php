<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalPengangkutan;

class AdminJadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPengangkutan::latest()->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
        ]);

        JadwalPengangkutan::create(
            $request->only('tanggal', 'lokasi')
        );

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalPengangkutan::findOrFail($id);
        return view('admin.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'lokasi' => 'required|string|max:255',
        ]);

        $jadwal = JadwalPengangkutan::findOrFail($id);

        $jadwal->update(
            $request->only('tanggal', 'lokasi')
        );

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal diupdate');
    }

    public function destroy($id)
    {
        JadwalPengangkutan::destroy($id);
        return back()->with('success', 'Jadwal dihapus');
    }
}