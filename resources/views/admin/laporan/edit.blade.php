@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Edit Laporan</h1>

@if($errors->any())
  <div class="alert alert-danger">
    {{ $errors->first() }}
  </div>
@endif

<div class="card shadow">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.laporan.update', $laporan->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group">
        <label for="user_id">Pelapor</label>
        <select name="user_id" id="user_id" class="form-control" required>
          <option value="">Pilih pelapor</option>
          @foreach($users as $user)
            <option value="{{ $user->id }}" {{ (string) old('user_id', $laporan->user_id) === (string) $user->id ? 'selected' : '' }}>
              {{ $user->nama }} - {{ $user->email }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $laporan->judul) }}" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="deskripsi">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="latitude">Latitude</label>
          <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $laporan->latitude) }}" class="form-control" required>
        </div>

        <div class="form-group col-md-6">
          <label for="longitude">Longitude</label>
          <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $laporan->longitude) }}" class="form-control" required>
        </div>
      </div>

      <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control" required>
          <option value="pending" {{ old('status', $laporan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="diproses" {{ old('status', $laporan->status) == 'diproses' ? 'selected' : '' }}>Diproses</option>
          <option value="selesai" {{ old('status', $laporan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
      </div>

      <button class="btn btn-success" type="submit">Update</button>
      <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

@endsection