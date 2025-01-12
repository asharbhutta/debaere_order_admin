<?php

namespace App\Http\Requests;

use App\Models\HolidayDate;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ValidateOrderRequest extends ApiRequest
{
    public function rules()
    {
        return [
            'order_date' => ['required', 'date', 'after_or_equal:today'],
            'order_products' => ['required', 'array'],
            'order_products.*.product_id' => ['required', 'exists:products,id'],
        ];
    }

    public function messages()
    {
        return [
            'order_date.required' => 'Order date is required.',
            'order_date.date' => 'Order date must be a valid date.',
            'order_date.after_or_equal' => 'Order date cannot be in the past.',
            'order_products.required' => 'Order products are required.',
            'order_products.array' => 'Order products must be an array.',
            'order_products.*.product_id.required' => 'Each product must have a valid product ID.',
            'order_products.*.product_id.exists' => 'Invalid product selected.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateOrderDate($validator);
            $this->validateOrderProducts($validator);
        });
    }

    public function validateOrderDate($validator)
    {
        $orderDate = $this->input('order_date');
        $currDate = now()->format('Y-m-d');
        $dateOrder = new \DateTime($orderDate);
        $today = new \DateTime($currDate);
        $dayDiff = $dateOrder->diff($today)->format("%a");
       

        if ($currDate === $orderDate) {
            $validator->errors()->add('order_date', "Order date cannot be today's date.");
        }

        if ($dayDiff == 1 && now()->format('H') > 11) {
            $validator->errors()->add('order_date', "Order date cannot be tomorrow after 11 AM.");
        }

        $holiday = HolidayDate::where('date', '<=', $orderDate)
            ->where('end_date', '>=', $orderDate)
            ->first();

        if ($holiday) {
            $validator->errors()->add('order_date', $holiday->message);
        }
    }

    private function validateOrderProducts($validator)
    {
        $orderDate = $this->input('order_date');
        $dayName = strtolower(Carbon::parse($orderDate)->format('D'));
        $fullDayName = Carbon::parse($orderDate)->format('l');
        $orderProducts = $this->input('order_products');

        foreach ($orderProducts as $orderProduct) {
            $product = Product::find($orderProduct['product_id']);
            if ($product && $product->$dayName == 0) {
                $validator->errors()->add(
                    'order_products',
                    "Some of the products cannot be ordered on " . $fullDayName . "."
                );
                break;
            }
        }
    }
}
