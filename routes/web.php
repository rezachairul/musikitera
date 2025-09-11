<?php

use Illuminate\Support\Facades\Route;

// ==========================
// Auths
// ==========================
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;


// ==========================
// Adnmins
// ==========================


// ==========================
// Publics
// ==========================
use App\Http\Controllers\public\HomeController;
use App\Http\Controllers\Auth\RegisterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth routes
Route::prefix('auth')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('logout', [LoginController::class, 'logout'])->name('login.logout');

    // Register
    Route::get('register', [RegisterController::class, 'register'])->name('register')->middleware('guest');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');
});



// Public routes
Route::middleware('guest')->prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('public.index');
});

// Admin routes
// Dashboard sederhana
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.index');
});
