<?php
use App\Http\Controllers\GoogleController; //Route de dang nhap bang google
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
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



//Hiện database
Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('category', CategoryController::class);
    Route::post('category/action', [UserController::class, 'action'])->name('category.action');

    Route::resource('users', UserController::class);
    Route::post('user/action', [UserController::class, 'action'])->name('users.action');

    Route::resource('product', ProductController::class);
    Route::post('product/action', [ProductController::class, 'action'])->name('product.action');

    Route::resource('orders', App\Http\Controllers\admin\OrderController::class);
});

Route::put('orders/{id}/update-status', [OrderController::class, 'updateStatus'])
    ->name('admin.orders.updateStatus');
// //Route shop (trang shop)
use App\Http\Controllers\ShopController;

// 1. ROUTE CHÍNH: Hiển thị danh sách sản phẩm
Route::get('/shop', [ShopController::class, 'index'])->name('shop');


Route::post('/order', [ShopController::class, 'order'])->name('shop.order');

  
