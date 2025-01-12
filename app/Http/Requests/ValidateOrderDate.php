<?php

namespace App\Http\Requests;

use App\Models\HolidayDate;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ValidateOrderDate extends ApiRequest
{
    public function rules()
    {
        return [
            'order_date' => ['required', 'date', 'after_or_equal:today'],
        ];
    }

    public function messages()
    {
        return [
            'order_date.required' => 'Order date is required.',
            'order_date.date' => 'Order date must be a valid date.',
            'order_date.after_or_equal' => 'Order date cannot be in the past.',

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateOrderDate($validator);
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
}
