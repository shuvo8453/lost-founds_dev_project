<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Item\ItemController;

/*
|--------------------------------------------------------------------------
| V1 API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register V1 API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('registration', 'registration');
});

Route::get('get-item-list', [ItemController::class , 'getItemList']);


/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum'])->group(function () {
    /*
   |--------------------------------------------------------------------------
   | Auth related route
   |--------------------------------------------------------------------------
   */
    Route::controller(AuthController::class)->group(function () {
        Route::get('/me', 'me');
        Route::get('/logout', 'logout');
    });

    /*
    |--------------------------------------------------------------------------
    | Item Resource
    |--------------------------------------------------------------------------
    */
    Route::apiResource('item', ItemController::class)->only("index" , "store");
    Route::get('item/toggle-status/{id}', [ItemController::class , 'itemToggleStatus']);
});
