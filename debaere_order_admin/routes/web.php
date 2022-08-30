<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OfferingController;


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
            // Route::get('posts/test', [ContentController::class, 'test']);
            // Route::get('posts/admin', [ContentController::class, 'admin'])->name('posts');
            // Route::get('tags/admin', [TagsController::class, 'admin'])->name('tags');
            // Route::get('tags/{id}', [TagsController::class, 'show'])->name('tagview');
            // Route::get('posts/postedContent', [ContentController::class, 'postedContent'])->name('posted');
            // Route::get('posts/scheduled', [ContentController::class, 'scheduled'])->name('scheduled');
            // Route::get('posts/customscheduled', [ContentController::class, 'customscheduled'])->name('customscheduled');
            // Route::get('posts/recomended', [ContentController::class, 'recomendedSchedule'])->name('recomended');
            // Route::post('posts/storeSchedule', [ContentController::class, 'storeSchedule'])->name('storeschedule');
            // Route::post('posts/resetSchedule', [ContentController::class, 'resetSchedule'])->name('resetschedule');
            // Route::get('posts/{id}/edit', [ContentController::class, 'edit'])->name('edit');
            // Route::post('posts/{id}/store', [ContentController::class, 'store'])->name('store');
            // Route::get('posts/{id}', [ContentController::class, 'show'])->name('show');
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






            //  Route::get('customer/{id}', [CustomerController::class, 'show'])->name('show');
            //  Route::post('customer/{id}/store', [CustomerController::class, 'store'])->name('store');
            //  Route::post('customer/{id}/update', [CustomerController::class, 'store'])->name('store');
            //  Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
            // Route::get('customer/', [CustomerController::class, 'edit'])->name('edit');

        });

    });
