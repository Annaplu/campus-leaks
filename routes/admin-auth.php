<?php 

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;  
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InformasiController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware('guest:admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])->name('register');
    Route::post('register', [RegisteredAdminController::class, 'store']);
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);
    
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/ambil-berita', function () {
        Artisan::call('scrape:metanoiac');
        return redirect()->back()->with('success', 'Berita terbaru berhasil diambil.');
    })->name('admin.ambil_berita');
    
    Route::post('/admin/ambil-berita', function () {
        Artisan::call('scrape:metanoiac');
        return redirect()->back()->with('success', 'Berita terbaru berhasil diambil.');
    })->name('admin.ambil_berita');


    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');

    Route::get('/informasi', [InformasiController::class, 'index'])->name('admin.informasi');
    Route::get('/admin/pengguna', [PenggunaController::class, 'pengguna'])->name('admin.pengguna');


    Route::get('/pengguna', [PenggunaController::class, 'pengguna'])->name('admin.pengguna');
    Route::get('/pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
    Route::put('/pengguna/{id}', [PenggunaController::class, 'update'])->name('admin.pengguna.update');
    Route::delete('/pengguna/{id}', [PenggunaController::class, 'destroy'])->name('admin.pengguna.destroy');
});





