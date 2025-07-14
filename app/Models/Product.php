<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
     protected $fillable = [
        'username',
        'product_name',
        'product_description',
        'image',
        'price',
    ];
}
