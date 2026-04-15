<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
    <div class="sidebar-brand-icon">
      <i class="fas fa-recycle"></i>
    </div>
    <div class="sidebar-brand-text mx-3">TrashMan</div>
  </a>

  <hr class="sidebar-divider">

  <li class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('admin.index') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="sidebar-heading">Manajemen</div>

  <li class="nav-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.laporan.index') }}">
      <i class="fas fa-trash"></i>
      <span>Laporan Sampah</span>
    </a>
  </li>

  <li class="nav-item {{ request()->routeIs('admin.jadwal.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.jadwal.index') }}">
      <i class="fas fa-calendar"></i>
      <span>Jadwal Pengangkutan</span>
    </a>
  </li>

  <li class="nav-item {{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.petugas.index') }}">
      <i class="fas fa-users"></i>
      <span>Petugas</span>
    </a>
  </li>

  <li class="nav-item {{ request()->routeIs('admin.log.*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.log.index') }}">
      <i class="fas fa-history"></i>
      <span>Log Aktivitas</span>
    </a>
  </li>

  <hr class="sidebar-divider">

  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>