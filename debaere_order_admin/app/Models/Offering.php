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
            "icon"
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
        
        
        $data = new Offering();

        if ($request->filled('name')) {
            $data->Where('name', 'like', "%" . $request->input('name') . "%");
        }
        if ($request->filled('sliced')) {
            $data->Where('sliced', '=', $request->input('location'));
        }
        if ($request->filled('status')) {
            $data->Where('status', '=', $request->input('status'));
        }
       
        $data->orderBy('created_at', 'desc');
        
        return $data->paginate(20);
    }
}
