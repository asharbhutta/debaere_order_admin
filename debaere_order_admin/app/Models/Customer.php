<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
            "name",
            "company_name" ,
            "contact_number",
            "contact_person",
            "address_1" ,
            "address_2" ,
            "address_3" ,
            "address_4" ,
            "d_address_1" ,
            "d_address_2" ,
            "d_address_3" ,
            "d_address_4" ,
            "location",
            "status",
            'user_id'
    ];  

    use HasFactory;
}
