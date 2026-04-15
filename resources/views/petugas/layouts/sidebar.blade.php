<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('petugas.jadwal') }}">
    <div class="sidebar-brand-icon">
      <i class="fas fa-truck"></i>
    </div>
    <div class="sidebar-brand-text mx-3">TrashMan</div>
  </a>

  <hr class="sidebar-divider">

  <li class="nav-item {{ request()->routeIs('petugas.jadwal*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('petugas.jadwal') }}">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Jadwal Tugas</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">Operasional</div>

  <li class="nav-item">
    <span class="nav-link text-white-50 small">
      Petugas hanya dapat melihat jadwal dan memperbarui status pemungutan sampah.
    </span>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>