<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PriceController;

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

// Маршрут для получения информации о продукте вместе с его актуальной ценой
Route::get('/products/{product}', [ProductController::class, 'show']);
// Маршрут для создания нового продукта
Route::post('/products', [ProductController::class, 'store']);
// Маршрут для создания новой цены для продукта
Route::post('/prices', [PriceController::class, 'store']);

//Route::get('/index', function () { return view('index');})->middleware('auth');
