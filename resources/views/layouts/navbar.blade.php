<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center">

    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">TrashMan</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="/" class="active">Home</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="#layanan">Layanan</a></li>
        <li><a href="#jadwal">Jadwal</a></li>
        <li><a href="#kontak">Kontak</a></li>

        @auth
          @if(auth()->user()->role == 'user')
            <li><a href="/laporan">Laporan Saya</a></li>
          @elseif(auth()->user()->role == 'admin')
            <li><a href="/admin/laporan">Manajemen Laporan</a></li>
          @elseif(auth()->user()->role == 'petugas')
            <li><a href="/petugas/jadwal">Jadwal Tugas</a></li>
          @endif
        @endauth
      </ul>

      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    {{-- AUTH BUTTON --}}
    @guest
      <a class="btn-getstarted" href="/login">Login</a>
    @endguest

    @auth
      @if(auth()->user()->role == 'user')
        <a class="btn-getstarted" href="/dashboard">Dashboard</a>
      @elseif(auth()->user()->role == 'admin')
        <a class="btn-getstarted" href="/admin/dashboard">Admin</a>
      @elseif(auth()->user()->role == 'petugas')
        <a class="btn-getstarted" href="/petugas/dashboard">Petugas</a>
      @endif

      <form action="/logout" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn-getstarted" style="border:none;">
          Logout
        </button>
      </form>
    @endauth

  </div>
</header>