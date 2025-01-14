<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StatisticOrderController;
use App\Http\Controllers\Admin\StatisticUserController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SlideController;


use Illuminate\Support\Facades\Route;



Route::prefix('/admin')
    ->as('admin.')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/api/orders/revenue', [DashboardController::class, 'getRevenueData']);

        // Route::resources([
        //     'categories' => CategoryController::class,
        //     'attributes' => AttributeController::class,
        //     'attributeValues' => AttributeValueController::class,
        //     'tags' => TagController::class,
        //     'settings' => SettingController::class,
        // ]);
//        Route::resource('settings', SettingController::class);
        Route::resource( 'categories' , CategoryController::class)->middleware('checkPermission:Manager Products');
        Route::resource('attributes' , AttributeController::class)->middleware('checkPermission:Manager Products');
        Route::resource( 'attributeValues' , AttributeValueController::class)->middleware('checkPermission:Manager Products');
        Route::resource('tags' , TagController::class)->middleware('checkPermission:Manager Products');
        Route::resource('products', ProductController::class)->except(['destroy', 'show'])->middleware('checkPermission:Manager Products');
        Route::resource('posts' , PostController::class)->middleware('checkPermission:Manager Posts');
        Route::resource('brands' , BrandController::class)->middleware('checkPermission:Manager Brands');
        Route::resource('chats', ChatController::class)->middleware('checkPermission:Manager Chats');

        Route::post('/ckeditor/image_upload', [ProductController::class, 'ckeditorUpload'])->name('ckeditor.uploads');

        Route::resource('orders', OrderController::class)->middleware('checkPermission:Manager Orders');
        Route::resource('slides', SlideController::class)->middleware('checkPermission:Manager Sliders');
        Route::patch('orders/{order}/update-status', [OrderController::class, 'update'])->name('orders.updateStatus');
        Route::resource('users', UserController::class)->middleware('checkPermission:Manager Users');
        Route::resource('roles', RoleController::class)->middleware('checkPermission:Manager Roles');
        Route::resource('brands', BrandController::class)->middleware('checkPermission:Manager Brands');
        Route::resource('permissions', PermissionController::class)->only(['index'])->middleware('checkPermission:Manager Permissions');
        Route::get('statistics/order', [StatisticOrderController::class, 'statistics'])->name('statistics.orders');
        Route::get('statistics/user', [StatisticUserController::class, 'showStatisticsPage'])->name('statistics.users');
    });
