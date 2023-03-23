<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'logout');
        Route::get('refresh', 'refresh');
    });
});

Route::group(['middleware' => ['auth.jwt', 'role:user']], function () {

    // User routes
    Route::get('/users', [UserController::class, 'index']);

    // Product routes
    Route::get('/products', [ProductController::class, 'index']);

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index']);

});

Route::group(['middleware' => ['auth.jwt', 'role:admin']], function () {

    // User routes
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'delete']);

    //Product routes
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
    Route::put('/products/{product}', [ProductController::class, 'update']);
    Route::delete('/products/{product}', [ProductController::class, 'delete']);

    // Category routes
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
    Route::get('/categories/{category}/products', [CategoryController::class, 'products']);

});