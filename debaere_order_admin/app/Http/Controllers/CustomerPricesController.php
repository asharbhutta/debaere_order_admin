<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerProductPrices;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


use Session;



class CustomerPricesController extends Controller
{
    //

    public function customerPrices($id,Request $request)
    {
        $customerProductPrices=CustomerProductPrices::where("customer_id","=",$id)->orderBy('id')->get();

        $data["customer"]=Customer::findOrFail($id);
        $data["pricesData"]=$customerProductPrices;
        return view('prices.customer_prices')->with("data",$data)->with("title","Customer Prices");
    }

    public function import(Request $request)
    {
        $errors=[];
        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $fileData=$this->processFile($file);
            $responseArr=$this->validateDProducts($fileData);
            if(!$responseArr["status"])
            {
                Session::flash('error', 'No Data is Uploaded'); 
                $errors=$responseArr["errors"];
            }
            else
            {
                $pricesData=[];
                $productsArr=$responseArr["productArray"];
                $completeCustomerDataArr=[];
                for($c=2; $c<count($fileData); $c++)
                {
                    $customerPriceData=[];
                    if($fileData[$c])
                    {
                        $cRow=$fileData[$c];
                        $customer=Customer::where('customer_number', '=',$cRow[2])->first();
                    
                        if($customer)
                        {
                            $customerPriceData["customer_id"]=$customer->id;
                            $customerPriceData["customer_min_price"]=$cRow[3];   
                            $productPriceArr=[];
                            for($p=4; $p<count($cRow); $p++)
                            {
                                $productPriceArr[$productsArr[$p]]=$cRow[$p];
                            }
                            $customerPriceData["productPricingArr"]=$productPriceArr;
                            $completeCustomerDataArr[]=$customerPriceData;
                        }
                        else
                        $errors[]="Customer With Customer Number #".$cRow[2]." Not Found at row ".$c+1;



                    }
                }

                Session::flash('success', 'Data Uploaded Successfully'); 
                $this->updateCustomerPricing($completeCustomerDataArr);
            }
            
        }
       
        $data["errors"]=$errors;
        return view('prices.import')->with("data",$data)->with("title","Import Customer Pricing");
    }

    public function processFile($file)
    {
        if ($file) {
            $filename = $file->getClientOriginalName();
           $extension = $file->getClientOriginalExtension(); //Get extension of uploaded file
           $tempPath = $file->getRealPath();
           $fileSize = $file->getSize(); //Get size of uploaded file in bytes
           //Check for file extension and size
           //Where uploaded file will be stored on the server 
           $location = 'uploads'; //Created an "uploads" folder for that
           // Upload file
           $file->move($location, $filename);
           // In case the uploaded file path is to be stored in the database 
           $filepath = public_path($location . "/" . $filename);
           // Reading file
           $file = fopen($filepath, "r");
           $importData_arr = array(); // Read through the file and store the contents as an array
           $i = 0;
           //Read the contents of the uploaded file 
           while (($filedata = fgetcsv($file, 100000, ",")) !== FALSE) {
           $num = count($filedata);
           // Skip first row (Remove below comment if you want to skip the first row)
           // if ($i == 0) {
           // $i++;
           // continue;
           // }
           for ($c = 0; $c < $num; $c++) {
           $importData_arr[$i][] = $filedata[$c];
           }
           $i++;
           }
           fclose($file);
          File::delete($filepath);


           return $importData_arr;
       }
    }

    public function validateDProducts($fileData)
    {
        $response=true;
        $errorArray=[];
        $responseArr=[];
        $productCodesArr=[];
        if(isset($fileData[0]))
        {
            $productCodesArr=[];
            $headerRow=$fileData[0];
            for($c=4; $c<count($headerRow); $c++)
            {
                $product=Product::where('product_number', '=',$headerRow[$c])->first();
                if($product)
                $productCodesArr[$c]=$product->id;
                else
                {
                    $response=false;
                    $errorArray[]="No Product with Product Code ".$headerRow[$c]." found at Column #".$this->getNameFromNumber($c);
                }
            }

            $responseArr["status"]          =$response;
            $responseArr["errors"]          =$errorArray;
            $responseArr["productArray"]    =$productCodesArr;



        }
        else
        {
            $response=false;
            $errorArray[]="Header Not Found";
            $responseArr["status"]=$response;
            $responseArr["errors"]=$errorArray;
        }

        return $responseArr;
    }

    public function updateCustomerPricing($data)
    {
        
        foreach($data as $cDta)
        {
            $productPrices=$cDta["productPricingArr"];
            $customer_id=$cDta["customer_id"];
        
            if(!empty($productPrices))
            {
                CustomerProductPrices::where('customer_id','=',$customer_id)->delete();
                $customer=Customer::where('id', '=',$customer_id)->first();
                $customer->min_order_price=$cDta["customer_min_price"];
                $customer->save();

                foreach($productPrices as $k=>$v)
                {
                    $cPriceModel=new CustomerProductPrices;
                    $cPriceModel->customer_id=$customer_id;
                    $cPriceModel->product_id=$k;
                    $cPriceModel->price=$v;

                    $cPriceModel->save();
                }
                
            }
        }
    }

    public function getNameFromNumber($num) {
        $numeric = $num % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval($num / 26);
        if ($num2 > 0) {
            return $this->getNameFromNumber($num2 - 1) . $letter;
        } else {
            return $letter;
        }
    }

    public function allCustomerPriceList(Request $request)
    {
        $product_ids=[];
        $uniqueProducts=DB::table('customer_product_prices')
        ->select('product_id')
        ->groupBy('product_id')
        ->get();
        foreach($uniqueProducts as $product)
        {
            $product_ids[]=$product->product_id;
        }

        dd($product_ids);

    }
}
