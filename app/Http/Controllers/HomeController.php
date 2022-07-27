<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public $productService;
    
    public function __construct(ProductService $productService)
    {
        $this->productService=$productService;
    }
    
    public function index(){
        $products=$this->productService->getAll();
        return view('client.page.home',['data'=>$products]);
    }
}
