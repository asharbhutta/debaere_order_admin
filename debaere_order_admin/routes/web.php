<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\ProductController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(
    ['prefix' => 'admin', 'as' => 'admin'],
    function () {
        Route::middleware('auth')->group(function () {
          
            Route::get('customer/create', [CustomerController::class, 'create'])->name('_customer_create');
            Route::post('customer/store', [CustomerController::class, 'store'])->name('customerstore');
            Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('_customeredit');
            Route::post('customer/{id}/edit', [CustomerController::class, 'edit'])->name('_customeredit');
            Route::get('customer/admin', [CustomerController::class, 'admin'])->name('_customer_admin');
            Route::post('customer/{id}/delete', [CustomerController::class, 'delete'])->name('_customerdelete');

            Route::get('offering/create', [OfferingController::class, 'create'])->name('_offering_create');
            Route::post('offering/create', [OfferingController::class, 'create'])->name('_offering_create');
            Route::get('offering/{id}/edit', [OfferingController::class, 'edit'])->name('_offering_edit');
            Route::post('offering/{id}/edit', [OfferingController::class, 'edit'])->name('_offering_edit');
            Route::get('offering/admin', [OfferingController::class, 'admin'])->name('_offering_admin');

            Route::get('product/create', [ProductController::class, 'create'])->name('_product_create');
            Route::post('product/create', [ProductController::class, 'create'])->name('_product_create');
            Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('_product_edit');
            Route::post('product/{id}/edit', [ProductController::class, 'edit'])->name('_product_edit');


        });

    });
