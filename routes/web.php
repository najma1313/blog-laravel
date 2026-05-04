<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Route Halaman Statis
Route::get('/', function () {
    return view('home');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/contact', function () {
    return view('contact');
});

// Route CRUD Articles
// Menampilkan daftar artikel
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// Menampilkan FORM tambah artikel
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');

// PROSES simpan artikel ke database
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

// PROSES hapus artikel berdasarkan ID
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');