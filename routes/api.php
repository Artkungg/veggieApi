<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/vegetables',[\App\Http\Controllers\VegetableController::class,'index']);
Route::prefix('/vegetable')->group(function (){
    Route::get('/{id}',[\App\Http\Controllers\VegetableController::class,'show']);
    Route::get('/data/{name}',[\App\Http\Controllers\VegetableController::class,'getVeggie']);
    Route::post('/store',[\App\Http\Controllers\VegetableController::class,'store']);
    Route::put('/{id}',[\App\Http\Controllers\VegetableController::class,'update']);
    Route::delete('/{id}',[\App\Http\Controllers\VegetableController::class,'destroy']);
});

Route::get('/carts',[\App\Http\Controllers\CartController::class,'index']);
Route::prefix('/cart')->group(function (){
    Route::get('/{id}',[\App\Http\Controllers\CartController::class,'show']);
    Route::get('/count/{id}',[\App\Http\Controllers\CartController::class,'count']);
    Route::post('/store',[\App\Http\Controllers\CartController::class,'store']);
    Route::put('/{id}',[\App\Http\Controllers\CartController::class,'update']);
    Route::delete('/{id}',[\App\Http\Controllers\CartController::class,'destroy']);
});

Route::prefix('/order')->group(function (){
    Route::get('/{id}',[\App\Http\Controllers\OrderController::class,'show']);
    Route::get('/amount/{id}',[\App\Http\Controllers\OrderController::class,'getAmount']);
    Route::post('/store',[\App\Http\Controllers\OrderController::class,'store']);
    Route::put('/{id}',[\App\Http\Controllers\OrderController::class,'update']);
    Route::delete('/{id}',[\App\Http\Controllers\OrderController::class,'destroy']);
});
