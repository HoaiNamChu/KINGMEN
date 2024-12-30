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

        Route::resources([
            'categories' => CategoryController::class,
            'brands' => BrandController::class,
            'attributes' => AttributeController::class,
            'attributeValues' => AttributeValueController::class,
            'products' => ProductController::class,
            'tags' => TagController::class,
            'posts' => PostController::class,
            'settings' => SettingController::class,
        ]);

        Route::resource('chats', ChatController::class);

        Route::post('/ckeditor/image_upload', [ProductController::class, 'ckeditorUpload'])->name('ckeditor.uploads');

        Route::resource('orders', OrderController::class);
        Route::resource('slides', SlideController::class);
        Route::patch('orders/{order}/update-status', [OrderController::class, 'update'])->name('orders.updateStatus');
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('statistics/order', [StatisticOrderController::class, 'statistics'])->name('statistics.orders');
        Route::get('statistics/user', [StatisticUserController::class, 'showStatisticsPage'])->name('statistics.users');
    });
