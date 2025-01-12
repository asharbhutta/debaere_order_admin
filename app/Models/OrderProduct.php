<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;



class OrderProduct extends Model
{
    use HasFactory;

    public $timestamps =false;

     public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

     public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function extraOption()
    {
        $option="N/A";
        if($this->product->offering->sliced)
        {
            if($this->product->sliced)
            $option="Sliced";
            else
            $option="Unsliced";
        }
        return $option;
    }
}
