<?php

use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('getStores',[StoreController::class,'getAll']);
Route::get('getProducts/{id}',[StoreController::class,'getProducts']);
Route::get('getOneProduct/{id}',[StoreController::class,'getOneProduct']);
Route::post('addToCart/{id}',[StoreController::class,'addToCart']);
Route::get('getCart/{id}',[StoreController::class,'getcart']);
Route::get('cancelOrder/{id}',[StoreController::class,'cancelOrder']);
Route::get('getCart2/{id}',[StoreController::class,'getCart2']);
