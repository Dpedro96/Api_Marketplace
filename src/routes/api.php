<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::resource('/address', AddressController::class);
    Route::resource('/orders', OrderController::class);
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::resource('/cart/item', CartItemController::class);
    Route::delete('/cart/item', [CartItemController::class, 'clear']);
    Route::get('/user',[UserController::class, 'getUser']);
    Route::put('/user',[UserController::class, 'update']);
    Route::post('/user/image',[UserController::class, 'input_image']);
    Route::delete('/user',[UserController::class, 'destroy']);
    Route::group(['middleware' => 'checkPermissionsModerator:sanctum'], function(){
        Route::resource('/product', ProductController::class)->except(['index','show']);
        Route::group(['middleware' => 'checkPermissionsAdmin:sanctum'], function(){
            Route::post('/user/moderator',[UserController::class, 'storeModerator']);
            Route::resource('/category', CategoryController::class)->except(['index','show']);
            Route::resource('/coupon', CouponController::class);
            Route::resource('/discount', DiscountController::class);
        });
    });
});

