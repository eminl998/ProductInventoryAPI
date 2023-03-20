<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
});
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('index');
    Route::get('/users', [UserController::class, 'index'])->name('index');
    Route::put('/users', [UserController::class, 'index'])->name('index');
    Route::delete('/users', [UserController::class, 'index'])->name('index');
});





// User routes
// Route::middleware('auth:api')->group(function () {
//     Route::get('/users', 'UserController@index');
//     Route::get('/users/{id}', 'UserController@show');
//     Route::put('/users/{id}', 'UserController@update');
//     Route::delete('/users/{id}', 'UserController@destroy');
// });

// Product routes
// Route::middleware('auth:api')->group(function () {
//     Route::get('/products', 'ProductController@index');
//     Route::get('/products/{id}', 'ProductController@show');
//     Route::post('/products', 'ProductController@store');
//     Route::put('/products/{id}', 'ProductController@update');
//     Route::delete('/products/{id}', 'ProductController@destroy');
// });

// Category routes
// Route::middleware('auth:api')->group(function () {
//     Route::get('/categories', 'CategoryController@index');
//     Route::get('/categories/{id}', 'CategoryController@show');
//     Route::post('/categories', 'CategoryController@store');
//     Route::put('/categories/{id}', 'CategoryController@update');
//     Route::delete('/categories/{id}', 'CategoryController@destroy');
//     Route::get('/categories/{id}/products', 'CategoryController@products');
// });