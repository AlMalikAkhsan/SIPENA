<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WargaLaporanController;
use App\Http\Controllers\AdminLaporanController;
use App\Http\Controllers\GoogleController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', [DashboardController::class, 'warga']);
});

Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', [DashboardController::class, 'warga']);

    Route::resource('/warga/laporan', WargaLaporanController::class)->names([
        'index' => 'warga.laporan.index',
        'create' => 'warga.laporan.create',
        'store' => 'warga.laporan.store',
        'show' => 'warga.laporan.show',
        'edit' => 'warga.laporan.edit',
        'update' => 'warga.laporan.update',
        'destroy' => 'warga.laporan.destroy',
    ]);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin']);

    Route::get('/admin/laporan', [AdminLaporanController::class, 'index'])->name('admin.laporan.index');
    Route::get('/admin/laporan/{id}', [AdminLaporanController::class, 'show'])->name('admin.laporan.show');
    Route::post('/admin/laporan/{id}/status', [AdminLaporanController::class, 'updateStatus'])->name('admin.laporan.status');
    Route::post('/admin/laporan/{id}/tanggapan', [AdminLaporanController::class, 'storeTanggapan'])->name('admin.laporan.tanggapan');
    Route::delete('/admin/laporan/{id}', [AdminLaporanController::class, 'destroy'])->name('admin.laporan.destroy');
});

Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
