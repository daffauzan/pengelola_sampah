@extends('petugas.layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<div>
		<h1 class="h3 mb-1 text-gray-800">Dashboard Petugas</h1>
		<p class="mb-0 text-gray-600">Pantau penugasan pengangkutan sampah, jadwal aktif, dan progres kerja harian.</p>
	</div>
	<a href="{{ route('petugas.jadwal') }}" class="d-none d-sm-inline-block btn btn-success shadow-sm">
		<i class="fas fa-calendar-alt fa-sm text-white-50 mr-1"></i>
		Lihat Jadwal
	</a>
</div>

<div class="row">
	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Penugasan</div>
						<div class="h4 mb-0 font-weight-bold text-gray-800">{{ $totalPenugasan }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-route fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jadwal Hari Ini</div>
						<div class="h4 mb-0 font-weight-bold text-gray-800">{{ $jadwalHariIni }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-calendar-day fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jadwal Mendatang</div>
						<div class="h4 mb-0 font-weight-bold text-gray-800">{{ $jadwalMendatang }}</div>
					</div>
					<div class="col-auto">
						<i class="fas fa-truck-loading fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-7 mb-4">
		<div class="card shadow h-100">
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
				<h6 class="m-0 font-weight-bold text-success">Jadwal Pengangkutan Terdekat</h6>
				<span class="badge badge-success px-3 py-2">{{ $jadwalList->count() }} jadwal</span>
			</div>
			<div class="card-body">
				@if($jadwalList->isEmpty())
					<div class="text-center py-5">
						<i class="fas fa-calendar-times fa-3x text-gray-300 mb-3"></i>
						<p class="mb-0 text-gray-500">Belum ada jadwal pengangkutan yang ditugaskan.</p>
					</div>
				@else
					<div class="table-responsive">
						<table class="table table-bordered mb-0">
							<thead class="thead-light">
								<tr>
									<th>Tanggal</th>
									<th>Waktu</th>
									<th>Area</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								@foreach($jadwalList as $jadwal)
									<tr>
										<td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}</td>
										<td>{{ \Carbon\Carbon::parse($jadwal->waktu)->format('H:i') }}</td>
										<td>{{ $jadwal->area }}</td>
										<td>{{ $jadwal->keterangan ?: '-' }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				@endif
			</div>
		</div>
	</div>

	<div class="col-lg-5 mb-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success">Ringkasan Petugas</h6>
			</div>
			<div class="card-body">
				<div class="mb-4">
					<div class="small text-uppercase text-muted mb-1">Petugas</div>
					<div class="h5 mb-0 text-gray-800">{{ $petugas->nama }}</div>
				</div>

				<div class="mb-4">
					<div class="small text-uppercase text-muted mb-1">Jadwal Berikutnya</div>
					@if($jadwalBerikutnya)
						<div class="font-weight-bold text-gray-800">{{ $jadwalBerikutnya->area }}</div>
						<div class="text-gray-600">
							{{ \Carbon\Carbon::parse($jadwalBerikutnya->tanggal)->translatedFormat('l, d M Y') }}
							pukul {{ \Carbon\Carbon::parse($jadwalBerikutnya->waktu)->format('H:i') }}
						</div>
					@else
						<div class="text-gray-600">Tidak ada jadwal aktif.</div>
					@endif
				</div>

				<div>
					<div class="small text-uppercase text-muted mb-1">Log Aktivitas Terakhir</div>
					@if($logTerakhir)
						<div class="font-weight-bold text-gray-800 text-capitalize">{{ str_replace('_', ' ', $logTerakhir->status) }}</div>
						<div class="text-gray-600">{{ \Carbon\Carbon::parse($logTerakhir->waktu_log)->translatedFormat('d M Y H:i') }}</div>
						<div class="text-gray-600">Area: {{ $logTerakhir->jadwal->area ?? '-' }}</div>
					@else
						<div class="text-gray-600">Belum ada log aktivitas yang tercatat.</div>
					@endif
				</div>
			</div>
		</div>

		<div class="card shadow">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-success">Status Kerja Hari Ini</h6>
			</div>
			<div class="card-body">
				@php
					$progress = $jadwalHariIni > 0 ? min(100, (int) round(($jadwalHariIni > 0 ? ($logTerakhir ? 1 : 0) : 0) / $jadwalHariIni * 100)) : 0;
				@endphp
				<h4 class="small font-weight-bold">Kesiapan tugas <span class="float-right">{{ $progress }}%</span></h4>
				<div class="progress mb-3">
					<div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
				<p class="mb-0 text-gray-600">Progress ini menunjukkan kesiapan aktivitas hari ini berdasarkan jadwal yang sudah dimiliki dan log terakhir yang tercatat.</p>
			</div>
		</div>
	</div>
</div>
@endsection
