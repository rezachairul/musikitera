<?php

// ==========================
// Auths
// ==========================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\public\HomeController;

// ==========================
// Adnmins
// ==========================


// ==========================
// Publics
// ==========================


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth routes
// Route::prefix('auth')->group(function () {
//     Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
//     Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
//     Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');
// });


// Public routes
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('public.index');
});

// Admin routes


// Route::get('/', function () {
//     return view('welcome');
// });