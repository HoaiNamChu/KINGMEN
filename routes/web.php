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
use App\Http\Controllers\Admin\OrderController;




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
});

// viết các route admin vào đây
Route::prefix('/admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.dashboard.index');
        })->name('dashboard');

        Route::resource('orders', OrderController::class);
        Route::resource('users', UserController::class)->middleware('checkPermission:Manage Users');
        Route::resource('roles', RoleController::class)->middleware('checkPermission:Manage Roles');
        Route::resource('brands', BrandController::class)->middleware('checkPermission:Manage Brands');
        Route::resource('permissions', PermissionController::class)->middleware('checkPermission:Manage Permissions');

    });
