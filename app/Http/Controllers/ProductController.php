<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }

    public function product(Request $request, $id){
        $data=$this->productService->getProduct($id);
        return view('client.page.product',[
            "data"=>$data
        ]);
    }
}
