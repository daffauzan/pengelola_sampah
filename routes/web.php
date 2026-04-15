<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Models\JadwalPengangkutan;
use App\Models\LaporanSampah;
use App\Models\LogPetugas;
use App\Http\Controllers\Petugas\JadwalController as PetugasJadwalController;
use App\Http\Controllers\Admin\AdminJadwalController;
use App\Http\Controllers\Admin\AdminLogController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminPetugasController;

Route::get('/', function () {
    $jadwalPublik = JadwalPengangkutan::with('petugas')
        ->whereDate('tanggal', '>=', now()->toDateString())
        ->orderBy('tanggal')
        ->orderBy('waktu')
        ->take(6)
        ->get();

    $laporanSaya = collect();

    if (auth()->check() && auth()->user()->role === 'user') {
        $laporanSaya = LaporanSampah::where('user_id', auth()->id())
            ->latest()
            ->take(5)
            ->get();
    }

    return view('public.index', compact('jadwalPublik', 'laporanSaya'));
});

Route::middleware('guest')->group(function () {
    Route::get('/auth/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::get('/auth/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::redirect('/login', '/auth/login');
    Route::redirect('/register', '/auth/register');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/index', [LaporanController::class, 'index'])->name('user.index');

    Route::get('/dashboard', function () {
        return redirect()->route('user.index');
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

        Route::get('/', function () {
            return redirect()->route('admin.index');
        })->name('dashboard');

        Route::get('/index', function () {
            return view('admin.index');
        })->name('index');

        Route::resource('jadwal', AdminJadwalController::class);
        Route::resource('petugas', AdminPetugasController::class);
        Route::get('log', [AdminLogController::class, 'index'])->name('log.index');

        Route::get('laporan/create', [AdminLaporanController::class, 'create'])->name('laporan.create');
        Route::post('laporan', [AdminLaporanController::class, 'store'])->name('laporan.store');
        Route::get('laporan/{id}/edit', [AdminLaporanController::class, 'edit'])->name('laporan.edit');
        Route::put('laporan/{id}', [AdminLaporanController::class, 'update'])->name('laporan.update');
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
            return redirect()->route('petugas.jadwal');
        })->name('dashboard');

        Route::get('/jadwal', [PetugasJadwalController::class, 'index'])->name('jadwal');
        Route::get('/jadwal/{id}', [PetugasJadwalController::class, 'show'])->name('jadwal.show');
        Route::post('/jadwal/{id}/status', [PetugasJadwalController::class, 'updateStatus'])->name('jadwal.updateStatus');
});
