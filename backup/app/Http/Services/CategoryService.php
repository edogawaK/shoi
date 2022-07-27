<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class CategoryService
{
    public function getActiveParent(){
        $categories=Category::where("category_status",1)->where("category_parent",NULL)->get();
        return $categories;
    }

    public function getActiveSub(){
        $categories=Category::where("category_status",1)->where("category_parent",NULL)->get();
        return $categories;
    }

    public function getAll(){
        $categories=Category::where("category_status",1)->where("category_parent",NULL)->with('child')->get();
        return $categories;
    }
}
