<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;


class HolidayDate extends Model
{
    use HasFactory;
    public static function getLatestHolidays()
    {   $responseArr=[];
        $dates=self::orderBy('id','desc')->take(10)->get();
        foreach($dates as $date)
        {   
            if(empty($date->date))
            $responseArr[]=["date"=>$date->date,"message"=>$date->message];
            else
            {
                $period = CarbonPeriod::create($date->date, $date->end_date);
                $orderDates=$period->toArray();
                foreach($orderDates as $orderDate)
                {
                    $responseArr[]=["date"=>$orderDate->format("Y-m-d"),"message"=>$date->message];
                }

            }
        }
        
        return $responseArr;
    }
}
