<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Offering;
use App\Models\Product;


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
         
        return response()->json([
            'status' => 'success',
            'offerings' => $offerings,
            'products' => $products
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