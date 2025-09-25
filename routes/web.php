<?php

use Illuminate\Support\Facades\Route;

// ==========================
// Auths
// ==========================
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;


// ==========================
// Adnmins
// ==========================
// Administrator
use App\Http\Controllers\admin\administrator\DashboardController;
use App\Http\Controllers\admin\administrator\ManageUserController;

// Badan Pengurus
// Dashboard
// BPH
use App\Http\Controllers\admin\bph\DashboardBPHController;
use App\Http\Controllers\admin\bph\manajemen_konten\HeroController;
use App\Http\Controllers\admin\bph\kerjasama_mitra\ManageMitraController;
use App\Http\Controllers\admin\bph\manajemen_anggota\AnggotaAktifController;
use App\Http\Controllers\admin\bph\manajemen_anggota\ManagePembinaController;



// Dewan Pengawas
use App\Http\Controllers\admin\dpo\DashboardDPOController;

// Pembina
use App\Http\Controllers\admin\pembina\DashboardPembinaController;

// ==========================
// Publics
// ==========================
use App\Http\Controllers\public\HomeController;


// ==========================
// TEST ERROR PAGES
// ==========================

Route::get('/test-error/401', function () {
    $title = '401 Unauthorized';
    return response()->view('errors.401', compact('title'), 401);
})->name('errors.401');

Route::get('/test-error/403', function () {
    $title = '403 Forbidden';
    return response()->view('errors.403', compact('title'), 403);
})->name('errors.403');

Route::get('/test-error/404', function () {
    $title = '404 Not Found';
    return response()->view('errors.404', compact('title'), 404);
})->name('errors.404');

Route::get('/test-error/419', function () {
    $title = '419 Page Expired';
    return response()->view('errors.419', compact('title'), 419);
})->name('errors.419');

Route::get('/test-error/429', function () {
    $title = '429 Too Many Requests';
    return response()->view('errors.429', compact('title'), 429);
})->name('errors.429');

Route::get('/test-error/500', function () {
    $title = '500 Internal Server Error';
    return response()->view('errors.500', compact('title'), 500);
})->name('errors.500');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==========================
// Auths routes
// ==========================
Route::prefix('auth')->group(function () {
    // Login & Register hanya untuk guest
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
        Route::get('register', [RegisterController::class, 'register'])->name('register');
        Route::post('register', [RegisterController::class, 'store'])->name('register.store');
    });

    // Logout & dashboard hanya untuk auth
    Route::middleware('auth')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    });

    // Forgot Password (guest juga biasanya)
    Route::middleware('guest')->group(function () {
        Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    });
});


// ==========================
// Public routes
// ==========================
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('public.index');
});


// ==========================
// Admin routes
// ==========================

// Admins Routes
Route::middleware(['auth:web', 'role:admin'])->prefix('administrator')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Manage users
    Route::controller(ManageUserController::class)->prefix('manage-user')->name('manage-user.')->group(function () {
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::put('/{id}','update')->name('update');
        Route::delete('/{id}','destroy')->name('destroy');
        Route::get('/export',  'export')->name('export');
    });



});

// Admins Badan Pengurus Routes
Route::middleware(['auth', 'role:bph'])->prefix('badan-pengurus')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardBPHController::class, 'index'])->name('bph.dashboard.index');

    // Manajemen Anggota Aktif
    // Anggota
    Route::controller(AnggotaAktifController::class)->prefix('anggota')->name('anggota-aktif.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::put('/{id}','update')->name('update');
        Route::delete('/{id}','destroy')->name('destroy');
        Route::get('/export',  'export')->name('export');
    });

    // Manajemen Badan Pengurus
    // Route::controller(AnggotaAktifController::class)->prefix('anggota-aktif')->name('anggota-aktif.')->group(function(){
    //     Route::get('/','index')->name('index');
    //     Route::post('/','store')->name('store');
    //     Route::put('/{id}','update')->name('update');
    //     Route::delete('/{id}','destroy')->name('destroy');
    //     Route::get('/export',  'export')->name('export');
    // });

    // Manajemen Alumni
    // Route::controller(AnggotaAktifController::class)->prefix('anggota-aktif')->name('anggota-aktif.')->group(function(){
    //     Route::get('/','index')->name('index');
    //     Route::post('/','store')->name('store');
    //     Route::put('/{id}','update')->name('update');
    //     Route::delete('/{id}','destroy')->name('destroy');
    //     Route::get('/export',  'export')->name('export');
    // });

    // Manajemen Pembina
    Route::controller(ManagePembinaController::class)->prefix('manage-pembina')->name('manage-pembina.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::put('/{id}','update')->name('update');
        Route::delete('/{id}','destroy')->name('destroy');
        Route::get('/export',  'export')->name('export');
    });

    // Manajemen Konten
    // Hero
    Route::controller(HeroController::class)->prefix('hero')->name('manage-hero.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::put('/{id}','update')->name('update');
        Route::delete('/{id}','destroy')->name('destroy');
        Route::get('/export',  'export')->name('export');
    });

    // Profil Organisasi
    // Layanan
    // Statistik Publik
    // Galeri
    // Highlight Kegiatan
    // Apa Kata Mereka
    // CTA (Oprec)

    // Publikasi dan Dokumentasi



    // Kerjasama dan Mitara
    // Kerjasama

    // Mitra
    // Internal
    Route::controller(ManageMitraController::class)->prefix('mitra')->name('manage-mitra.')->group(function(){
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::put('/{id}','update')->name('update');
        Route::delete('/{id}','destroy')->name('destroy');
        Route::get('/export',  'export')->name('export');
    });

    // Eksternal

});

// Admins Dewan Pengawas Routes
Route::middleware(['auth', 'role:dpo'])->prefix('dewan-pengawas')->group(function () {
    Route::get('/dashboard', [DashboardDPOController::class, 'index'])->name('dpo.dashboard.index');
});

// Admins Pembina Routes ( Soon )
Route::middleware(['auth', 'role:pembina'])->prefix('pembina')->group(function () {
    Route::get('/dashboard', [DashboardPembinaController::class, 'index'])->name('pembina.dashboard.index');
});
