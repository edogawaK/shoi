<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Exception;
use Illuminate\Http\Request;

class ProductService
{
    public function getBySold(){
        return Product::orderBy("product_sold","desc")->with('size')->paginate(10);
    }

    public function getByNew(){
        return Product::orderBy("product_date","desc")->with('size')->paginate(10);
    }

    public function getByCategory($cate){
        return Category::find($cate)->product()->with('size')->paginate(10);
    }

    public function getProduct($id){
        $data=Product::where('product_id',$id)->with('image','size')->get();
        $data=$data[0];
        foreach($data->size as $item){
            $item->size_name=Size::find($item->size_id)->size_name;
        }
        return $data;
    }

    public function checkProductAmount($id,$size,$amount){
        $data=Product::find($id)->size()->wherePivot('size_id',$size)->get();
        if($data->count()==0){
            throw new Exception("Product {$id} have not size: {$size}",404);
        }
        if($data[0]->pivot->amount>=$amount){
            return true;
        }
        return false;
    }
}
