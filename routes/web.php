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
    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create'); 
    Route::get('/admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [AdminController::class, 'update'])->name('admin.users.update'); 
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing');
Route::get('/logged-in', function () {
    return view('admin.index');
})->name('logged-in');
