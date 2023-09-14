<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;

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

Route::get('get-all-products',[ProductController::class,'getAllProducts']);
Route::post('add-product',[ProductController::class,'addProduct']);
Route::post('edit-product/{id}',[ProductController::class,'editProduct']);
Route::get('get-product-by-id/{id}',[ProductController::class,'getProductById']);
Route::post('delete-product/{id}',[ProductController::class,'deleteProduct']);
