<?php

use Illuminate\Support\Facades\Route;

// User routes
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');
Route::middleware('auth:api')->group(function () {
    Route::get('/users', 'UserController@index');
    Route::get('/users/{id}', 'UserController@show');
    Route::put('/users/{id}', 'UserController@update');
    Route::delete('/users/{id}', 'UserController@destroy');
});

// Product routes
Route::middleware('auth:api')->group(function () {
    Route::get('/products', 'ProductController@index');
    Route::get('/products/{id}', 'ProductController@show');
    Route::post('/products', 'ProductController@store');
    Route::put('/products/{id}', 'ProductController@update');
    Route::delete('/products/{id}', 'ProductController@destroy');
});

// Category routes
Route::middleware('auth:api')->group(function () {
    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/{id}', 'CategoryController@show');
    Route::post('/categories', 'CategoryController@store');
    Route::put('/categories/{id}', 'CategoryController@update');
    Route::delete('/categories/{id}', 'CategoryController@destroy');
    Route::get('/categories/{id}/products', 'CategoryController@products');
});