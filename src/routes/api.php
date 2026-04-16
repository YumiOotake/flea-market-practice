<?php

use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReviewController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//api不要
Route::get('/items', [ItemController::class, 'index']);
Route::get('/items/{item}', [ItemController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('mypage/orders', [OrderController::class, 'index']);
    Route::get('mypage/sold-orders', [OrderController::class, 'soldIndex']);
    Route::get('mypage/favorites', [FavoriteController::class, 'index']);
    Route::patch('orders/{order}/send', [OrderController::class, 'send']);
    Route::patch('orders/{order}/receive', [OrderController::class, 'receive']);
    Route::post('orders/{order}/reviews', [ReviewController::class, 'store']);
});

Route::post('/login', [AuthController::class, 'login']);
