<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offering;
use App\Models\ProductImages;


class Product extends Model
{
    protected $guarded = [];

    public function offering()
    {
        return $this->belongsTo(Offering::class, 'offering_id');
    }

    public function productImage()
    {
        return $this->hasOne(productImages::class, 'product_id');
    }

    public function getImageUrl()
    {
        $url = "";
        if (isset($this->productImage)) {
            $url = $this->productImage->path;
            if (!empty($url)) {
                if (strpos($url, "cloudinary") != false) {
                    $url = $url;
                } else {
                    $url = "https://debaere.co.uk/" . $url;
                }
            }
        }

        return $url;
    }

    public static function searchContent($request)
    {


        $data = self::Where('name', '<>', null);

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
        if ($request->filled('sliced')) {
            $data->Where('sliced', 'like', "%" . $request->input('sliced') . "%");
        }


        $data->orderBy('sequence');

        return $data->paginate(20);
    }

    public static function getActiveProducts($pricesArr = [], $favoriteProducts = [])
    {
        $arr = [];
        $products = Product::Where('status', '=', 1)->orderBy('sequence')->get();
        foreach ($products as $product) {
            $sliced = 0;
            $sliceOption = false;
            if ($product->sliced == "yes") {
                $sliceOption = true;
                $sliced = 1;
            }

            $pack_size = 1;

            $packSizeArr = explode(" ", $product->pack_size);
            if (isset($packSizeArr[count($packSizeArr) - 1]))
                $pack_size = $packSizeArr[count($packSizeArr) - 1];
            $price = $product->price;
            if (isset($pricesArr[$product->id]))
                $price = $pricesArr[$product->id];

            $arr[] = [
                "id" => $product->id,
                "name" => $product->name,
                "offering_name" => $product->offering->name,
                'image_url' => $product->getImageUrl(),
                'sliced' => $sliced,
                'offering_id' => $product->offering_id,
                'product_number' => $product->product_number,
                'description' => $product->description,
                'weight' => $product->weight,
                'size' => $product->size,
                'portions' => $product->portions,
                'pack_size' => $pack_size,
                'shelf' => $product->shelf,
                'storage' => $product->storage,
                'sliceOption' => $sliceOption,
                'enable_notes' => $product->enable_notes,
                'price' => number_format((float)$price, 2, '.', ''),
                'prior_notice' => $product->prior_notice,
                'favorite' => in_array($product->id, $favoriteProducts) ? true : false,
                'sun' => $product->sun ? $product->sun : 0,
                'mon' => $product->mon ? $product->mon : 0,
                'tue' => $product->tue ? $product->tue : 0,
                'wed' => $product->wed ? $product->wed : 0,
                'thu' => $product->thu ? $product->thu : 0,
                'fri' => $product->fri ? $product->fri : 0,
                'sat' => $product->sat ? $product->sat : 0

            ];
        }

        return $arr;
    }


    use HasFactory;
}
