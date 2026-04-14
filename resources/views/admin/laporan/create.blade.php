@extends('admin.layouts.app')

@section('content')

<h1>Tambah Laporan</h1>

<form method="POST" action="{{ route('laporan.store') }}">
@csrf

<input type="text" name="judul" placeholder="Judul" class="form-control mb-2">
<input type="text" name="lokasi" placeholder="Lokasi" class="form-control mb-2">
<textarea name="deskripsi" class="form-control mb-2"></textarea>

<button class="btn btn-success">Simpan</button>

</form>

@endsection