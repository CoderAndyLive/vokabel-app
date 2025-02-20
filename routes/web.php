<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Word Routes (Resourceful)
Route::resource('words', WordController::class)->middleware('auth'); // Requires authentication

// User Routes
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

// Admin Routes (Example - Add more as needed)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('admin/users', AdminController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
