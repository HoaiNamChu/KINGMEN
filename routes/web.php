<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\AccountGoogleController;
use App\Http\Controllers\Client\OrderClientController;
use App\Http\Controllers\Client\CheckoutController;

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
    Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
    Route::get('/shop', [\App\Http\Controllers\Client\ShopController::class, 'index'])->name('shop');
    Route::get('/about', [\App\Http\Controllers\Client\AboutController::class, 'index'])->name('about');
    Route::get('/blog', [\App\Http\Controllers\Client\BlogController::class, 'index'])->name('blog');
    Route::get('/contact', [\App\Http\Controllers\Client\ContactController::class, 'index'])->name('contact');

    //Route product
    Route::get('/product/{slug}', [\App\Http\Controllers\Client\ProductController::class, 'productDetail'])->name('product.detail');
    Route::get('/variant-information', [\App\Http\Controllers\Client\ProductController::class, 'variantInformation'])->name('variant.information');

    //Route cart
    Route::prefix('/cart')
        ->middleware('auth')
        ->as('cart.')
        ->group(function () {
            Route::get('/', [\App\Http\Controllers\Client\CartController::class, 'index'])->name('index');
            Route::post('/', [\App\Http\Controllers\Client\CartController::class, 'store'])->name('store');
            Route::put('/{id}', [\App\Http\Controllers\Client\CartController::class, 'update'])->name('update');
            Route::delete('/clear/{id}', [\App\Http\Controllers\Client\CartController::class, 'clear'])->name('clear');
            Route::delete('/{id}', [\App\Http\Controllers\Client\CartController::class, 'destroy'])->name('destroy');
        });


    Route::prefix('/checkout')
        ->middleware('auth')
        ->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
            Route::post('/', [CheckoutController::class, 'order'])->name('order');
            Route::get('/return', [CheckoutController::class, 'checkoutReturn'])->name('checkout.return');
        });

    Route::get('/pay-back/{id}', [CheckoutController::class, 'payBack'])->name('payback');
    // Route chat
    Route::get('/chat', [\App\Http\Controllers\Client\ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [\App\Http\Controllers\Client\ChatController::class, 'store'])->name('chat.store');

    Route::resource('wishlist', WishlistController::class)->middleware('auth');
    Route::get('/order/{id}', [OrderClientController::class, 'show'])->name('order.detail')->middleware('auth');
    Route::post('/order/{id}/cancel', [OrderClientController::class, 'cancel'])->name('order.cancel')->middleware('auth');
    Route::post('/order/{id}/returnorder', [OrderClientController::class, 'returnorder'])->name('order.return')->middleware('auth');
    Route::post('/order/{id}/access', [OrderClientController::class, 'access'])->name('order.access')->middleware('auth');


    Route::post('/contact', [\App\Http\Controllers\Client\ContactController::class, 'store'])->name('contact.store');

    //post route

    Route::get('/posts/{slug}', [\App\Http\Controllers\Client\PostController::class, 'detail'])->name('client.posts.detail');


    //tuyen

    Route::prefix('/account')
        ->as('account.')
        ->middleware('auth')
        ->group(function () {

        Route::get('/', [AccountGoogleController::class, 'index'])->name('index');
        Route::get('/orders', [AccountGoogleController::class, 'getUserOrder'])->name('orders');
        Route::get('/addresses', [AccountGoogleController::class, 'getUserAddress'])->name('addresses');
        Route::get('/detail', [AccountGoogleController::class, 'getUserInfo'])->name('info');
        Route::post('/', [AccountGoogleController::class, 'storeAddress'])->name('add_address');
        Route::delete('/{id}', [AccountGoogleController::class, 'deleteAddress'])->name('delete_address');
        Route::patch('/{id}/set-default', [AccountGoogleController::class, 'setDefault'])->name('set_default');

    });

    // login
    Route::get('/login', [AccountGoogleController::class, 'viewLogin'])->name('login');
    Route::post('login', [AccountGoogleController::class, 'login'])->name('login.submit');

    // register
    Route::get('/register', [AccountGoogleController::class, 'create'])->name('account.register');
    Route::post('/register', [AccountGoogleController::class, 'store'])->name('store');

    // login by google
    Route::get('auth/google', [AccountGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
    Route::get('auth/google/callback', [AccountGoogleController::class, 'handleGoogleCallback']);

    // logout account
    Route::get('/logout', [AccountGoogleController::class, 'logout'])->name('logout');

    // forget password
    Route::get('/forget-password', [AccountGoogleController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [AccountGoogleController::class, 'sendEmailForgetPasswordForm'])->name('forget.password.post');

    Route::get('reset-password/{token}', [AccountGoogleController::class, 'showResetPasswordForm'])->name('reset.password.get');

    Route::post('reset-password', [AccountGoogleController::class, 'submitResetPasswordForm'])->name('reset.password.post');


    Route::get('/search', [\App\Http\Controllers\Client\SearchController::class, 'search'])->name('search');

    Route::get('/brand/{slug}', [\App\Http\Controllers\Client\ShopController::class, 'brandFilter'])->name('brand.filter');

    Route::get('/category/{slug}', [\App\Http\Controllers\Client\ShopController::class, 'categoryFilter'])->name('category.filter');

});


// viết các route admin vào đây
