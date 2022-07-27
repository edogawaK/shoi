<?php

namespace App\Http\Services;

use App\Models\User;

class OrderService
{
    public $productService, $cartService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function store($user){
        // $cart=$this->cartService->getCart();
        // $total=0;
        // $order=User::find($user)->order()->create([
        //     "order_total"=>$total
        // ]);
        // foreach($cart as $index=>$item){
        //     if(!$this->productService->checkProductAmount($item->product_id,$item->size_id,$item->cart_amount)){
        //         $item->cart_amount=$this->productService->getAmount($item->product_id,$item->size_id);
        //         $item->save();
        //     }
        //     $order->detail()->create([
        //         "product_id"=>$item->product_id,
        //         "size_id"=>$item->size_id,
        //         "detail_amount"=>$item->cart_amount,
        //     ]);
        //     $item->delete();
        //     $total+=($item->cart_amount*$item->product->product_price);
        // }
        // $order->order_total=$total;
        // $order->save();
        return 1;
    }

    public function update(){

    }
}
