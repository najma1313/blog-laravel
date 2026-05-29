<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;

Route::get('/', [BlogController::class, 'home'])->name('home');

Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Route artikel (bisa diakses semua user)
Route::get('/articles', [BlogController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [BlogController::class, 'show'])->name('articles.show');

// Route untuk guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register', [LoginController::class, 'storeRegister']);  
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Route yang memerlukan login (auth)
Route::middleware('auth')->group(function () {
    Route::get('/articles/create', [BlogController::class, 'create'])->name('articles.create');  
    Route::get('/articles/{id}/edit', [BlogController::class, 'edit'])->name('articles.edit');  
    Route::post('/articles', [BlogController::class, 'store'])->name('articles.store');  
    Route::put('/articles/{id}', [BlogController::class, 'update'])->name('articles.update');  
    Route::delete('/articles/{id}', [BlogController::class, 'destroy'])->name('articles.destroy');  
});

Route::get('/home', function () {
    return redirect()->route('articles.index');
});