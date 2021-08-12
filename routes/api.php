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

//-----Auth-----
Route::post('/auth', [\App\Http\Controllers\AuthController::class, 'auth']);
Route::post('/auth/refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/users')->group(function () {
    Route::middleware(['auth:api', 'user'])->get('/{userId}/expenses', [\App\Http\Controllers\ExpenseController::class, 'getByUser']);
    Route::middleware(['auth:api', 'user'])->get('/{userId}/categories', [\App\Http\Controllers\CategoryController::class, 'getByUser']);
    Route::post('/', [\App\Http\Controllers\UserController::class, 'store']);
});

Route::prefix('/categories')->group(function () {
    Route::middleware('auth:api')->post('/', [\App\Http\Controllers\CategoryController::class, 'store']);
});

Route::prefix('/expenses')->group(function () {
    Route::middleware('auth:api')->get('/', [\App\Http\Controllers\ExpenseController::class, 'get']);
    Route::middleware('auth:api')->post('/', [\App\Http\Controllers\ExpenseController::class, 'store']);
});


Route::prefix('/categories')->group(function () {
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'list']);
});





