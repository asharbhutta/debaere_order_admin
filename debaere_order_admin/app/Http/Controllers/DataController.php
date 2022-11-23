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
        $offerings=Offering::getActiveOfferings();
        $products=Product::getActiveProducts();
        $promotion=Promotion::findOrFail(1);
         
        return response()->json([
            'status' => 'success',
            'offerings' => $offerings,
            'products' => $products,
             'promotion'=> $promotion

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