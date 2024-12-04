<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Client\AccountGoogleController;

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

    // detail address
    Route::post('/account', [AccountGoogleController::class, 'storeAddress'])->name('account.add_address');
    Route::delete('/addresses/{id}', [AccountGoogleController::class, 'deleteAddress'])->name('account.delete_address');
    Route::patch('/account/{id}/set-default', [AccountGoogleController::class, 'setDefault'])->name('account.set_default');


    // forget password
    Route::get('/forget-password', [AccountGoogleController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [AccountGoogleController::class, 'sendEmailForgetPasswordForm'])->name('forget.password.post'); 
    Route::get('reset-password/{token}', [AccountGoogleController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AccountGoogleController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

// viết các route admin vào đây
Route::prefix('/admin')
    ->as('admin.')
    ->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });
    Route::resource('brands', BrandController::class);
});
