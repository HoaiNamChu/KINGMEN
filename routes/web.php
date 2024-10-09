<?php

use App\Http\Controllers\Admin\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;

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
         // Giả sử bạn có cách lấy ID người dùng từ session hoặc Auth
         $userId = 3; // Lấy ID người dùng từ session hoặc Auth

         // Lấy tất cả các role của người dùng
         $userRoles = DB::table('role_user')->where('user_id', $userId)->pluck('role_id')->toArray();
 
         // Kiểm tra nếu người dùng có role là 'người dùng' (ví dụ role_id = 4)
         if (in_array(4, $userRoles)) { // Giả sử role_id = 4 người dùng
             return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này.');
         }
 
        return view('admin.dashboard.index');
    });

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('brands', BrandController::class);
});
