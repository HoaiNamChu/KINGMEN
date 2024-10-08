<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopCartController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// viết các route client ở đây
Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return view('client.home.index');
    });
});

// Route::get('shop-cart',[ShopCartController::class,'index'])->name('route_shopcart');
Route::get('/checkout',[CheckoutController::class,'checkout'])->name('order.checkout');
Route::post('/checkout',[CheckoutController::class,'post_checkout']);

// viết các route admin vào đây
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });
});
