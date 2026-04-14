@extends('layouts.app')

@section('title', 'Home')
@section('body_class', 'index-page')

@section('content')

<main class="main">

  <!-- Hero Section -->
  <section id="hero" class="hero section dark-background">
    <img src="{{ asset('img/world-dotted-map.png') }}" class="hero-bg">

    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h2>Pengelolaan Sampah Digital</h2>
          <p>Sistem pelaporan sampah dan penjadwalan pengangkutan berbasis web.</p>

          @guest
            <a href="/login" class="btn btn-primary">Login untuk Melapor</a>
          @endguest

          @auth
            @if(auth()->user()->role == 'user')
              <a href="/dashboard" class="btn btn-primary">Buat Laporan</a>
            @elseif(auth()->user()->role == 'admin')
              <a href="/admin/dashboard" class="btn btn-primary">Dashboard Admin</a>
            @elseif(auth()->user()->role == 'petugas')
              <a href="/petugas/dashboard" class="btn btn-primary">Dashboard Petugas</a>
            @endif
          @endauth

        </div>

        <div class="col-lg-6">
          <img src="{{ asset('img/hero-img.svg') }}" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section id="services" class="services section">
    <div class="container text-center">
      <h2>Layanan Kami</h2>
      <div class="row">

        <div class="col-md-4">
          <h4>Laporan Sampah</h4>
          <p>Laporkan lokasi sampah dengan cepat.</p>
        </div>

        <div class="col-md-4">
          <h4>Penjadwalan</h4>
          <p>Admin mengatur jadwal pengangkutan.</p>
        </div>

        <div class="col-md-4">
          <h4>Monitoring</h4>
          <p>Petugas mencatat aktivitas lapangan.</p>
        </div>

      </div>
    </div>
  </section>

</main>

@endsection