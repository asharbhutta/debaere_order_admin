<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Offering;


class Product extends Model
{
    protected $guarded=[];
     public function offering()
    {
        return $this->belongsTo(Offering::class, 'offering_id');
    }
    use HasFactory;
}
