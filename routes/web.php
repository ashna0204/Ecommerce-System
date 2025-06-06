<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/create', [UserController::class, 'create']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::get('/orders/create', [OrderController::class, 'create']);

Route::post('/users', [UserController::class, 'store']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/orders', [OrderController::class, 'store']);
