<?php

use App\Http\Controllers\DistributorProductController;
use App\Http\Controllers\DistributorsController;
use App\Http\Controllers\ProductsController;
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

Route::group(['middleware' => 'auth:api'], function (Request $request) {
    
    Route::post('product/add', [ProductsController::class, 'store']);
    Route::get('product', [ProductsController::class, 'index']);

    Route::post('distributor/add', [DistributorsController::class, 'store']);
    Route::get('distributor', [DistributorsController::class, 'index']);

    Route::post('distributor-product-price/add', [DistributorProductController::class, 'store']);
    Route::get('distributor-product-price', [DistributorProductController::class, 'index']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
