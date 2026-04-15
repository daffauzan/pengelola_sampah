<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogPetugas;

class AdminLogController extends Controller
{
    public function index()
    {
        $logs = LogPetugas::with(['user', 'jadwal'])
            ->latest('waktu_log')
            ->get();

        $statusTerbaru = $logs
            ->unique(fn ($log) => $log->user_id.'-'.$log->jadwal_id)
            ->values();

        $statusSummary = [
            'berangkat' => $statusTerbaru->where('status', 'berangkat')->count(),
            'di_lokasi' => $statusTerbaru->where('status', 'di_lokasi')->count(),
            'selesai' => $statusTerbaru->where('status', 'selesai')->count(),
        ];

        $riwayatLog = $logs->take(20);

        return view('admin.log.index', compact('statusTerbaru', 'statusSummary', 'riwayatLog'));
    }
}