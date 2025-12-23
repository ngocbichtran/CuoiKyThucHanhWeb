<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\{
    UserController,
    ProductController,
    CategoryController,
    OrderController
};

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| MAIN
|--------------------------------------------------------------------------
*/
Route::get('/', [shopController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD (ADMIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'CheckRole:admin'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| GOOGLE LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'CheckRole:admin'])
    ->name('admin.')
    ->group(function () {

        Route::resource('users', UserController::class);
        Route::post('users/restore/{id}', [UserController::class, 'restore'])
            ->name('users.restore');

        Route::resource('product', ProductController::class);
        Route::post('product/restore/{id}', [ProductController::class, 'restore'])
            ->name('product.restore');

        Route::resource('category', CategoryController::class);
        Route::post('category/restore/{id}', [CategoryController::class, 'restore'])
            ->name('category.restore');

        Route::resource('orders', OrderController::class);
        Route::put('orders/{id}/update-status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
});

/*
|--------------------------------------------------------------------------
| SHOP (USER)
|--------------------------------------------------------------------------
*/
Route::get('/shop', [shopController::class, 'index'])->name('shop');
Route::post('/order', [shopController::class, 'order'])->name('shop.order');

Route::get('/cart', [shopController::class, 'cart'])
    ->middleware('auth')
    ->name('cart');
