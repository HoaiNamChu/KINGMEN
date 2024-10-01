<?php

use Illuminate\Support\Facades\Route;

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
Route::prefix('/admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard.index');
    });

});
