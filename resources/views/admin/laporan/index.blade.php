@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4">Data Laporan Sampah</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.laporan.create') }}" class="btn btn-primary mb-3">Tambah</a>

<table class="table table-bordered">
  <tr>
    <th>Pelapor</th>
    <th>Judul</th>
    <th>Koordinat</th>
    <th>Status</th>
    <th>Aksi</th>
  </tr>

  @forelse($laporan as $item)
  <tr>
    <td>{{ $item->user->nama ?? '-' }}</td>
    <td>{{ $item->judul }}</td>
    <td>{{ $item->latitude }}, {{ $item->longitude }}</td>
    <td>{{ ucfirst($item->status) }}</td>
    <td>
      <a href="{{ route('admin.laporan.edit', $item->id) }}" class="btn btn-warning">Edit</a>

      <form action="{{ route('admin.laporan.destroy', $item->id) }}" method="POST" style="display:inline;">
        @csrf @method('DELETE')
        <button class="btn btn-danger">Hapus</button>
      </form>
    </td>
  </tr>
  @empty
  <tr>
    <td colspan="5" class="text-center">Belum ada data laporan.</td>
  </tr>
  @endforelse
</table>

@endsection