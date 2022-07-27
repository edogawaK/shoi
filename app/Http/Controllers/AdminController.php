<?php

namespace App\Http\Controllers;

use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public $productService, $orderService;
    public function __construct(ProductService $productService, OrderService $orderService)
    {
        $this->productService=$productService;
        $this->orderService=$orderService;
    }

    public function user(){
        $data=User::all();
        return view('admin.page.user',[
            "data"=>$data
        ]);
    }

    public function product(){
        $data=$this->productService->getBySold();
        return view('admin.page.product',[
            "data"=>$data
        ]);
    }

    public function order(){
        $data=$this->orderService->getByDate();
        return view('admin.page.order',[
            "data"=>$data
        ]);
    }

    public function updateProduct($id){
        $data=Product::find($id);
        return view('admin.page.form.product',[
            "data"=>$data
        ]);
    }

    public function createProduct(){
        $data=Product::find($id);
        return view('admin.page.form.product',[
            "data"=>$data
        ]);
    }
}
