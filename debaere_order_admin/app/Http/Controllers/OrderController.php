<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Offering;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Mail\OrderEmail;



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
                $orderProduct->count=$op["count"];
                if(isset($op["notes"]))
                $orderProduct->notes=$op["notes"];

                $orderProduct->save();
            }

            $this->sendOrderEmail($order);

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

    public function previousOrders(Request $request)
    {   
        $ordersArr=[];
        $user = auth('api')->user();
        $orders = Order::Where('customer_id',$user->customer->id)->OrderBy('id','desc')->Limit(10)->get();
        foreach($orders as $order)
        {   
            $productsArr=[];
            $orderProducts=$order->orderProducts;
            foreach($orderProducts as $op)
            {
                $optionText="N/A";
                if($op->product->offering->sliced==1)
                {
                    if($op->sliced==1)
                    $optionText="sliced";
                    else
                    $optionText="unsliced";
                }

                $pOrder=["id"=>$op->product_id,"name"=>$op->product->name,"count"=>$op->count,"sliced"=>$op->sliced,"optionText"=>$optionText];
                if($optionText!="N/A")
                $pOrder["sliceOption"]=$optionText;

                $productsArr[]=$pOrder;
            }

            $arr=["order_no"=>$order->order_no,'created_at'=>$order->created_at,'order_date'=>$order->date,"products"=>$productsArr];
            $ordersArr[]=$arr;
        }

         return response()->json([
            'status' => 'success',
            'orders' => $ordersArr
        ]);


    }

    public function sendOrderEmail($order)
    {
        $orderEmails=[];
        $orderEmails[]="asharbhutta@gmail.com";
        $orderEmails[]=$order->customer->user->email;
        \Mail::to($orderEmails)->send(new OrderEmail($order));
    }
   
}