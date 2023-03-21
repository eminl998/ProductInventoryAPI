<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

//User routes
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::get('/users/{id}', 'show');
    Route::put('/users/{id}', 'update');
    Route::delete('/users/{id}', 'delete');
});

// Product routes
Route::controller(ProductController::class)->group(function(){
    Route::get('/product', 'index');
    Route::get('/product/{id}', 'show');
    Route::put('/product/{id}', 'update');
    Route::delete('/product', 'delete');
});

// Category routes
Route::middleware('auth:api')->group(function () {
    Route::get('/categories', [CategoryController::class,'index'])->name('index');
    Route::get('/categories/{id}', [CategoryController::class,'show'])->name('show');
    Route::post('/categories', [CategoryController::class, 'store'])->name('store');
    Route::put('/categories/{id}', [CategoryController::class,'update'])->name('update');
    Route::get('/categories/{id}/products', [CategoryController::class,'products'])->name('index');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});