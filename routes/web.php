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
use App\Http\Controllers\AccountGoogleController;

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;

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
    Route::get('/', [CartController::class, 'index']);
    Route::get('list-cart', [CartController::class, 'listcart'])->name('listcart');
    Route::get('addcart/{id}', [CartController::class, 'addcart']);
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


    Route::get('/login', [AccountGoogleController::class, 'viewLogin'])->name('login');
    Route::post('login', [AccountGoogleController::class, 'login'])->name('login.submit');

    Route::get('/register', [AccountGoogleController::class, 'create'])->name('account.index');
    Route::post('/register', [AccountGoogleController::class, 'store'])->name('store');

    Route::get('/account', [AccountGoogleController::class, 'index'])->name('account.index');

    Route::get('auth/google', [AccountGoogleController::class, 'redirectToGoogle'])->name('login-by-google');
    Route::get('auth/google/callback', [AccountGoogleController::class, 'handleGoogleCallback']);
    Route::get('/logout', [AccountGoogleController::class, 'logout'])->name('logout');


});

// viết các route admin vào đây
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });
});

//Order
Route::get('/checkout/{id}',[CheckoutController::class,'checkout'])->name('order.checkout');
Route::post('/checkout',[CheckoutController::class,'post_checkout']);

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
