<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\AccountGoogleController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\OrderClientController;
use App\Models\Product;

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
        $prd = Product::query()->latest('id')->paginate(8);
        return view('client.home.index',compact('prd'));
    });

    Route::get('/login', [AccountGoogleController::class, 'viewLogin'])->name('login');
    Route::post('login', [AccountGoogleController::class, 'login'])->name('login.submit');

    Route::get('/register', [AccountGoogleController::class, 'create'])->name('account.index');
    Route::post('/register', [AccountGoogleController::class, 'store'])->name('store');

    Route::get('/account', [AccountGoogleController::class, 'index'])->name('account.index');

    Route::get('auth/google', [AccountGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
    Route::get('auth/google/callback', [AccountGoogleController::class, 'handleGoogleCallback']);
    Route::get('/logout', [AccountGoogleController::class, 'logout'])->name('logout');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store')->middleware('auth');
    Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::delete('/cart/clear/{id}', [CartController::class, 'clear'])->name('cart.clear')->middleware('auth');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');

    Route::prefix('/checkout')
        ->middleware('auth')
        ->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('/', [CheckoutController::class, 'order'])->name('order');
            Route::get('/vnpay/return', [CheckoutController::class, 'vnPayReturn'])->name('vnpay.return');
        });

    Route::get('/order/{id}', [OrderClientController::class, 'show'])->name('order.detail')->middleware('auth');
    Route::post('/order/{id}/cancel', [OrderClientController::class, 'cancel'])->name('order.cancel')->middleware('auth');


});

// viết các route admin vào đây
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });
});

// viết các route admin vào đây
Route::prefix('/admin')
    ->as('admin.')
//    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
    Route::get('/', function () {



        return view('admin.dashboard.index');
    });

    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::resource('users', UserController::class)->middleware('checkPermission:Manage Users');
    Route::resource('roles', RoleController::class)->middleware('checkPermission:Manage Roles');
    Route::resource('brands', BrandController::class)->middleware('checkPermission:Manage Brands');

    Route::resource('permissions', PermissionController::class)->middleware('checkPermission:Manage Permissions');

});
