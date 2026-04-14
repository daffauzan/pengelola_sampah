<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.layouts.head')
</head>

<body id="page-top">

<div id="wrapper">

  @include('admin.layouts.sidebar')

  <div id="content-wrapper" class="d-flex flex-column">
    <div id="content">

      @include('admin.layouts.topbar')

      <div class="container-fluid">
        @yield('content')
      </div>

    </div>

    @include('admin.layouts.footer')

  </div>

</div>

<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

@include('admin.layouts.scripts')

</body>
</html>