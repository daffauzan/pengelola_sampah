@extends('petugas.layouts.app')

@section('title', 'Detail Jadwal')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <div>
    <h1 class="h3 mb-1 text-gray-800">Detail Jadwal Pengangkutan</h1>
    <p class="mb-0 text-gray-600">Perbarui progres tugas lapangan Anda dari halaman ini.</p>
  </div>
  <a href="{{ route('petugas.jadwal') }}" class="btn btn-secondary btn-sm">Kembali</a>
</div>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="row">
  <div class="col-lg-7 mb-4">
    <div class="card shadow h-100">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Informasi Jadwal</h6>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <div class="small text-uppercase text-muted">Area</div>
          <div class="font-weight-bold text-gray-800">{{ $jadwal->area }}</div>
        </div>
        <div class="mb-3">
          <div class="small text-uppercase text-muted">Tanggal dan Waktu</div>
          <div class="text-gray-800">
            {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('l, d M Y') }}
            pukul {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}
          </div>
        </div>
        <div class="mb-3">
          <div class="small text-uppercase text-muted">Keterangan</div>
          <div class="text-gray-800">{{ $jadwal->keterangan ?: '-' }}</div>
        </div>
        <div>
          <div class="small text-uppercase text-muted">Dibuat Oleh</div>
          <div class="text-gray-800">{{ $jadwal->admin->nama ?? '-' }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 mb-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Form Update Status</h6>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('petugas.jadwal.updateStatus', $jadwal->id) }}">
          @csrf

          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
              <option value="berangkat">Berangkat</option>
              <option value="di_lokasi">Di Lokasi</option>
              <option value="selesai">Selesai</option>
            </select>
          </div>

          <div class="form-group">
            <label for="latitude">Latitude</label>
            <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="form-control" placeholder="Contoh: -6.20000000">
          </div>

          <div class="form-group">
            <label for="longitude">Longitude</label>
            <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="form-control" placeholder="Contoh: 106.81666600">
          </div>

          <button type="submit" class="btn btn-success">Simpan Status</button>
        </form>
      </div>
    </div>

    <div class="card shadow">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Riwayat Log Anda</h6>
      </div>
      <div class="card-body">
        @forelse($jadwal->log as $log)
          <div class="border-left-success pl-3 mb-3">
            <div class="font-weight-bold text-capitalize">{{ str_replace('_', ' ', $log->status) }}</div>
            <div class="small text-muted">{{ \Carbon\Carbon::parse($log->waktu_log)->translatedFormat('d M Y H:i') }}</div>
            <div class="small text-muted">{{ $log->latitude && $log->longitude ? $log->latitude . ', ' . $log->longitude : 'Koordinat tidak diisi' }}</div>
          </div>
        @empty
          <p class="mb-0 text-gray-600">Belum ada log status untuk jadwal ini.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>

@endsection