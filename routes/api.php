<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');


    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::group(['prefix' => 'products'], function () {
            Route::post('/', [\App\Http\Controllers\Api\ProductController::class, 'index']);
            Route::post('{product}', [\App\Http\Controllers\Api\ProductController::class, 'show']);
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::post('/store', [\App\Http\Controllers\Api\OrderController::class, 'store']);
        });
    });
});

