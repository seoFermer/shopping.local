<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('locale/{locale}',[\App\Http\Controllers\LocalizationController::class, 'setLang'])->name('locale');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'role:' . User::ROLE_ADMIN, 'as' => 'dashboard.', 'prefix' => 'dashboard'], function (){
    Route::group(['prefix' => 'users'], function (){
        Route::get('/', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('user.index');
        Route::get('/create', [App\Http\Controllers\Backend\UserController::class, 'create'])->name('user.create');
        Route::get('{user}', [App\Http\Controllers\Backend\UserController::class, 'show'])->name('user.show');
        Route::post('/', [App\Http\Controllers\Backend\UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('user.edit');
        Route::patch('/{user}', [App\Http\Controllers\Backend\UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [App\Http\Controllers\Backend\UserController::class, 'delete'])->name('user.delete');
    });
    Route::group(['prefix' => 'products'], function (){
        Route::get('/', [App\Http\Controllers\Backend\ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [App\Http\Controllers\Backend\ProductController::class, 'create'])->name('product.create');
        Route::get('{product}', [App\Http\Controllers\Backend\ProductController::class, 'show'])->name('product.show');
        Route::post('/', [App\Http\Controllers\Backend\ProductController::class, 'store'])->name('product.store');
        Route::get('/{product}/edit', [App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('product.edit');
        Route::patch('/{product}', [App\Http\Controllers\Backend\ProductController::class, 'update'])->name('product.update');
        Route::delete('/{product}', [App\Http\Controllers\Backend\ProductController::class, 'delete'])->name('product.delete');
    });

    Route::group(['prefix' => 'orders'], function (){
        Route::get('/', [App\Http\Controllers\Backend\OrderController::class, 'index'])->name('order.index');
        Route::get('{order}', [App\Http\Controllers\Backend\OrderController::class, 'show'])->name('order.show');
        Route::post('/{order}/{product}', [App\Http\Controllers\Backend\OrderController::class, 'productDelete'])->name('order.product.delete');
    });
});
