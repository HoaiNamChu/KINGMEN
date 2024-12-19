<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Client\WishlistController;
use App\Http\Controllers\Admin\SlideController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;

;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;

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
            Route::get('/vnpay/return', [CheckoutController::class, 'vnPayReturn'])->name('vnpay.return');
        });
    Route::resource('wishlist', WishlistController::class)->middleware('auth');
    Route::get('/order/{id}', [OrderClientController::class, 'show'])->name('order.detail')->middleware('auth');
    Route::post('/order/{id}/cancel', [OrderClientController::class, 'cancel'])->name('order.cancel')->middleware('auth');
    Route::post('/order/{id}/returnorder', [OrderClientController::class, 'returnorder'])->name('order.return')->middleware('auth');
    Route::post('/order/{id}/access', [OrderClientController::class, 'access'])->name('order.access')->middleware('auth');



    Route::post('/contact', [\App\Http\Controllers\Client\ContactController::class, 'store'])->name('contact.store');

    //post route

    Route::get('/posts/{slug}', [\App\Http\Controllers\Client\PostController::class, 'detail'])->name('client.posts.detail');


    //tuyen

    // view account
    Route::get('/account', [AccountGoogleController::class, 'index'])->name('account.index');

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

    // detail address
    Route::post('/account', [AccountGoogleController::class, 'storeAddress'])->name('account.add_address');
    Route::delete('/addresses/{id}', [AccountGoogleController::class, 'deleteAddress'])->name('account.delete_address');
    Route::patch('/account/{id}/set-default', [AccountGoogleController::class, 'setDefault'])->name('account.set_default');


    // forget password
    Route::get('/forget-password', [AccountGoogleController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [AccountGoogleController::class, 'sendEmailForgetPasswordForm'])->name('forget.password.post');

    Route::get('reset-password/{token}', [AccountGoogleController::class, 'showResetPasswordForm'])->name('reset.password.get');

    Route::post('reset-password', [AccountGoogleController::class, 'submitResetPasswordForm'])->name('reset.password.post');


    // view account
    Route::get('/account', [AccountGoogleController::class, 'index'])->name('account.index');
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
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resources([
            'categories' => CategoryController::class,
            'brands' => BrandController::class,
            'attributes' => AttributeController::class,
            'attributeValues' => AttributeValueController::class,
            'products' => ProductController::class,
            'tags' => TagController::class,
            'posts' => PostController::class,
        ]);

        Route::post('/ckeditor/image_upload', [ProductController::class, 'ckeditorUpload'])->name('ckeditor.uploads');

        Route::resource('orders', OrderController::class);
        Route::resource('slides', SlideController::class);
        Route::patch('orders/{order}/update-status', [OrderController::class, 'update'])->name('orders.updateStatus');
        Route::resource('users', UserController::class)->middleware('checkPermission:Manager Users');
        Route::resource('roles', RoleController::class)->middleware('checkPermission:Manager Roles');
        Route::resource('brands', BrandController::class)->middleware('checkPermission:Manager Brands');
        Route::resource('permissions', PermissionController::class)->middleware('checkPermission:Manager Permissions');

    });
