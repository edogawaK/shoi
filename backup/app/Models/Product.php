<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table='product';
    public $timestamps=false;
    public $primaryKey='product_id';
    protected $guarded = [];

    public function size(){
        return $this->belongsToMany(Size::class,"product_size","product_id","size_id")->withPivot("amount")->wherePivot("amount",">",0);
    }

    public function specificSize($size){
        return $this->belongsToMany(Size::class,"product_size","product_id","size_id")->withPivot("amount")->wherePivot("size_id",$size);
    }

    public function specificCategory($cate){
        $category=Category::find($cate);
        if($category->parent==NULL){
            return $this->belongsTo(Category::class,"category_id","category_id")->where("category_parent",$category->parent);
        }
        return $this->belongsTo(Category::class,"category_id","category_id")->where("category_id",$cate);
    }

    public function image(){
        return $this->hasMany(Image::class,"product_id","product_id");
    }

    // public function cart
}
