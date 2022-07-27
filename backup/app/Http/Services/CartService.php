<?php

namespace App\Http\Services;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function addToCart($product, $size, $amount)
    {
        $user = Auth::user();

        if ($this->productService->checkProductAmount($product, $size, $amount)) {
            $cart = $user->cart()->where('product_id', $product)->where('size_id', $size)->get();
            if ($cart->count()) {
                $cart[0]->cart_amount += $amount;
                $cart[0]->save();
                echo 'update';
            } else {
                $user->cart->create([
                    "product_id" => $product,
                    "size_id" => $size,
                    "cart_amount" => $amount,
                ]);
                echo 'create';
            }
        }
        else{
            throw new Exception("Số lượng sản phẩm không đủ",404);
        }
    }

    public function updateCart($product, $size, $amount)
    {
        $user = User::find(Auth::id());

        // if ($this->productService->checkProductAmount($product, $size, $amount)) {
        //     $cart = $user->cart()->where('product_id', $product)->where('size_id', $size)->get();
        //     if ($cart->count()) {
        //         $cart[0]->cart_amount = $amount;
        //         $cart[0]->save();
        //     } else {
        //         $user->cart->create([
        //             "product_id" => $product,
        //             "size_id" => $size,
        //             "cart_amount" => $amount,
        //         ]);
        //     }
        // }
        // else{
        //     throw new Exception("Số lượng sản phẩm không đủ",404);
        // }
        return Auth::id();
    }

    public function getCart(){
        $user=Auth::user();
        $data=$user->cart()->with('size','product')->get();
        return $data;
    }
}
