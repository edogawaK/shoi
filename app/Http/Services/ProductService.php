<?php

namespace App\Http\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Exception;
use Illuminate\Http\Request;

class ProductService
{

    public $perPage = 12;
    public $sortField = "product_sold";
    public $sortMode = "desc";

    public function getAll($page = 1)
    {
        return Product::orderBy($this->sortField, $this->sortMode)->with('size')->paginate(
            perPage: $this->perPage,
            page: $page
        );
    }

    public function getByCategory($cate, $page = 1)
    {
        // return Category::find($cate)->product()->with('size')->paginate(
        //     perPage: $this->perPage,
        //     page: $page
        // );

        return Product::where('category_id',$cate)->orderBy($this->sortField,$this->sortMode)->with('size')->paginate(
            perPage: $this->perPage,
            page: $page
        );
    }

    public function getProduct($id)
    {
        $data = Product::where('product_id', $id)->with('image', 'size')->get();
        $data = $data[0];
        foreach ($data->size as $item) {
            $item->size_name = Size::find($item->size_id)->size_name;
        }
        return $data;
    }

    public function getAmount($product, $size)
    {
        return Product::find($product)->size->where('size_id', $size)[0]->pivot->amount;
    }

    public function updateAmount($product, $size, $amount)
    {
        $pivot = Product::find($product)->size()->wherePivot('size_id', $size)->get()[0]->pivot;
        $pivot->amount -= $amount;
        if ($pivot->amount <= 0) {
            $pivot->delete();
        } else {
            $pivot->save();
        }
    }

    public function checkProductAmount($id, $size, $amount)
    {
        $data = Product::find($id)->size()->wherePivot('size_id', $size)->get();
        if ($data->count() == 0) {
            throw new Exception("Product {$id} have not size: {$size}", 404);
        }
        if ($data[0]->pivot->amount >= $amount) {
            return true;
        }
        return false;
    }

    public function setSort($sortField, $sortMode)
    {
        $this->sortField = $sortField;
        $this->$sortMode = $sortMode;
    }
}
