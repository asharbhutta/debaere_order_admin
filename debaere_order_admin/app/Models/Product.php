<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offering;
use App\Models\ProductImages;


class Product extends Model
{
    protected $guarded=[];
    
    public function offering()
    {
        return $this->belongsTo(Offering::class, 'offering_id');
    }

    public function productImage()
    {
        return $this->hasOne(productImages::class,'product_id');
    }

    public function getImageUrl()
    {
        $url="";
        if(isset($this->productImage))
        {
            $url=$this->productImage->path;
            if(!empty($url))
            {
                if(strpos($url,"cloudinary")!=false)
                {
                    $url=$url;
                }
                else
                {
                    $url="https://debaere.co.uk/".$url;
                }
            }
        }

        return $url;
    }

     public static function searchContent($request)
    {
        
        
        $data =self::Where('name','<>',null);

        if ($request->filled('name')) {
            $data->Where('name', 'like', "%" . $request->input('name') . "%");
        }
        if ($request->filled('product_number')) {
            $data->Where('product_number', 'like', "%" . $request->input('product_number') . "%");
        }
        if ($request->filled('offering_id')) {
            $data->Where('offering_id', '=', $request->input('offering_id'));
        }
        if ($request->filled('status')) {
            $data->Where('status', '=', $request->input('status'));
        }
    
        $data->orderBy('created_at', 'desc');
        
        return $data->paginate(20);
    }

    public static function getActiveProducts()
    {
        $arr=[];
        $products=Product::Where('status','=',1)->get();
        foreach($products as $product)
        {
            $arr[]=[
            "id"=>$product->id,
            "name"=>$product->name,
            "offering_name"=>$product->offering->name,
            'image_url'=>$product->getImageUrl(),
            'sliced'=>$product->offering->sliced,
            'offering_id'=>$product->offering_id,
            'product_number'=>$product->number,
            'description'=>$product->description,
            'weight'=>$product->weight,
            'size'=>$product->size,
            'pack_size'=>$product->pack_size,
            'shelf'=>$product->shelf,
            'storage'=>$product->storage
            ];
        }

        return $arr;
    }


    use HasFactory;
}
