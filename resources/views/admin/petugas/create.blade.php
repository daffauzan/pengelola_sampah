@extends('admin.layouts.app')

@section('title', 'Tambah Petugas')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Tambah Petugas</h1>

@if($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="card shadow">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.petugas.store') }}">
      @csrf

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
      </div>

      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="togglePasswordVisibility">
        <label class="form-check-label" for="togglePasswordVisibility">Tampilkan password</label>
      </div>

      <div class="alert alert-info small">
        Gunakan password minimal 8 karakter.
      </div>

      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.getElementById('togglePasswordVisibility');
    const password = document.getElementById('password');
    const confirmation = document.getElementById('password_confirmation');

    if (!toggle || !password || !confirmation) {
      return;
    }

    toggle.addEventListener('change', function () {
      const inputType = this.checked ? 'text' : 'password';
      password.type = inputType;
      confirmation.type = inputType;
    });
  });
</script>
@endpush