<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Offering;
use App\Models\User;
use Session;
use Redirect;
use Illuminate\Validation\Rule; //import Rule class 
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;



class OfferingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function admin(Request $request)
    {
        $data=Offering::searchContent($request);
        return view('offering.admin')->with("data",$data)->with("title","All Offerings");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model=new Offering();
        $model->status=1;
        $model->sliced=0;

        $data=[];
       

         if($request->isMethod("post"))
        {

            $validatedData = $request->validate([
                "name" => "required|min:5|max:255",
                "slug" => "required|min:5|max:255",
                "description" => "required|min:5",
                "sliced" => "required",
                "status" => "required"
            ]);

             if($request->hasFile('image'))
            {   
                 $validatedData["icon"] = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            }

            $model->create($validatedData);

            Session::flash('success', 'Offering is created Successfully'); 
            return  redirect('/admin/offering/create');        
        }

        $data["model"]=$model;
        $data["formRoute"]='admin_offering_create';
        $data["routeObject"]=route('admin_offering_create');


        return view('offering.create')->with("data", $data)->with("title", "Create Offering");  

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
         $model=Offering::findOrFail($id);
       
        $data=[];
       

         if($request->isMethod("post"))
        {

            $validatedData = $request->validate([
                "name" => "required|min:5|max:255",
                "slug" => "required|min:5|max:255",
                "description" => "required|min:5",
                "sliced" => "required",
                "status" => "required"
            ]);

             if($request->hasFile('image'))
            {   
                 $validatedData["icon"] = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            }

            $model->update($validatedData);

            Session::flash('success', 'Offering is created Updated'); 
            return  redirect('/admin/offering/'.$id."/edit");        
        }

        $data["model"]=$model;
        $data["formRoute"]='admin_offering_edit';
        $data["routeObject"]=route('admin_offering_edit',$model->id);


        return view('offering.update')->with("data", $data)->with("title", "Update Offering");  

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
