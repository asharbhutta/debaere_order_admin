<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\CustomerProductPrices;


class Customer extends Model
{
    protected $fillable = [
            "name",
            "company_name" ,
            "contact_number",
            "contact_person",
            "address_1" ,
            "address_2" ,
            "address_3" ,
            "address_4" ,
            "d_address_1" ,
            "d_address_2" ,
            "d_address_3" ,
            "d_address_4" ,
            "location",
            "status",
            'user_id',
            'customer_number',
            'min_order_price',
            'dilivery_charges'

    ];
    
    protected $with = ['user'];


    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customPrice()
    {
        return $this->hasOne(CustomerProductPrices::class, 'customer_id');
    }

    public function customPrices()
    {
        return $this->hasMany(CustomerProductPrices::class, 'customer_id');
    }


    public function getLocation()
    {
        if($this->location==1)
        return "London";
        else
        return "Surrey";
    }

      public static function searchContent($request)
    {
        
        
        $data = Customer::join('users', 'customers.user_id', '=', 'users.id')->select("*","customers.id as id");

        if ($request->filled('company_name')) {
            $data->Where('company_name', 'like', "%" . $request->input('company_name') . "%");
        }
        if ($request->filled('location')) {
            $data->Where('location', '=', $request->input('location'));
        }
        if ($request->filled('customer_number')) {
            $data->Where('customer_number', 'like', "%" . $request->input('customer_number') . "%");
        }
        if ($request->filled('status')) {
            $data->Where('status', '=', $request->input('status'));
        }
        if ($request->filled('email')) {
            $data->Where('users.email', 'like', "%" . $request->input('email') . "%");
        }
        $data->orderBy('users.created_at', 'desc');
        
        return $data->paginate(20);
    }

    public function getCustomPriceArr()
    {
        $customPrices=$this->customPrices;
        $customPriceArr=[];
        if(!empty($customPrices))
        {
            foreach($customPrices as $cPrice)
            {
                $customPriceArr[$cPrice->product_id]=$cPrice->price;
            }
        }

        return $customPriceArr;
    }
}
