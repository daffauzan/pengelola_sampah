<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanSampah;

class AdminLaporanController extends Controller
{
    public function index()
    {
        $laporan = LaporanSampah::latest()->get();
        return view('admin.laporan.index', compact('laporan'));
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
            'status' => 'required|in:menunggu,diproses,selesai'
        ]);

        $laporan = LaporanSampah::findOrFail($id);

        $laporan->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diupdate');
    }
}
