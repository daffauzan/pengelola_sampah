@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4">Data Laporan Sampah</h1>

<a href="{{ route('laporan.create') }}" class="btn btn-primary mb-3">Tambah</a>

<table class="table table-bordered">
  <tr>
    <th>Judul</th>
    <th>Lokasi</th>
    <th>Aksi</th>
  </tr>

  @foreach($data as $item)
  <tr>
    <td>{{ $item->judul }}</td>
    <td>{{ $item->lokasi }}</td>
    <td>
      <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-warning">Edit</a>

      <form action="{{ route('laporan.destroy', $item->id) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger">Hapus</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>

@endsection