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
use App\Models\Promotion;
use App\Models\Product;
use App\Events\OrderisCreated;
use App\Http\Requests\ValidateOrderRequest;
use App\Models\HolidayDate;
use Carbon\Carbon;
use Carbon\CarbonPeriod;






class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getData()
    {
        $offerings = Offering::getActiveOfferings();
        $products = Product::getActiveProducts();
        $promotion = Promotion::findOrFail(1);

        return response()->json([
            'status' => 'success',
            'offerings' => $offerings,
            'products' => $products,
            'promotion' => $promotion
        ]);
    }

    public function makeOrder(ValidateOrderRequest $request)
    {
        $data = $request->json()->all();
        $user = auth('api')->user();
        $customer = $user->customer;
        $customPricesArr = $customer->getCustomPriceArr();
        $min_order_price = $customer->min_order_price;
        $dilivery_charges = $customer->dilivery_charges;
        $totalOrderPrice = 0;

        // $dateResponse = $this->validateOrderDate($data);
        // if (!$dateResponse["status"]) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $dateResponse["message"],
        //     ], 401);
        // }

        // $productResponse = $this->validateOrderProducts($data);
        // if (!$productResponse["status"]) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $productResponse["message"],
        //     ], 401);
        // }

        if (isset($data) && isset($data["order_date"]) && isset($data["order_products"])) {
            $orderDate = $data["order_date"];
            $orderProducts = $data["order_products"];

            $order = new Order;
            $order->date = $orderDate;
            $order->customer_id = $customer->id;
            $order->customer_name = $customer->company_name;
            $order->save();
            $order->order_no = sprintf("%'.06d\n", $order->id);
            $order->update();

            foreach ($orderProducts as $op) {
                $unit_price = 0;
                if (isset($customPricesArr[$op["product_id"]])) {
                    $unit_price = $customPricesArr[$op["product_id"]];
                } else {
                    $product = Product::findOrFail($op["product_id"]);
                    $unit_price = $product->price;
                }

                $orderProduct = new OrderProduct;
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $op["product_id"];
                $orderProduct->sliced = $op["sliced"];
                $orderProduct->count = $op["count"];
                $orderProduct->unit_price = $unit_price;
                $totalOrderPrice = $totalOrderPrice + ($op["count"] * $unit_price);

                if (isset($op["notes"]))
                    $orderProduct->notes = $op["notes"];

                $orderProduct->save();
            }

            if ($totalOrderPrice < $min_order_price) {
                $order->delivery_charges = $dilivery_charges;
                $order->update();
            }

            // event(new OrderisCreated($order));
            //$this->sendOrderEmail($order);

            return response()->json([
                'status' => 'success',
                'message' => 'Order Saved Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
    }

    public function previousOrders(Request $request)
    {
        $ordersArr = [];
        $user = auth('api')->user();
        $orders = Order::Where('customer_id', $user->customer->id)->OrderBy('id', 'desc')->Limit(10)->get();
        foreach ($orders as $order) {
            $productsArr = [];
            $orderProducts = $order->orderProducts;
            foreach ($orderProducts as $op) {
                $optionText = "N/A";
                if ($op->product->offering->sliced == 1) {
                    if ($op->sliced == 1)
                        $optionText = "sliced";
                    else
                        $optionText = "unsliced";
                }

                $pOrder = ["id" => $op->product_id, "name" => $op->product->name, "count" => $op->count, "sliced" => $op->sliced, "optionText" => $optionText, "price" => $op->unit_price];
                if ($optionText != "N/A")
                    $pOrder["sliceOption"] = $optionText;

                if (isset($op->notes) && !empty($op->notes)) {
                    $pOrder["optionText"] = $op->notes;
                }

                $productsArr[] = $pOrder;
            }

            $arr = ["order_no" => $order->order_no, 'created_at' => $order->created_at, 'order_date' => $order->date, "products" => $productsArr];
            $ordersArr[] = $arr;
        }

        return response()->json([
            'status' => 'success',
            'orders' => $ordersArr
        ]);
    }

    public function sendOrderEmail($order)
    {
        //     $orderEmails=[];
        //   //  $orderEmails[]="asharbhutta@gmail.com";

        //     if($order->customer->user->email!="bhuttaashar@gmail.com")
        //     {
        //       // $orderEmails[]="kaleembhutta@debaere.co.uk";
        //       // $orderEmails[]="orders@debaere.co.uk";

        //     }

        \Mail::to($order->customer->user->email)->send(new OrderEmail($order));
        // $order->confirm_order=true;

        // //$orderEmails[]=$order->customer->user->email;
        // \Mail::to($orderEmails)->send(new OrderEmail($order));
    }

    public function getMinOrderPrice(Request $request)
    {
        $data = $request->json()->all();
        $user = auth('api')->user();
        $customer = $user->customer;
        $min_order_price = $customer->min_order_price;
        if (isset($data["date"]) && !empty($data["date"])) {
            $orders = Order::Where('customer_id', $customer->id)->Where('date', $data["date"])->get();
            if (count($orders) > 0)
                $min_order_price = 0;
        }

        return response()->json([
            'status' => 'success',
            'min_order_price' => $min_order_price
        ]);
    }

    public function validateOrderDate($data)
    {
        $currDate = date('Y-m-d');
        $orderDate = $data["order_date"];
        $validDate = true;
        $msg = "";
        $dateOrder = new \DateTime($orderDate);
        $today = new \DateTime($currDate);
        $dayDiff = $dateOrder->diff($today)->format("%a"); //3


        if ($currDate == $orderDate) {
            $validDate = false;
            $msg = "Order date cannot be today's Date";
        }

        if ($dayDiff == 1) {
            if (date('H') > 11) {
                $validDate = false;
                $msg = "Order date cannot be today's Date";
            }
        }

        $holiday = HolidayDate::where('date', '<=', $orderDate)
            ->where('end_date', '>=', $orderDate)
            ->first();

        if ($holiday) {
            $validDate = false;
            $msg = $holiday->message;
        }

        return ["status" => $validDate, "message" => $msg];
    }

    public function validateOrderProducts($data)
    {
        $orderDate = $data["order_date"];
        $dayName = strtolower(Carbon::parse($orderDate)->format('D'));
        $fullDayName = Carbon::parse($orderDate)->format('l'); // 'l' returns the full day name
        $orderProducts = $data["order_products"];
        $validateProduct = true;
        $message = "";

        foreach ($orderProducts as $orderProduct) {
            $product = Product::findOrFail($orderProduct["product_id"]);
            if ($product->$dayName == 0) {
                $validateProduct = false;
                $message = "Some of the Products you are ordering cannot be ordered on " . $fullDayName;
                break;
            }
        }

        return ["status" => $validateProduct, 'message' => $message];
    }
}
