<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminPetugasController;

Route::get('/', function () {
    return view('public.index');
});

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::post('/', [LaporanController::class, 'store'])->name('store');
    });
});

// Role Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('dashboard');

        Route::resource('jadwal', AdminJadwalController::class);
        Route::resource('petugas', AdminPetugasController::class);

        Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/{id}', [AdminLaporanController::class, 'show'])->name('laporan.show');
        Route::delete('laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('laporan.destroy');
        Route::patch('laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
});

// Role Petugas
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('petugas.index');
        })->name('dashboard');

        Route::get('/jadwal', [AdminJadwalController::class, 'index'])->name('jadwal');
});
