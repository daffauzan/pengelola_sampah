@extends('admin.layouts.app')

@section('title', 'Log Aktivitas')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h3 mb-1 text-gray-800">Log Aktivitas Petugas</h1>
    <p class="mb-0 text-gray-600">Pantau progres pemungutan sampah berdasarkan status terakhir dan riwayat log petugas.</p>
  </div>
</div>

<div class="row">
  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Berangkat</div>
            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $statusSummary['berangkat'] }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-truck fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Di Lokasi</div>
            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $statusSummary['di_lokasi'] }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-map-marker-alt fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Selesai</div>
            <div class="h4 mb-0 font-weight-bold text-gray-800">{{ $statusSummary['selesai'] }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Status Terbaru Tiap Penugasan</h6>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>Petugas</th>
            <th>Area</th>
            <th>Jadwal</th>
            <th>Status Terakhir</th>
            <th>Waktu Log</th>
            <th>Koordinat</th>
          </tr>
        </thead>
        <tbody>
          @forelse($statusTerbaru as $log)
            <tr>
              <td>{{ $log->user->nama ?? '-' }}</td>
              <td>{{ $log->jadwal->area ?? '-' }}</td>
              <td>
                @if($log->jadwal)
                  {{ \Carbon\Carbon::parse($log->jadwal->tanggal)->translatedFormat('d M Y') }}
                  {{ \Carbon\Carbon::parse($log->jadwal->waktu)->format('H:i') }}
                @else
                  -
                @endif
              </td>
              <td><span class="badge badge-success text-capitalize">{{ str_replace('_', ' ', $log->status) }}</span></td>
              <td>{{ \Carbon\Carbon::parse($log->waktu_log)->translatedFormat('d M Y H:i') }}</td>
              <td>{{ $log->latitude && $log->longitude ? $log->latitude . ', ' . $log->longitude : '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">Belum ada aktivitas petugas yang tercatat.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="card shadow">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-success">Riwayat Aktivitas Terbaru</h6>
  </div>
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>Waktu</th>
            <th>Petugas</th>
            <th>Area</th>
            <th>Status</th>
            <th>Koordinat</th>
          </tr>
        </thead>
        <tbody>
          @forelse($riwayatLog as $log)
            <tr>
              <td>{{ \Carbon\Carbon::parse($log->waktu_log)->translatedFormat('d M Y H:i') }}</td>
              <td>{{ $log->user->nama ?? '-' }}</td>
              <td>{{ $log->jadwal->area ?? '-' }}</td>
              <td class="text-capitalize">{{ str_replace('_', ' ', $log->status) }}</td>
              <td>{{ $log->latitude && $log->longitude ? $log->latitude . ', ' . $log->longitude : '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">Belum ada riwayat log.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection