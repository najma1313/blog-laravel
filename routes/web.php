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

// --- TAMBAHAN ROUTE EDIT & UPDATE ---
// Menampilkan FORM edit artikel berdasarkan ID
Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

// PROSES simpan perubahan (update) artikel ke database
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
// ------------------------------------

// PROSES hapus artikel berdasarkan ID
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

