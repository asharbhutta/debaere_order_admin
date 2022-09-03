<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Offering;
use App\Models\Order;
use App\Models\OrderProduct;



class OrderController extends Controller
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

    public function makeOrder(Request $request)
    {
        $data = $request->json()->all();
        $user = auth('api')->user();
        $customer=$user->customer;
        if(isset($data) && isset($data["order_date"]) && isset($data["order_products"]))
        {
            $orderDate=$data["order_date"];
            $orderProducts=$data["order_products"];

            $order=new Order;
            $order->date=$orderDate;
            $order->customer_id=$customer->id;
            $order->customer_name=$customer->company_name;
            $order->save();
            $order->order_no=sprintf("%'.06d\n", $order->id);
            $order->update();

            foreach($orderProducts as $op)
            {
                $orderProduct=new OrderProduct;
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id=$op["product_id"];
                $orderProduct->sliced=$op["sliced"];
                $orderProduct->save();
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order Saved Successfully',
            ]);

        }
        else
        {
             return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
    }
   
}