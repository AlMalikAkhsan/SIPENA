<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;

// WARGA
use App\Http\Controllers\Warga\DashboardController as WargaDashboard;
use App\Http\Controllers\Warga\LaporanController as WargaLaporan;
use App\Http\Controllers\Warga\SaranController as WargaSaran;
use App\Http\Controllers\Warga\FeedbackController as WargaFeedback;

// ADMIN
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\LaporanController as AdminLaporan;
use App\Http\Controllers\Admin\SaranController as AdminSaran;
use App\Http\Controllers\Admin\FeedbackController as AdminFeedback;
use App\Http\Controllers\Admin\TanggapanController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\UserController;  // TAMBAHAN UNTUK USER MANAGEMENT

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ========================
// AUTH
// ========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Login
Route::get('/auth/google', [GoogleController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// ========================
// PUBLIK (JAKI MODE)
// ========================
Route::get('/laporan-publik', [WargaLaporan::class, 'publik'])->name('laporan.publik');
Route::get('/laporan-publik/{id}', [WargaLaporan::class, 'detailPublik'])->name('laporan.publik.detail');

// ========================
// WARGA
// ========================
Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(function () {

    Route::get('/dashboard', [WargaDashboard::class, 'warga'])->name('dashboard');
    
    // ⚠️ PENTING: Route khusus HARUS SEBELUM resource routes
    // Jika diletakkan setelah resource, Laravel akan menganggap 'semua' sebagai {id}
    
    // Route semua laporan - HARUS SEBELUM resource
    Route::get('/laporan/semua', [WargaDashboard::class, 'semua'])->name('laporan.semua');
    
    // Route detail umum untuk melihat laporan orang lain - HARUS SEBELUM resource
    Route::get('/laporan/detail/{id}', [WargaLaporan::class, 'detailUmum'])->name('laporan.detail_umum');
    
    // Route riwayat - HARUS SEBELUM resource
    Route::get('/laporan/riwayat', [WargaLaporan::class, 'riwayat'])->name('laporan.riwayat');
    Route::post('/laporan/{id}/archive', [WargaLaporan::class, 'archive'])->name('laporan.archive');
    Route::post('/laporan/{id}/unarchive', [WargaLaporan::class, 'unarchive'])->name('laporan.unarchive');
    
    // Resource route - HARUS DI BAWAH route khusus
    Route::resource('/laporan', WargaLaporan::class);
    
    Route::resource('/saran', WargaSaran::class);
    Route::resource('/feedback', WargaFeedback::class)->only(['index','store','create']);

    // Profile Routes
    Route::get('/profile', [WargaDashboard::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [WargaDashboard::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [WargaDashboard::class, 'updateProfile'])->name('profile.update');
});

// ========================
// ADMIN
// ========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])
        ->name('dashboard');

    // ================== LAPORAN ==================
    Route::resource('/laporan', AdminLaporan::class);
    Route::post('/laporan/{id}/status', [AdminLaporan::class, 'updateStatus'])
        ->name('laporan.status');
    Route::post('/laporan/{id}/reject', [AdminLaporan::class, 'reject'])
        ->name('laporan.reject');

    // ================== SARAN ==================
    Route::resource('/saran', AdminSaran::class)
        ->only(['index', 'show', 'destroy']);
    Route::post('/saran/{id}/status', [AdminSaran::class, 'updateStatus'])
        ->name('saran.status');
    Route::post('/saran/{id}/tanggapi', [AdminSaran::class, 'tanggapi'])
        ->name('saran.tanggapi');

    // ================== TANGGAPAN ==================
    Route::post('/tanggapan', [TanggapanController::class, 'store'])
        ->name('tanggapan.store');
    Route::delete('/tanggapan/{id}', [TanggapanController::class, 'destroy'])
        ->name('tanggapan.destroy');

    // ================== EXPORT ==================
    Route::get('/laporan/export/pdf', [ExportController::class, 'laporanPdf'])
        ->name('laporan.export.pdf');

    // ================== USER MANAGEMENT ==================
    // Resource routes untuk CRUD user
    Route::resource('/users', UserController::class);
    
    // Additional user management routes
    Route::get('/users-statistics', [UserController::class, 'statistics'])
        ->name('users.statistics');
    Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])
        ->name('users.bulk-delete');
    Route::get('/users-export', [UserController::class, 'export'])
        ->name('users.export');
});

Route::get('/', function () {
    return view('welcome');
});

//NOTE: Route untuk email verification
// Notice
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// Handle link verification
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend verification
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi dikirim ulang!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
