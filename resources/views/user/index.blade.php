@extends('layouts.app')

@section('title', 'TrashMan - Portal Pengguna')
@section('body_class', 'index-page')

@section('content')

<main class="main">

  <section id="hero" class="hero section dark-background">
    <img src="{{ asset('img/world-dotted-map.png') }}" class="hero-bg">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2>Portal Pelaporan Sampah</h2>
          <p>Laporkan lokasi pungutan sampah dan pantau status penanganannya dari satu halaman.</p>
          <a href="#laporan-form" class="btn btn-primary">Isi Form Laporan</a>
        </div>

        <div class="col-lg-6">
          <img src="{{ asset('img/hero-img.svg') }}" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="services section">
    <div class="container text-center">
      <h2>Layanan Kami</h2>
      <div class="row">

        <div class="col-md-4 mb-4">
          <h4>Laporan Sampah</h4>
          <p>Kirim laporan lokasi sampah lengkap dengan titik koordinat dan foto pendukung.</p>
        </div>

        <div class="col-md-4 mb-4">
          <h4>Penjadwalan</h4>
          <p>Admin mengatur jadwal pengangkutan berdasarkan laporan yang masuk.</p>
        </div>

        <div class="col-md-4 mb-4">
          <h4>Monitoring</h4>
          <p>Anda dapat melihat perkembangan penanganan laporan secara bertahap.</p>
        </div>

      </div>
    </div>
  </section>

  <section id="laporan-form" class="section light-background">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-sm border-0">
            <div class="card-body p-4 p-lg-5">
              <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                  <h3 class="mb-1">Form Pelaporan Pungutan Sampah</h3>
                  <p class="text-muted mb-0">Isi data lokasi dan detail sampah yang perlu ditangani.</p>
                </div>
              </div>

              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif

              @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
              @endif

              <form method="POST" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                  <label for="judul" class="form-label">Judul Laporan</label>
                  <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                  <label for="deskripsi" class="form-label">Deskripsi</label>
                  <textarea id="deskripsi" name="deskripsi" rows="4" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="number" id="latitude" name="latitude" value="{{ old('latitude') }}" class="form-control" step="any" min="-90" max="90" placeholder="Contoh: -6.901068" required>
                    <small class="text-muted">Nilai latitude valid berada di rentang -90 sampai 90.</small>
                  </div>

                  <div class="col-md-6 mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="number" id="longitude" name="longitude" value="{{ old('longitude') }}" class="form-control" step="any" min="-180" max="180" placeholder="Contoh: 107.383160" required>
                    <small class="text-muted">Nilai longitude valid berada di rentang -180 sampai 180.</small>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="foto" class="form-label">Foto Pendukung</label>
                  <input type="file" id="foto" name="foto" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary">Kirim Laporan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="laporan-list" class="section">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
          <h3 class="mb-1">Laporan Saya</h3>
          <p class="text-muted mb-0">Pantau status laporan pungutan sampah yang sudah Anda kirim.</p>
        </div>
      </div>

      <div class="card shadow-sm border-0">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th>Judul</th>
                  <th>Koordinat</th>
                  <th>Status</th>
                  <th>Dibuat</th>
                </tr>
              </thead>
              <tbody>
                @forelse($laporan as $item)
                  <tr>
                    <td>
                      <div class="fw-bold">{{ $item->judul }}</div>
                      <div class="small text-muted">{{ $item->deskripsi ?: '-' }}</div>
                    </td>
                    <td>{{ $item->latitude }}, {{ $item->longitude }}</td>
                    <td>
                      @php
                        $statusClass = match ($item->status) {
                            'pending' => 'warning',
                            'diproses' => 'info',
                            'selesai' => 'success',
                            default => 'secondary',
                        };
                      @endphp
                      <span class="badge bg-{{ $statusClass }} text-uppercase">{{ $item->status }}</span>
                    </td>
                    <td>{{ $item->created_at?->format('d M Y H:i') }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="text-center py-4">Belum ada laporan yang dikirim.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

</main>

@endsection