<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;


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
}
