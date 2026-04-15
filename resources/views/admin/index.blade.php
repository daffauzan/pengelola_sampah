@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Dashboard Pengelolaan Sampah</h1>

<div class="row">

  <div class="col-md-4">
    <div class="card shadow mb-4 border-left-primary">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Laporan Sampah</div>
        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($totalLaporan ?? 0) }}</div>
        <div class="mt-2">
          <a href="{{ route('admin.laporan.index') }}" class="small text-primary">Lihat daftar laporan</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow mb-4 border-left-success">
      <div class="card-body">
        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jadwal Aktif</div>
        <div class="h3 mb-0 font-weight-bold text-gray-800">{{ number_format($jadwalAktif ?? 0) }}</div>
        <div class="mt-2">
          <a href="{{ route('admin.jadwal.index') }}" class="small text-success">Lihat jadwal pengangkutan</a>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection