<?php

use App\Http\Controllers\Admin\BrandController;
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
        return view('client.home.index');
    });
});

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
