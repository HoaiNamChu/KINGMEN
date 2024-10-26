<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Models\Product;
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

    //cart routes
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('add-cart', [CartController::class, 'addCart'])->name('addCart');
    Route::get('add-cart/{slug}', [CartController::class, 'addCartIcon'])->name('addCartIcon');
    Route::delete('delete-cart/{id}', [CartController::class, 'destroyCart'])->name('destroyCart');
    Route::delete('delete-all-cart', [CartController::class, 'destroyAllCart'])->name('destroyAllCart');
    Route::put('update-cart', [CartController::class, 'updateCart'])->name('updateCart');

    //page routes
    Route::get('shop', function (){
        $products = Product::query()->with('variants', 'categories', 'brand', 'reviews')->paginate(12);
        return view('client.shop.index', compact('products'));
    });

    Route::get('/product/{slug}', function (){
        $product = Product::query()->where('slug', request()->slug)->with('categories', 'brand', 'galleries', 'variants')->first();
        return view('client.singleProduct', compact('product'));
    })->name('productDetail');

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
