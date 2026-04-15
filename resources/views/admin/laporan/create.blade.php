@extends('admin.layouts.app')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Tambah Laporan</h1>

@if($errors->any())
	<div class="alert alert-danger">
		{{ $errors->first() }}
	</div>
@endif

<div class="card shadow">
	<div class="card-body">
		<form method="POST" action="{{ route('admin.laporan.store') }}">
			@csrf

			<div class="form-group">
				<label for="user_id">Pelapor</label>
				<select name="user_id" id="user_id" class="form-control" required>
					<option value="">Pilih pelapor</option>
					@foreach($users as $user)
						<option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
							{{ $user->nama }} - {{ $user->email }}
						</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="judul">Judul</label>
				<input type="text" name="judul" id="judul" value="{{ old('judul') }}" class="form-control" required>
			</div>

			<div class="form-group">
				<label for="deskripsi">Deskripsi</label>
				<textarea name="deskripsi" id="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
			</div>

			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="latitude">Latitude</label>
					<input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" class="form-control" required>
				</div>

				<div class="form-group col-md-6">
					<label for="longitude">Longitude</label>
					<input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label for="status">Status</label>
				<select name="status" id="status" class="form-control" required>
					<option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
					<option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
					<option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
				</select>
			</div>

			<button class="btn btn-success" type="submit">Simpan</button>
			<a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Batal</a>
		</form>
	</div>
</div>

@endsection