@extends('layouts.app')

@section('title', 'TrashMan - Pengelolaan Sampah Digital')
@section('body_class', 'index-page')

@section('content')

<main class="main">

  <section id="hero" class="hero section dark-background">
    <img src="{{ asset('img/world-dotted-map.png') }}" class="hero-bg">

    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <h2>Pengelolaan Sampah Digital</h2>
          <p>Sistem pelaporan sampah dan penjadwalan pengangkutan berbasis web untuk masyarakat, admin, dan petugas lapangan.</p>

          @guest
            <a href="{{ route('login') }}" class="btn btn-primary">Login untuk Melapor</a>
          @endguest

          @auth
            @if(auth()->user()->role == 'user')
              <a href="{{ route('user.index') }}" class="btn btn-primary">Buat Laporan</a>
            @elseif(auth()->user()->role == 'admin')
              <a href="{{ route('admin.index') }}" class="btn btn-primary">Dashboard Admin</a>
            @elseif(auth()->user()->role == 'petugas')
              <a href="{{ route('petugas.jadwal') }}" class="btn btn-primary">Jadwal Petugas</a>
            @endif
          @endauth

        </div>

        <div class="col-lg-6">
          <img src="{{ asset('img/hero-img.svg') }}" class="img-fluid">
        </div>
      </div>
    </div>
  </section>

  <section id="tentang" class="section light-background">
    <div class="container">
      <div class="row align-items-center gy-4">
        <div class="col-lg-6">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h3 class="mb-3">Tentang TrashMan</h3>
            <p>TrashMan membantu masyarakat mengirim laporan sampah secara digital, memudahkan admin menyusun jadwal pengangkutan, dan memantau progres pemungutan oleh petugas.</p>
            <p class="mb-0">Alur kerja dirancang sederhana: warga membuat laporan, admin mengatur penugasan, lalu petugas memperbarui status pekerjaan langsung dari lapangan.</p>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="row g-3">
            <div class="col-sm-6">
              <div class="p-4 bg-white rounded shadow-sm h-100 text-center">
                <h4 class="h2 mb-2 text-success">24/7</h4>
                <p class="mb-0">Akses pelaporan kapan saja</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="p-4 bg-white rounded shadow-sm h-100 text-center">
                <h4 class="h2 mb-2 text-success">Live</h4>
                <p class="mb-0">Status pengangkutan bisa dipantau</p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="p-4 bg-white rounded shadow-sm h-100 text-center">
                <h4 class="h2 mb-2 text-success">Terjadwal</h4>
                <p class="mb-0">Pengangkutan lebih teratur dan terdokumentasi</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="layanan" class="services section">
    <div class="container text-center">
      <h2>Layanan Kami</h2>
      <div class="row gy-4">

        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h4>Laporan Sampah</h4>
            <p class="mb-0">Laporkan lokasi sampah dengan cepat beserta koordinat dan deskripsi kondisi lapangan.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h4>Penjadwalan</h4>
            <p class="mb-0">Admin mengatur jadwal pengangkutan berdasarkan prioritas area dan kesiapan petugas.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h4>Monitoring</h4>
            <p class="mb-0">Petugas mencatat aktivitas lapangan sehingga progres pemungutan dapat dipantau dengan jelas.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="jadwal" class="section light-background">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
          <h2 class="mb-1">Jadwal Pengangkutan</h2>
          <p class="text-muted mb-0">Jadwal terdekat untuk proses pengangkutan sampah.</p>
        </div>
      </div>

      <div class="row gy-4">
        @forelse($jadwalPublik as $jadwal)
          <div class="col-lg-4 col-md-6">
            <div class="p-4 bg-white rounded shadow-sm h-100">
              <div class="small text-success text-uppercase mb-2">{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}</div>
              <h4 class="h5 mb-2">{{ $jadwal->area }}</h4>
              <p class="mb-2">Waktu: {{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</p>
              <p class="text-muted mb-3">{{ $jadwal->keterangan ?: 'Tidak ada keterangan tambahan.' }}</p>
              <div class="small text-muted">
                Petugas:
                @if($jadwal->petugas->isNotEmpty())
                  {{ $jadwal->petugas->pluck('nama')->join(', ') }}
                @else
                  Belum ditugaskan
                @endif
              </div>
            </div>
          </div>
        @empty
          <div class="col-12">
            <div class="p-4 bg-white rounded shadow-sm text-center">
              Belum ada jadwal pengangkutan yang tersedia.
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </section>

  <section id="kontak" class="section">
    <div class="container">
      <div class="row gy-4 align-items-stretch">
        <div class="col-lg-5">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h2 class="mb-3">Kontak</h2>
            <p>Hubungi tim TrashMan untuk dukungan sistem, informasi pelaporan, atau koordinasi pengangkutan sampah.</p>
            <div class="mb-3">
              <strong>Email:</strong><br>
              support@trashman.com
            </div>
            <div class="mb-3">
              <strong>Lokasi:</strong><br>
              Bandung, Indonesia
            </div>
            <div>
              <strong>Jam Operasional:</strong><br>
              Senin - Sabtu, 08.00 - 17.00
            </div>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="p-4 bg-white rounded shadow-sm h-100">
            <h3 class="mb-3">Informasi Layanan</h3>
            <div class="row g-3">
              <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                  <h5>Status Laporan</h5>
                  <p class="mb-0 text-muted">Pantau apakah laporan sedang menunggu, diproses, atau sudah selesai ditangani.</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="border rounded p-3 h-100">
                  <h5>Koordinasi Petugas</h5>
                  <p class="mb-0 text-muted">Petugas lapangan memperbarui status penugasan langsung dari lokasi pengangkutan.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="laporan-saya" class="section light-background">
    <div class="container">
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
          <h2 class="mb-1">Laporan Saya</h2>
          <p class="text-muted mb-0">Ringkasan laporan pungutan sampah.</p>
        </div>
        @auth
          @if(auth()->user()->role == 'user')
            <a href="{{ route('user.index') }}" class="btn btn-primary">Buka Portal Laporan</a>
          @endif
        @endauth
      </div>

      @guest
        <div class="p-4 bg-white rounded shadow-sm text-center">
          Login sebagai user untuk melihat dan mengelola laporan Anda.
        </div>
      @endguest

      @auth
        @if(auth()->user()->role == 'user')
          <div class="card border-0 shadow-sm">
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
                    @forelse($laporanSaya as $laporan)
                      <tr>
                        <td>
                          <div class="fw-bold">{{ $laporan->judul }}</div>
                          <div class="small text-muted">{{ $laporan->deskripsi ?: '-' }}</div>
                        </td>
                        <td>{{ $laporan->latitude }}, {{ $laporan->longitude }}</td>
                        <td><span class="badge bg-success text-uppercase">{{ $laporan->status }}</span></td>
                        <td>{{ $laporan->created_at?->format('d M Y H:i') }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="4" class="text-center py-4">Belum ada laporan yang tercatat.</td>
                      </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        @else
          <div class="p-4 bg-white rounded shadow-sm text-center">
            Section ini tersedia khusus untuk akun user yang membuat laporan.
          </div>
        @endif
      @endauth
    </div>
  </section>

</main>

@endsection