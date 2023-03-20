<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});

// User routes
Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('index');
    Route::get('/users{id}', [UserController::class, 'show'])->name('show');
    Route::put('/users', [UserController::class, 'update'])->name('update');
    Route::delete('/users', [UserController::class, 'destroy'])->name('delete');
});

// Product routes
Route::middleware('auth:api')->group(function () {
    Route::get('/products',[ProductController::class, 'index'])->name('index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('show');
    Route::post('/products', [ProductController::class, 'store'])->name('store');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('delete');
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