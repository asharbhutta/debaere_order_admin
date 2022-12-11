<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offering;
use App\Models\Product;
use Illuminate\Http\Response;
use Session;
use Redirect;
use Illuminate\Validation\Rule; //import Rule class 
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\ProductImages;




class ProductController extends Controller
{

    public function admin(Request $request)
    {
       // dd(Offering::Where('status','=',1)->get());
        $data=Product::searchContent($request);
        return view('product.admin')->with("data",$data)->with("title","All Products");
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
    
       public function updateSequence(Request $request)
    {
        $model=Product::findOrFail($request->id);
        $model->sequence=$request->sequence;
        $model->update();
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
                "name" => "required|min:3|max:255",
                "product_number" => "required|min:3|max:255",
                "description" => "required|min:5",
                "offering_id" => "required",
                "status" => "required",
                "weight" => "max:25",
                "price" => "max:25",
                "size" => "max:25",
                "portions" => "max:25",
                "pack_size" => "max:25",
                "shelf" => "max:55",
                "storage" => "max:555",
                "sliced"=>"max:20",
                'enable_notes'=>'numeric',
                'sequence'=>'numeric',
                'prior_notice'=>'numeric'



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
    public function replicate($id)
    {
        $model=Product::findOrFail($id);
        $replicatedModel=$model->replicate();
        $productImage=$model->productImage->replicate();
        $replicatedModel->save();
        $productImage->product_id=$replicatedModel->id;
        $productImage->save();
        
        Session::flash('success', 'Product Replicated Successfully'); 
        return  redirect('/admin/product/admin');    

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
                "name" => "required|min:3|max:255",
                "product_number" => "required|min:3|max:255",
                "description" => "required|min:5",
                "offering_id" => "required",
                "status" => "required",
                "weight" => "max:25",
                "price" => "max:25",
                "size" => "max:25",
                "portions" => "max:25",
                "pack_size" => "max:25",
                "shelf" => "max:55",
                "storage" => "max:555",
                "sliced"=>"max:20",
                'enable_notes'=>'numeric',
                'sequence'=>'numeric',
                'prior_notice'=>'numeric'


            ]);

            $validatedData["description"]=strip_tags($validatedData["description"]);



           

            $model=$model->update($validatedData);
            if($request->hasFile('image'))
            {  
                ProductImages::where('product_id',$id)->delete();
                $pImage = new ProductImages();
                $pImage->path = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $pImage->product_id=$id;
                $pImage->save();
            }


            Session::flash('success', 'Product is Updated Successfully'); 
            return  redirect('/admin/product/admin');        
        }

        $data["model"]=$model;
        $data["offering"]=$offeringArr;
        $data["formRoute"]='admin_product_edit';
        $data["routeObject"]=route('admin_product_edit',$id);


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
    
    public function manipulateProductImages()
    {
        
       // $products=Product::Where('status','=',1)->get();
        
        // foreach($products as $product)
        // {
        //     if(isset($product->productImage))
        //     {
        //         $productImage=$product->productImage;
        //         $path=$product->productImage->path;
        //         if(strpos($path,'https')==false)
        //         {
        //             $url=$product->getImageUrl();
        //             $url=str_replace("https","http",$url);
        //           // echo $url."<br>";
        //             $spath=storage_path('thumb.jpg');
        //             //echo $spath;
        //             $file=$this->thumbnail($url,$spath);
        //             $productImage->path = cloudinary()->upload($url)->getSecurePath();
        //             echo $productImage->path."<br>";
        //             $productImage->update();
        //             echo $product->name."<br>";

        //         }
        //     }
        // }
        
          $offerings=Offering::Where('status','=',1)->get();
        
        foreach($offerings as $offering)
        {
            if(isset($offering->icon))
            {
               
                $path=$offering->icon;;
                if(strpos($path,'https')==false)
                {
                    $url=$offering->getIconUrl();
                    $url=str_replace("https","http",$url);
                  
                    $offering->icon = cloudinary()->upload($url)->getSecurePath();
                    echo $offering->icon."<br>";
                    $offering->update();
                    echo $offering->name."<br>";

                }
            }
        }
    }
    
      public function manipulateOfferingImages()
    {
        
        $offerings=Offering::Where('status','=',1)->get();
        
        foreach($offerings as $offering)
        {
            if(isset($offering->icon))
            {
               
                $path=$product->icon;;
                if(strpos($path,'https')==false)
                {
                    $url=$product->getIconUrl();
                    $url=str_replace("https","http",$url);
                  
                    $offering->icon = cloudinary()->upload($url)->getSecurePath();
                    echo $offering->icon."<br>";
                    $offering->update();
                    echo $offering->name."<br>";

                }
            }
        }
    }
    
    function thumbnail($url, $filename, $width = 300, $height = true) 
	{
	    
	    $arrContextOptions=array(
              
            );  
     // download and create gd image
     $image = ImageCreateFromString(file_get_contents($url));
    
     // calculate resized ratio
     // Note: if $height is set to TRUE then we automatically calculate the height based on the ratio
     $height = $height === true ? (ImageSY($image) * $width / ImageSX($image)) : $height;
    
     // create image 
     $output = ImageCreateTrueColor($width, $height);
     ImageCopyResampled($output, $image, 0, 0, 0, 0, $width, $height, ImageSX($image), ImageSY($image));
    
     // save image
     ImageJPEG($output, $filename, 95); 
    
     // return resized image
     return $output; // if you need to use it
    }
}
