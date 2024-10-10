<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\CartController;
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
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('add-cart', [CartController::class, 'addCart'])->name('addCart');
    Route::delete('delete-cart/{id}', [CartController::class, 'destroyCart'])->name('destroyCart');
    Route::delete('delete-all-cart', [CartController::class, 'destroyAllCart'])->name('destroyAllCart');
    Route::put('update-cart', [CartController::class, 'updateCart'])->name('updateCart');
});

// viết các route admin vào đây
Route::prefix('/admin')
    ->as('admin.')
    ->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });
    Route::resource('brands', BrandController::class);
});
