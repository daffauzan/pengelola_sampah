<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Index - Logis Bootstrap Template')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="data:." rel="icon">
  <!-- <link href="#" rel="apple-touch-icon"> -->

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <style>
    :root {
      --heading-color: #0f5132;
      --accent-color: #1cc88a;
      --nav-color: rgba(255, 255, 255, 0.85);
      --nav-hover-color: #ffffff;
      --nav-dropdown-hover-color: #1cc88a;
    }

    .dark-background {
      --background-color: #114a38;
      --surface-color: #166443;
    }

    .header {
      --background-color: rgba(17, 74, 56, 0.92);
      --heading-color: #ffffff;
      backdrop-filter: blur(10px);
    }

    .scrolled .header {
      --background-color: rgba(15, 81, 50, 0.96);
    }

    .header .logo h1 {
      color: #ffffff;
    }

    .navmenu a,
    .navmenu a:focus,
    .mobile-nav-toggle {
      color: var(--nav-color);
    }

    .navmenu li:hover > a,
    .navmenu .active,
    .navmenu .active:focus,
    .navmenu a:hover,
    .navmenu a:focus:hover {
      color: var(--nav-hover-color);
    }

    .btn-primary {
      color: #fff;
      background-color: #1cc88a;
      border-color: #1cc88a;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active {
      color: #fff;
      background-color: #17a673;
      border-color: #17a673;
      box-shadow: 0 0 0 0.2rem rgba(28, 200, 138, 0.25);
    }

    .header .btn-getstarted,
    .header .btn-getstarted:focus {
      background: linear-gradient(180deg, #1cc88a 10%, #13855c 100%);
      border: none;
    }

    .header .btn-getstarted:hover,
    .header .btn-getstarted:focus:hover {
      background: linear-gradient(180deg, #20d090 10%, #149764 100%);
    }
  </style>
</head>

<body class="@yield('body_class', '')">

  @include('layouts.navbar')

  @yield('content')

  @include('layouts.footer')

  <!-- Vendor JS Files -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('js/main.js') }}"></script>

  @stack('scripts')
</body>

</html>
