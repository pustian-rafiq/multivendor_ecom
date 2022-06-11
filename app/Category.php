<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug', 'photo','summary','is_parent','parent_id','status'
    ];
}
