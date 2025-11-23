<?php
use App\Http\Controllers\GoogleController; //Route de dang nhap bang google
use Illuminate\Support\Facades\Route;

// Route chính
Route::get('/', function () {
    return view('admin/dashboard');
})->middleware('auth') -> name('homes');


// Đăng nhập đăng ký
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 

Route::get('/dashboard', function () {
        return view('admin/dashboard');
})->middleware('auth') -> name('dashboard');


//Route de dang nhap bang google
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);