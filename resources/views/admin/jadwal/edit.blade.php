@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Edit Jadwal Pengangkutan</h1>

@if($errors->any())
  <div class="alert alert-danger">{{ $errors->first() }}</div>
@endif

<div class="card shadow">
  <div class="card-body">
    <form method="POST" action="{{ route('admin.jadwal.update', $jadwal->id) }}">
      @csrf
      @method('PUT')

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="tanggal">Tanggal</label>
          <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $jadwal->tanggal) }}" class="form-control" required>
        </div>

        <div class="form-group col-md-6">
          <label for="waktu">Waktu</label>
          <input type="time" name="waktu" id="waktu" value="{{ old('waktu', \Carbon\Carbon::parse($jadwal->waktu)->format('H:i')) }}" class="form-control" required>
        </div>
      </div>

      <div class="form-group">
        <label for="area">Area</label>
        <input type="text" name="area" id="area" value="{{ old('area', $jadwal->area) }}" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea name="keterangan" id="keterangan" class="form-control" rows="4">{{ old('keterangan', $jadwal->keterangan) }}</textarea>
      </div>

      <div class="form-group">
        <label for="petugas_id">Petugas</label>
        <select name="petugas_id[]" id="petugas_id" class="form-control" multiple>
          @foreach($petugas as $item)
            <option value="{{ $item->id }}" {{ collect(old('petugas_id', $jadwal->petugas->pluck('id')->all()))->contains($item->id) ? 'selected' : '' }}>
              {{ $item->nama }} - {{ $item->email }}
            </option>
          @endforeach
        </select>
        <small class="form-text text-muted">Gunakan Ctrl atau Cmd untuk memilih lebih dari satu petugas.</small>
      </div>

      <button type="submit" class="btn btn-success">Update</button>
      <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Batal</a>
    </form>
  </div>
</div>

@endsection