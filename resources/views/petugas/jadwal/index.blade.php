@extends('petugas.layouts.app')

@section('title', 'Jadwal Tugas')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h3 mb-1 text-gray-800">Jadwal Tugas</h1>
    <p class="mb-0 text-gray-600">Daftar jadwal pengangkutan yang ditugaskan kepada Anda.</p>
  </div>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Area</th>
            <th>Status Terakhir</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($jadwal as $item)
            @php $logTerakhir = $item->log->first(); @endphp
            <tr>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
              <td>
                <div class="font-weight-bold">{{ $item->area }}</div>
                <div class="small text-muted">{{ $item->keterangan ?: '-' }}</div>
              </td>
              <td>
                @if($logTerakhir)
                  <span class="badge badge-success text-capitalize">{{ str_replace('_', ' ', $logTerakhir->status) }}</span>
                @else
                  <span class="badge badge-secondary">Belum ada log</span>
                @endif
              </td>
              <td>
                <a href="{{ route('petugas.jadwal.show', $item->id) }}" class="btn btn-success btn-sm">Lihat Detail</a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center">Belum ada jadwal yang ditugaskan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection