<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'photo','description','cat_id','child_cat_id','vendor_id','brand_id',
        'discount','offer_price','price','stock','size','conditions'
    ];
}
