<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\User;
use Session;
use Redirect;
use Illuminate\Validation\Rule; //import Rule class 
use Illuminate\Support\Facades\Hash;




class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $model=Promotion::findOrFail(1);
        $data=[];
       
         if($request->isMethod("post"))
        {

           $validatedData = $request->validate([
              
                "description" => "max:3000",
                'active'=>'numeric'
            ]);


            $model->update($validatedData);

            if($request->hasFile('image'))
            {
                $model->image = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $model->update();
            }


            Session::flash('success', 'Promotion edited'); 
            return  redirect('/admin/promotion/index');        
        }

        $data["model"]=$model;
      
        return view('promotion.index')->with("data", $data)->with("title", "Promotion");
    }
    
}
