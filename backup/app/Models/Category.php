<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $table = 'category';
    public $timestamps = false;
    public $primaryKey = 'category_id';
    protected $guarded = [];

    public function product()
    {
        return $this->hasMany(Product::class, "category_id", "category_id")->where('product_status',1)->orderBy("product_sold", "desc");
    }

    public function child()
    {
        return $this->hasMany(Category::class, "category_parent", "category_id")->where("category_status", 1);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, "category_parent", "category_id")->where("category_status", 1);
    }
}
