<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HolidayDate;
use Session;
use Carbon\CarbonPeriod;



class HolidayDatesController extends Controller
{
    
    public function index(Request $request)
    {
        
        if(isset($_POST["save"]))
        {
            $model=new HolidayDate();
            $model->date=$_POST["date"];
            if(isset($_POST["end_date"]))
            {
                $model->end_date=$_POST["end_date"];
            }
            $model->message=$_POST["message"];
            $model->save();
            return  redirect('/home')->withFlash('success',"Holiday Created Successfully");        
 

        }

        $dates=HolidayDate::orderBy('id','desc')->take(15)->get();
        return view('holiday_dates.index')->with('dates',$dates);
    }

    public function delete($id)
    {
        $model=HolidayDate::findOrFail($id);
        $model->delete();
        return  redirect('/admin/holidayDates/index')->withFlash('success',"Holiday deleted Successfully");        

    }
}
