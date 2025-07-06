<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController; 
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PasswordController;

Route::get('/', [LandingController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/password', [PasswordController::class, 'update'])->name('profile.password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/reset-password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/reset-password', [PasswordController::class, 'update'])->name('password.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/report', fn() => view('report'));
    Route::post('/report/send', [ReportController::class, 'store'])->name('report.send');
    Route::get('/riwayat', [ReportController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/{id}', [ReportController::class, 'detail'])->name('riwayat.detail');
});

Route::get('/test-session', function () {
    session(['test' => 'oke']);
    return session('test');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/informasi', [AdminLaporanController::class, 'informasi'])->name('informasi');
    Route::get('laporan/{id}', [AdminLaporanController::class, 'detail'])->name('laporan.detail');
    Route::patch('laporan/{id}/update-status', [AdminLaporanController::class, 'updateStatus'])->name('laporan.updateStatus');
});
Route::patch('/admin/berita/banner/{id}', [AdminController::class, 'toggleBanner'])->name('admin.toggle_banner');

Route::get('/migrate', function () {
    try {
        Artisan::call('migrate', ['--force' => true]);
        return 'Migration success!';
    } catch (\Exception $e) {
        return 'Migration failed: ' . $e->getMessage();
    }
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
