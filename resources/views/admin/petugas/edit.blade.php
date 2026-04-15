@extends('admin.layouts.app')

@section('title', 'Edit Petugas')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Edit Petugas</h1>

@if($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="card shadow">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.petugas.update', $data->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama', $data->nama) }}" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $data->email) }}" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
      <a href="{{ route('admin.petugas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

@endsection