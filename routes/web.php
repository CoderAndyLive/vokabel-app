<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

// Word Routes (Resourceful)
Route::resource('words', WordController::class)->middleware('auth'); // Requires authentication

// Training Page Route
Route::get('/training', [WordController::class, 'training'])->middleware('auth')->name('training');
Route::post('/training/check-answer', [WordController::class, 'checkAnswer'])->middleware('auth')->name('words.checkAnswer');
Route::get('/training/next-word', [WordController::class, 'nextWord'])->middleware('auth')->name('words.nextWord');

// User Routes
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth');

// Admin Routes 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('admin/users', AdminController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing');