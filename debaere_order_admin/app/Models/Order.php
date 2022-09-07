<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\OrderProduct;



class Order extends Model
{
    use HasFactory;

    // public static function boot()
    // {
    //     parent::boot();

       
    //     self::created(function($model){
    //         // ... code here

    //         $model->order_no=sprintf("%'.06d\n", $model->id);
    //         $model->update();

    //     });
    //     self::updated(function($model){
    //         // ... code here
    //         $model->order_no=sprintf("%'.06d\n", $model->id);
    //         $model->update();
    //     });



    // }


     public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
