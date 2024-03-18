<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title','route','image','parent_id'];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public static function arrayForSelect() 
    {
    	$arr = [];
    	$categories = Category::all();
        foreach ($categories as $category) {
            $arr[$category->id] = $category->title;
        } 

        return $arr;
    }
    public function subcategory()
    {
        return $this->hasMany(\App\Models\Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    }
}
