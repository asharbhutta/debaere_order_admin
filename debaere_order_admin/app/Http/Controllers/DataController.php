<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Offering;
use App\Models\Product;
use App\Models\Promotion;



class DataController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getData()
    {
        $offerings = Offering::getActiveOfferings();
        $promotion = Promotion::findOrFail(1);
        $user = auth('api')->user();
        $customer = $user->customer;
        $min_order_price = 0;
        $dilivery_charges = 0;
        $customPricesArr = $customer->getCustomPriceArr();
        $favoriteProducts = explode(",", $customer->favorite_products);
        $products = Product::getActiveProducts($customPricesArr, $favoriteProducts);


        if ($customer->min_order_price)
            $min_order_price = $customer->min_order_price;

        if ($customer->dilivery_charges)
            $dilivery_charges = $customer->dilivery_charges;

        return response()->json([
            'status' => 'success',
            'min_order_price' => $min_order_price,
            'delivery_charges' => $dilivery_charges,
            'offerings' => $offerings,
            'products' => $products,
            'promotion' => $promotion,

        ]);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
