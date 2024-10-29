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

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Client\AccountGoogleController;

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


    // view account
    Route::get('/account', [AccountGoogleController::class, 'index'])->name('account.index');

    // login
    Route::get('/login', [AccountGoogleController::class, 'viewLogin'])->name('login');
    Route::post('login', [AccountGoogleController::class, 'login'])->name('login.submit');


    //cart routes
    Route::prefix('/cart')
        ->as('cart.')
        ->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::get('/clear-cart', [CartController::class, 'clearCart'])->name('clear');
            Route::get('/add-cart/{slug}', [CartController::class, 'iconAddCart'])->name('iconAdd');
        });
    Route::prefix('/product')
        ->as('product.')
        ->group(function () {
        Route::get('/{slug}', [\App\Http\Controllers\Client\ProductController::class, 'detail'])->name('detail');
    });
    // register
    Route::get('/register', [AccountGoogleController::class, 'create'])->name('account.index');
    Route::post('/register', [AccountGoogleController::class, 'store'])->name('store');

    // login by google
    Route::get('auth/google', [AccountGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
    Route::get('auth/google/callback', [AccountGoogleController::class, 'handleGoogleCallback']);

    // logout account
    Route::get('/logout', [AccountGoogleController::class, 'logout'])->name('logout');


    // update billing address
    Route::post('/update-billing-address', [AccountGoogleController::class, 'updateBillingAddress']);

    // forget password
    Route::get('/forget-password', [AccountGoogleController::class, 'showForgetPasswordForm'])->name('forget.password.get');

    Route::post('/forget-password', [AccountGoogleController::class, 'sendEmailForgetPasswordForm'])->name('forget.password.post');

    Route::get('reset-password/{token}', [AccountGoogleController::class, 'showResetPasswordForm'])->name('reset.password.get');

    Route::post('reset-password', [AccountGoogleController::class, 'submitResetPasswordForm'])->name('reset.password.post');
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

    Route::resource('users', UserController::class)->middleware('checkPermission:Manage Users');
    Route::resource('roles', RoleController::class)->middleware('checkPermission:Manage Roles');
    Route::resource('brands', BrandController::class)->middleware('checkPermission:Manage Brands');

    Route::resource('permissions', PermissionController::class)->middleware('checkPermission:Manage Permissions');

});
