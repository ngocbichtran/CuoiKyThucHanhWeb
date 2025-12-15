<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| DASHBOARD (TRANG CHÍNH)
|--------------------------------------------------------------------------
| BẮT BUỘC gọi controller để có dữ liệu
*/
Route::get('/', [DashboardController::class, 'index'])
    ->middleware('auth')
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
Route::prefix('admin')->middleware('auth') ->name('admin.') ->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('orders', OrderController::class);
});
Route::post('admin/users/restore/{id}', [UserController::class, 'restore'])->name('admin.users.restore');
Route::post('admin/category/restore/{id}', [CategoryController::class, 'restore'])->name('admin.category.restore');
Route::post('admin/product/restore/{id}', [ProductController::class, 'restore'])->name('admin.product.restore');
Route::put('orders/{id}/update-status', [OrderController::class, 'updateStatus'])
    ->name('admin.orders.updateStatus');
/*
|--------------------------------------------------------------------------
| SHOP
|--------------------------------------------------------------------------
*/
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::post('/order', [ShopController::class, 'order'])->name('shop.order');
Route::get('/cart', [ShopController::class, 'cart'])
    ->middleware('auth')
    ->name('cart');
