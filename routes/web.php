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
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;;
use App\Http\Controllers\Client\AccountGoogleController;
use App\Http\Controllers\Admin\DashboardController;


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
})->name(name: '/');





// view account
Route::get('/account', [AccountGoogleController::class, 'index'])->name('account.index');

// login 
Route::get('/login', [AccountGoogleController::class, 'viewLogin'])->name('login');
Route::post('login', [AccountGoogleController::class, 'login'])->name('login.submit');

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
Route::prefix('/admin')->as('admin.')->group(function () {

Route::get('/', function () { return view('admin.dashboard.index');})->name('dashboard')->middleware('checkPermission:Manage Users,Manage Roles,Manage Brands,Manage Permissions');

Route::resource('users', UserController::class)->middleware('checkPermission:Manage Users');
Route::resource('roles', RoleController::class)->middleware('checkPermission:Manage Roles');
Route::resource('permissions', PermissionController::class)->middleware('checkPermission:Manage Permissions');
Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);
Route::resource('attributes', AttributeController::class);
Route::resource('attributeValues', AttributeValueController::class);
Route::resource('products', ProductController::class);
Route::resource('tags', TagController::class);



});
