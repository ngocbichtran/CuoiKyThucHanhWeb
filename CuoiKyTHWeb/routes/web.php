<?php

use Illuminate\Support\Facades\Route;

// Route chính
Route::get('/', function () {
    return view('home');
});


// Đăng nhập đăng ký
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 

Route::get('/dashboard', function () {
        return view('admin.dashboard');
})->middleware('auth') -> name('dashboard');
