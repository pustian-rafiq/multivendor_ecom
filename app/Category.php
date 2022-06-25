<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title', 'slug', 'photo','summary','is_parent','parent_id','status'
    ];

    public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }

    //This method is called from category controller. It gets the child category
    public static function getChildByParentID($id){
        return Category::where('parent_id',$id)->pluck('title','id');
    }


}
