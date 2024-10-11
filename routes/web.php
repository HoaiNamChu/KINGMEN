<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\CheckoutController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;


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
    });

    Route::resource('users', UserController::class)->middleware('checkPermission:Manage Users');
    Route::resource('roles', RoleController::class)->middleware('checkPermission:Manage Roles');
    Route::resource('brands', BrandController::class)->middleware('checkPermission:Manage Brands');

    Route::resource('permissions', PermissionController::class)->middleware('checkPermission:Manage Permissions');
  
});
