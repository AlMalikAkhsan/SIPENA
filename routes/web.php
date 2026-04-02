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
use App\Http\Controllers\Admin\UserController;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ========================
// HALAMAN UTAMA
// ========================
Route::get('/', function () {
    return view('welcome');
});

// ========================
// AUTH (tidak perlu verified)
// ========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Login
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// ========================
// EMAIL VERIFICATION
// (harus SEBELUM route warga/admin,
//  dan tidak pakai middleware 'verified')
// ========================

// Halaman "cek email kamu dulu"
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Saat user klik link di email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    // Paksa update langsung ke database sebagai backup
    \App\Models\User::where('id', $request->route('id'))
        ->whereNull('email_verified_at')
        ->update(['email_verified_at' => now()]);

    $user = $request->user();
    if ($user && $user->role === 'admin') {
        return redirect('/admin/dashboard')->with('success', 'Email berhasil diverifikasi! 🎉');
    }
    return redirect('/warga/dashboard')->with('success', 'Email berhasil diverifikasi! 🎉');

})->middleware(['auth', 'signed'])->name('verification.verify');

// Kirim ulang link verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang! Cek inbox atau spam kamu.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// ========================
// PUBLIK (tanpa login)
// ========================
Route::get('/laporan-publik', [WargaLaporan::class, 'publik'])->name('laporan.publik');
Route::get('/laporan-publik/{id}', [WargaLaporan::class, 'detailPublik'])->name('laporan.publik.detail');

// ========================
// WARGA
// (tambah 'verified' agar hanya email
//  terverifikasi yang bisa akses)
// ========================
Route::middleware(['auth', 'verified', 'role:warga'])
    ->prefix('warga')
    ->name('warga.')
    ->group(function () {

    Route::get('/dashboard', [WargaDashboard::class, 'warga'])->name('dashboard');

    // ⚠️ Route khusus HARUS SEBELUM resource
    Route::get('/laporan/semua', [WargaDashboard::class, 'semua'])->name('laporan.semua');
    Route::get('/laporan/detail/{id}', [WargaLaporan::class, 'detailUmum'])->name('laporan.detail_umum');
    Route::get('/laporan/riwayat', [WargaLaporan::class, 'riwayat'])->name('laporan.riwayat');
    Route::post('/laporan/{id}/archive', [WargaLaporan::class, 'archive'])->name('laporan.archive');
    Route::post('/laporan/{id}/unarchive', [WargaLaporan::class, 'unarchive'])->name('laporan.unarchive');

    // Resource route HARUS di bawah route khusus
    Route::resource('/laporan', WargaLaporan::class);
    Route::resource('/saran', WargaSaran::class);
    Route::resource('/feedback', WargaFeedback::class)->only(['index', 'store', 'create']);

    // Profile
    Route::get('/profile', [WargaDashboard::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [WargaDashboard::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [WargaDashboard::class, 'updateProfile'])->name('profile.update');
});

// ========================
// ADMIN
// (admin tidak wajib verified,
//  tapi bisa ditambah jika perlu)
// ========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Laporan
    Route::resource('/laporan', AdminLaporan::class);
    Route::post('/laporan/{id}/status', [AdminLaporan::class, 'updateStatus'])->name('laporan.status');
    Route::post('/laporan/{id}/reject', [AdminLaporan::class, 'reject'])->name('laporan.reject');

    // Saran
    Route::resource('/saran', AdminSaran::class)->only(['index', 'show', 'destroy']);
    Route::post('/saran/{id}/status', [AdminSaran::class, 'updateStatus'])->name('saran.status');
    Route::post('/saran/{id}/tanggapi', [AdminSaran::class, 'tanggapi'])->name('saran.tanggapi');

    // Tanggapan
    Route::post('/tanggapan', [TanggapanController::class, 'store'])->name('tanggapan.store');
    Route::delete('/tanggapan/{id}', [TanggapanController::class, 'destroy'])->name('tanggapan.destroy');

    // Export
    Route::get('/laporan/export/pdf', [ExportController::class, 'laporanPdf'])->name('laporan.export.pdf');

    // User Management
    Route::resource('/users', UserController::class);
    Route::get('/users-statistics', [UserController::class, 'statistics'])->name('users.statistics');
    Route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');
    Route::get('/users-export', [UserController::class, 'export'])->name('users.export');
});