<?php

use App\Http\Controllers\insertdbcontroller;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('getStores',[StoreController::class,'getAllStore']);
Route::get('getAllProducts/{id}',[StoreController::class,'getAllProducts']);
Route::get('getOneProduct/{id}',[StoreController::class,'getOneProduct']);
Route::post('addToCart',[StoreController::class,'addToCart']);
Route::get('cancelOrder/{id}',[StoreController::class,'cancelOrder']);
Route::get('getCart/{id}',[StoreController::class,'getCart2']);
Route::get('installOrder/{id}',[StoreController::class,'installOrder']);
Route::get('cancelOrder/{id}',[StoreController::class,'cancelOrder']);
Route::get('getAllOrder/{id}',[StoreController::class,'getAllOrder']);


Route::post('insertStore',[insertdbcontroller::class,'storeImageSrore']);
Route::post('insertProducts',[insertdbcontroller::class,'insertProducts']);
