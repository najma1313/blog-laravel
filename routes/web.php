<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/articles', function () {
    return view('articles');
});

Route::get('/contact', function () {
    return view('contact');
});