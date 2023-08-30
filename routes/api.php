<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', App\Http\Controllers\Api\Auth\LoginController::class)->name('auth.login');
Route::post('/register', App\Http\Controllers\Api\Auth\RegisterController::class)->name('auth.register');

Route::middleware('auth:api')->group(function () {

    Route::middleware('is-admin')->prefix('user')->name('user.')->group(function () {
        Route::post('/', [App\Http\Controllers\Api\UserController::class, 'create'])->name('create');
        Route::get('/', [App\Http\Controllers\Api\UserController::class, 'list'])->name('list');
        Route::get('/{id}', [App\Http\Controllers\Api\UserController::class, 'find'])->name('find');
        Route::post('/{id}', [App\Http\Controllers\Api\UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Api\UserController::class, 'delete'])->name('delete');
    });

    Route::prefix('product')->name('product.')->group(function () {
        Route::post('/', [App\Http\Controllers\Api\ProductController::class, 'create'])->name('create');
        Route::get('/', [App\Http\Controllers\Api\ProductController::class, 'list'])->name('list');
        Route::get('/{id}', [App\Http\Controllers\Api\ProductController::class, 'find'])->name('find');
        Route::post('/{id}', [App\Http\Controllers\Api\ProductController::class, 'update'])->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Api\ProductController::class, 'delete'])->name('delete');
    });
});

