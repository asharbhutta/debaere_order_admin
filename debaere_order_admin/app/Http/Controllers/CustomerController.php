<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Customer;
use App\Models\User;
use Session;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $user = new User;
        $data=[];
        $data["model"]=$customer;
        $data["user"]=$user;
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
        $user->name=$validatedData["name"];
        $userObj=$user->create($validatedData);
        $validatedData["user_id"]=$userObj->id;
        $customer->create($validatedData);
        Session::flash('success', 'Customer is created Successfully'); 


        return  redirect('/admin/customer/create')->withFlash('success',"Customer Created Successfully");        





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
    public function edit($id)
    {
        //
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
}
