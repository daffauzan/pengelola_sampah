@extends('admin.layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Detail Laporan Sampah</h1>
  <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
</div>

<div class="row">
  <div class="col-lg-7">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="mb-3">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pelapor</div>
          <div class="h5 mb-0 text-gray-800">{{ $laporan->user->nama ?? '-' }}</div>
        </div>

        <div class="mb-3">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Judul Laporan</div>
          <div class="text-gray-800">{{ $laporan->judul }}</div>
        </div>

        <div class="mb-3">
          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Isi Laporan</div>
          <div class="text-gray-800">{{ $laporan->deskripsi ?: 'Tidak ada deskripsi tambahan.' }}</div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Latitude</div>
            <div class="text-gray-800">{{ $laporan->latitude }}</div>
          </div>

          <div class="col-md-6 mb-3">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Longitude</div>
            <div class="text-gray-800">{{ $laporan->longitude }}</div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Status</div>
            <span class="badge badge-{{ $laporan->status === 'selesai' ? 'success' : ($laporan->status === 'diproses' ? 'info' : 'warning') }} px-3 py-2 text-uppercase">
              {{ $laporan->status }}
            </span>
          </div>

          <div class="col-md-6 mb-3">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tanggal Laporan</div>
            <div class="text-gray-800">{{ $laporan->created_at?->format('d M Y H:i') }}</div>
          </div>
        </div>

        <div>
          <a href="https://www.google.com/maps?q={{ $laporan->latitude }},{{ $laporan->longitude }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-primary btn-sm">
            Lihat di Google Maps
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Foto Laporan</h6>
      </div>
      <div class="card-body text-center">
        @if($laporan->foto_url)
          <img src="{{ $laporan->foto_url }}" alt="Foto laporan {{ $laporan->judul }}" class="img-fluid rounded shadow-sm mb-3">
          <div>
            <a href="{{ $laporan->foto_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-sm">Lihat ukuran penuh</a>
          </div>
        @else
          <p class="text-muted mb-0">Pengguna tidak mengunggah foto pada laporan ini.</p>
        @endif
      </div>
    </div>
  </div>
</div>

@endsection