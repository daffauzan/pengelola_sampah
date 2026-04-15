@extends('admin.layouts.app')

@section('title', 'Data Petugas')

@section('content')

<h1 class="h3 mb-4 text-gray-800">Data Petugas</h1>

@if(session('success'))
	<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.petugas.create') }}" class="btn btn-primary mb-3">Tambah Petugas</a>

<div class="card shadow mb-4">
	<div class="card-body p-0">
		<div class="table-responsive">
			<table class="table table-bordered mb-0">
				<thead>
					<tr>
						<th>Nama</th>
						<th>Email</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@forelse($data as $item)
						<tr>
							<td>{{ $item->nama }}</td>
							<td>{{ $item->email }}</td>
							<td>
								<a href="{{ route('admin.petugas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
								<form action="{{ route('admin.petugas.destroy', $item->id) }}" method="POST" style="display:inline;">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
								</form>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="3" class="text-center">Belum ada petugas yang terdaftar.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection
