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

// Auth routes
Route::prefix('auth')->group(function () {
    // Login
    Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
    Route::post('login', [LoginController::class, 'authenticate'])->name('login.authenticate');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

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
