<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="d-none d-sm-inline-block text-gray-600 small">
    Panel operasional petugas pengangkutan sampah
  </div>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          {{ auth()->user()->nama ?? 'Petugas' }}
        </span>
        <img class="img-profile rounded-circle" src="{{ asset('admin/img/undraw_profile.svg') }}" alt="Foto profil">
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
        <span class="dropdown-item-text small text-gray-500">
          Role: {{ ucfirst(auth()->user()->role ?? 'petugas') }}
        </span>

        <div class="dropdown-divider"></div>

        <form action="/logout" method="POST">
          @csrf
          <button class="dropdown-item" type="submit">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            Logout
          </button>
        </form>
      </div>
    </li>
  </ul>

</nav>