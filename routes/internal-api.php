<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
Route::get('/testlogin', function(){

    var_dump(\Illuminate\Support\Facades\Auth::user());
    \Illuminate\Support\Facades\Auth::login(\App\Models\User::find(1));
});


Route::post('/users', [\App\Http\Controllers\UserController::class, 'store']);


Route::prefix('/categories')->group(function () {
    Route::middleware('auth')->post('/', [\App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('/', [\App\Http\Controllers\CategoryController::class, 'list']);
});
