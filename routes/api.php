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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
], function () {
    Route::apiResource('customers', App\Http\Controllers\Api\V1\CustomerController::class);
    Route::apiResource('invoices', App\Http\Controllers\Api\V1\InvoiceController::class);
    Route::apiResource('categories', App\Http\Controllers\Api\V1\CategoryController::class);
    Route::apiResource('products', App\Http\Controllers\Api\V1\ProductController::class);
});
