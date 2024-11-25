<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use Illuminate\Support\Facades\Auth;
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
    Auth::loginUsingId(1);
    Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
    Route::get('/shop', [\App\Http\Controllers\Client\ShopController::class, 'index'])->name('shop');
    Route::get('/about', [\App\Http\Controllers\Client\AboutController::class, 'index'])->name('about');
    Route::get('/blog', [\App\Http\Controllers\Client\BlogController::class, 'index'])->name('blog');
    Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'index'])->name('contact');


    //cart routes
    Route::get('/cart', [\App\Http\Controllers\Client\CartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::post('/cart', [\App\Http\Controllers\Client\CartController::class, 'store'])->name('cart.store')->middleware('auth');
    Route::put('/cart/{id}', [\App\Http\Controllers\Client\CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::delete('/cart/clear/{id}', [\App\Http\Controllers\Client\CartController::class, 'clear'])->name('cart.clear')->middleware('auth');
    Route::delete('/cart/{id}', [\App\Http\Controllers\Client\CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

    Route::prefix('/product')
        ->as('product.')
        ->group(function () {
        Route::get('/{slug}', [\App\Http\Controllers\Client\ProductController::class, 'detail'])->name('detail');
    });

});




// viết các route admin vào đây
Route::prefix('/admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('attributes', AttributeController::class);
        Route::resource('attributeValues', AttributeValueController::class);
        Route::resource('products', ProductController::class);
        Route::resource('tags', TagController::class);
    });
