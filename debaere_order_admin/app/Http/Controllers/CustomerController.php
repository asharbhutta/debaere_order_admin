<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use App\Models\User;
use Session;
use Redirect;
 use Illuminate\Validation\Rule; //import Rule class 
 use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function admin(Request $request)
    {
        // $num = 233;
        // echo sprintf("%'.06d\n", $num);
        // exit;
        //echo strpos(request()->route()->getName(),'customer')!==false ? "true":"false";

        $data=Customer::searchContent($request);
        return view('customer.admin')->with("data",$data)->with("title","All Customers");
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $customer =new Customer;
        $customer->location=1;
        $customer->status=1;
        $user = new User;
        $data=[];
        $data["model"]=$customer;
        $data["user"]=$user;
        $data["formRoute"]='admincustomerstore';
        $data["routeObject"]=route('admincustomerstore');
        return view('customer.create')->with("data", $data)->with("title", "Create Customer");  

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
           "name" => "required|min:5|max:255",
            "company_name" => "required|min:5|max:255",
            "contact_number" => "required|numeric",
            "contact_person" => "required|min:5|max:255",
            "address_1" => "max:255",
            "address_2" => "max:255",
            "address_3" => "max:255",
            "address_4" => "required|min:5|max:255",
            "d_address_1" => "max:255",
            "d_address_2" => "max:255",
            "d_address_3" => "max:255",
            "d_address_4" => "max:255",
            "location" => "required",
            "status" => "required",
            "email" => 'required|email|unique:users',
            "password" => "required" 
        ]);

        
        $user=new User;
        $customer=new Customer;
        $user->type=2;
        $validatedData["password"]=Hash::make($validatedData["password"]);
        $validatedData["type"]=2;
        $user->name=$validatedData["name"];
        $userObj=$user->create($validatedData);
        $validatedData["user_id"]=$userObj->id;

        $customer->create($validatedData);
        Session::flash('success', 'Customer is created Successfully'); 

        return  redirect('/admin/customer/admin')->withFlash('success',"Customer Created Successfully");        
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        $customer =Customer::findOrFail($id);
        $data=[];
        $data["model"]=$customer;
        $data["user"]=$customer->user;
        $data["formRoute"]='admin_customeredit';
        $data["routeObject"]=route('admin_customeredit',$customer->id);

        if($request->isMethod("post"))
        {
        
            $validatedData = $request->validate([
                "name" => "required|min:5|max:255",
                "company_name" => "required|min:5|max:255",
                "contact_number" => "required|numeric",
                "contact_person" => "required|min:5|max:255",
                "address_1" => "max:255",
                "address_2" => "max:255",
                "address_3" => "max:255",
                "address_4" => "required|min:5|max:255",
                "d_address_1" => "max:255",
                "d_address_2" => "max:255",
                "d_address_3" => "max:255",
                "d_address_4" => "max:255",
                "location" => "required",
                "status" => "required",
                "password"=>"max:20",
                'email' => Rule::unique('users')->ignore($customer->user_id),
            ]);

            $validatedData["type"]=2;


            if(isset($validatedData["password"]) && !Hash::check($validatedData["password"], $customer->user->password))
            {
                if(!empty($validatedData["password"]))
                $validatedData["password"]=Hash::make($validatedData["password"]);

            }
            else
            {
                 $validatedData["password"]=$customer->user->password;
            }

            $customer->user->update($validatedData);
            $customer->update($validatedData);
            Session::flash('success', 'Customer is updated Successfully'); 
            return  redirect('/admin/customer/admin');        
        }


        return view('customer.update')->with("data", $data)->with("title", "Update Customer");  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $model=Customer::findOrFail($id);
        Session::flash('success', 'Customer is Deleted Successfully'); 
        $model->delete();
        return  redirect('/admin/customer/admin');        
    }
}
