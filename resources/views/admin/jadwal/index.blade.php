@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Jadwal Pengangkutan</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary mb-3">Tambah Jadwal</a>

<div class="card shadow mb-4">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Waktu</th>
            <th>Area</th>
            <th>Petugas</th>
            <th>Dibuat Oleh</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($jadwal as $item)
            <tr>
              <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
              <td>{{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }}</td>
              <td>
                <div class="font-weight-bold">{{ $item->area }}</div>
                <div class="small text-muted">{{ $item->keterangan ?: '-' }}</div>
              </td>
              <td>
                @forelse($item->petugas as $petugasItem)
                  <span class="badge badge-success mr-1 mb-1">{{ $petugasItem->nama }}</span>
                @empty
                  <span class="text-muted">Belum ada petugas</span>
                @endforelse
              </td>
              <td>{{ $item->admin->nama ?? '-' }}</td>
              <td>
                <a href="{{ route('admin.jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.jadwal.destroy', $item->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center">Belum ada jadwal pengangkutan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection