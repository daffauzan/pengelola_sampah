<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanSampah;
use App\Models\User;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $laporan = LaporanSampah::latest()->get();
        return view('admin.laporan.index', compact('laporan'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->orderBy('nama')->get();

        return view('admin.laporan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        LaporanSampah::create($validated);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = LaporanSampah::findOrFail($id);
        $users = User::where('role', 'user')->orderBy('nama')->get();

        return view('admin.laporan.edit', compact('laporan', 'users'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $laporan = LaporanSampah::findOrFail($id);
        $laporan->update($validated);

        return redirect()->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    public function show($id)
    {
        $laporan = LaporanSampah::findOrFail($id);
        return view('admin.laporan.show', compact('laporan'));
    }

    public function destroy($id)
    {
        LaporanSampah::destroy($id);
        return back()->with('success', 'Laporan dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai'
        ]);

        $laporan = LaporanSampah::findOrFail($id);

        $laporan->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diupdate');
    }
}
