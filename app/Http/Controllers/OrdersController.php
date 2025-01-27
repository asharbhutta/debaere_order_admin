<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offering;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Response;
use Session;
use Redirect;
use Illuminate\Validation\Rule; //import Rule class 
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\ProductImages;




class OrdersController extends Controller
{

    public function admin(Request $request)
    {
       // dd(Offering::Where('status','=',1)->get());
        $data=Order::searchContent($request);
        return view('orders.admin')->with("data",$data)->with("title","All Orders");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view($id)
    {
        $order=Order::findOrFail($id);
        $order->viewed=1;
        $order->save();
        $order->confirm_order=true;
        
        return view('emails.ordermail')->with("order", $order)->with("title", "Create Product"); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model=new Product();
        $offeringArr=Offering::getActiveOfferingArray();
        $data=[];
       
         if($request->isMethod("post"))
        {

            $validatedData = $request->validate([
                "name" => "required|min:5|max:255",
                "product_number" => "required|min:5|max:255",
                "description" => "required|min:5",
                "offering_id" => "required",
                "status" => "required",
                "weight" => "max:125",
                "price" => "max:125",
                "size" => "max:125",
                "portion" => "max:125",
                "pack_size" => "max:125",
                "shelf" => "max:155",
                "storage" => "max:125",

                
            ]);

            $validatedData["description"]=strip_tags($validatedData["description"]);
            $model=$model->create($validatedData);

            if($request->hasFile('image'))
            {   $pImage = new ProductImages();
                $pImage->path = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $pImage->product_id=$model->id;
                $pImage->save();
            }


            Session::flash('success', 'Product is created Successfully'); 
            return  redirect('/admin/product/admin');        
        }

        $data["model"]=$model;
        $data["offering"]=$offeringArr;
        $data["formRoute"]='admin_product_create';
        $data["routeObject"]=route('admin_product_create');


        return view('product.create')->with("data", $data)->with("title", "Create Product"); 
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
        $model=Product::findOrFail($id);
        $offeringArr=Offering::getActiveOfferingArray();
        $data=[];
       
         if($request->isMethod("post"))
        {

            $validatedData = $request->validate([
                "name" => "required|min:5|max:255",
                "product_number" => "required|min:5|max:255",
                "description" => "required|min:5",
                "offering_id" => "required",
                "status" => "required",
                "weight" => "max:25",
                "price" => "max:25",
                "size" => "max:25",
                "portion" => "max:25",
                "pack_size" => "max:25",
                "shelf" => "max:25",
                "storage" => "max:25",

                
            ]);

            $validatedData["description"]=strip_tags($validatedData["description"]);



           

            $model=$model->update($validatedData);
            if($request->hasFile('image'))
            {   $pImage = new ProductImages();
                $pImage->path = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $pImage->product_id=$model->id;
                $pImage->save();
            }


            Session::flash('success', 'Product is Updated Successfully'); 
            return  redirect('/admin/product/admin');        
        }

        $data["model"]=$model;
        $data["offering"]=$offeringArr;
        $data["formRoute"]='admin_product_create';
        $data["routeObject"]=route('admin_product_create');


        return view('product.update')->with("data", $data)->with("title", "Create Product"); 
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
