<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OfferingController;
use App\Http\Controllers\ProductController;
use App\Models\Order;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CustomerPricesController;
use App\Http\Controllers\HolidayDatesController;
use App\Http\Controllers\HomeController;








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

Route::get('mailview/{id}', function ($id) {
   $order=Order::findOrFail($id);
    return view('emails.ordermail',['order'=>$order]);

})->name("mailview");

Route::get('send-mail', function () {
   
      $order=Order::findOrFail(169);
      $order->confirm_order=true;

    \Mail::to(['asharbhutta@gmail.com'])->send(new \App\Mail\OrderEmail($order));
   
    dd("Email is Sent.");
});


Route::get('send-confirm-order-mail/{id}', function ($id) {
   
      $order=Order::findOrFail($id);
    \Mail::to($order->customer->user->email)->send(new \App\Mail\ConfirmOrderEmail($order));
    dd("Confirmation Email is Sent Successfully.");
})->name('confirm_order_mail');




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
            Route::post('offering/updateSequence', [OfferingController::class, 'updateSequence'])->name('_offering_update_sequence');

            Route::get('product/create', [ProductController::class, 'create'])->name('_product_create');
            Route::post('product/create', [ProductController::class, 'create'])->name('_product_create');
            Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('_product_edit');
            Route::post('product/{id}/edit', [ProductController::class, 'edit'])->name('_product_edit');
            Route::get('product/admin', [ProductController::class, 'admin'])->name('_product_admin');
            Route::get('product/imageManipulate', [ProductController::class, 'manipulateProductImages'])->name('_product_manipulate');
            Route::post('product/updateSequence', [ProductController::class, 'updateSequence'])->name('_product_update_sequence');
            Route::get('holidayDates/index', [HolidayDatesController::class, 'index'])->name('_holidayDates');
            Route::post('holidayDates/index', [HolidayDatesController::class, 'index'])->name('_holidayDates');
            Route::delete('holidayDates/delete/{id}', [HolidayDatesController::class, 'delete'])->name('_deleteHoliday');

            Route::get('orders/admin', [OrdersController::class, 'admin'])->name('_order_admin');
            Route::get('orders//{id}/view', [OrdersController::class, 'view'])->name('_order_view');
            Route::get('product/{id}/replicate', [ProductController::class, 'replicate'])->name('_product_replicate');

            Route::post('promotion/index', [PromotionController::class, 'index'])->name('_promotion_index');
            Route::get('promotion/index', [PromotionController::class, 'index'])->name('_promotion_index');
            
            Route::post('pricing/import', [CustomerPricesController::class, 'import'])->name('_customer_pricing_import');
            Route::get('pricing/import', [CustomerPricesController::class, 'import'])->name('_customer_pricing_import');
            Route::get('pricing/priceList', [CustomerPricesController::class, 'allCustomerPriceList'])->name('_customer_pricing_list');
            Route::get('pricing/{id}/customerPrices', [CustomerPricesController::class, 'customerPrices'])->name('_customer_pricing_edit');
            Route::get('/backup_db', [App\Http\Controllers\HomeController::class, 'backupDB'])->name('backup');

        });

    });
