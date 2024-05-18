<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
        protected $fillable = [
            "name",
            "slug" ,
            "description",
            "status",
            "sliced" ,
            "icon",
            "sequence"
    ];
    use HasFactory;

    public function getIconUrl()
    {
        $url="";
        if(!empty($this->icon))
        {
            if(strpos($this->icon,"cloudinary")!=false)
            {
                $url=$this->icon;
            }
            else
            {
                $url="https://debaere.co.uk/".$this->icon;
            }
        }

        return $url;
    }

    public static function searchContent($request)
    {
        
        
        $data =Offering::Where('name','<>',null);

        if ($request->filled('name')) {
            $data->Where('name', 'like', "%" . $request->input('name') . "%");
        }
        if ($request->filled('sliced')) {
            $data->Where('sliced', '=', $request->input('sliced'));
        }
        if ($request->filled('status')) {
            $data->Where('status', '=', $request->input('status'));
        }
       
        $data->orderBy('sequence');
        
        return $data->paginate(20);
    }

    public static function getActiveOfferingArray()
    {
        $arr=[];
        $offerings=self::Where('status','<>',null)->orderBy('name', 'asc')->get();
        foreach($offerings as $offr)
        {
            $arr[$offr->id]=$offr->name;
        }

        return $arr;
    }

    public static function getActiveOfferings()
    {
        $arr=[];
        $offerings=Offering::Where('status','=',1)->orderBy('sequence')->get();
        foreach($offerings as $offering)
        {
            $arr[]=["id"=>$offering->id,
            "name"=>$offering->name,
            'image_url'=>$offering->getIconUrl(),
            'sliced'=>$offering->sliced
            ];
        }

        return $arr;
    }
}
