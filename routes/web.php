<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountGoogleController;


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

    Route::get('/login', [AccountGoogleController::class, 'viewLogin'])->name('login');

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
