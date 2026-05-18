<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

// Halaman Utama
Route::get('/', [BlogController::class, 'home'])->name('home');

// Halaman Profile
Route::get('/profile', function () {
    return view('pages.profile');
})->name('profile');

// Halaman Contact (Let's Talk)
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Manajemen Artikel (Index, Store, Update, Destroy)
Route::get('/articles', [BlogController::class, 'index'])->name('articles.index');
Route::post('/articles', [BlogController::class, 'store'])->name('articles.store');
Route::put('/articles/{id}', [BlogController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [BlogController::class, 'destroy'])->name('articles.destroy');