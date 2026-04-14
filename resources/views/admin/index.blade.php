@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Dashboard Pengelolaan Sampah</h1>

<div class="row">

  <div class="col-md-4">
    <div class="card shadow mb-4">
      <div class="card-body">
        Total Laporan Sampah
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card shadow mb-4">
      <div class="card-body">
        Jadwal Aktif
      </div>
    </div>
  </div>

</div>

@endsection