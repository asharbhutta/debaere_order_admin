<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\OrderController;




Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(DataController::class)->group(function () {
    Route::get('getData', 'getData');
});

Route::controller(OrderController::class)->group(function () {
    Route::post('makeOrder', 'makeOrder');
    Route::get('previousOrders', 'previousOrders');
    Route::post('getMinOrderPrice', 'getMinOrderPrice');
    Route::post('validate-order-date', 'validateOrderDate');
    Route::post('mark-favorite', 'toggleFavorite');
    Route::get('favorite-products', 'favoriteProducts');
});
