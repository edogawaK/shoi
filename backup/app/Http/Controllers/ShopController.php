<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Services\CartService;
use App\Http\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public $productService, $cartService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function shop(Request $request, $cate = 2)
    {
        // return "shop";
        $products = $this->productService->getByCategory($cate);
        return view('client.page.shop', [
            "data" => $products
        ]);
    }

    public function cart()
    {
        $data = $this->cartService->getCart();
        return view('client.page.cart', [
            "data" => $data
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = $request->product_id;
        $size = $request->size_id;
        $amount = $request->amount;
        $this->cartService->addToCart(
            product: $product,
            size: $size,
            amount: $amount
        );
        return response()->redirectTo(route('cart'));
    }

    public function updateCart(Request $request)
    {
        // $response = [];
        // try {
        //     return $this->cartService->updateCart(
        //         product: $request->product,
        //         size: $request->size,
        //         amount: $request->amount
        //     );
        //     // $response['status'] = 200;
        //     // $response['message'] = "Cập nhật giỏ thành công";
        // } catch (Exception $e) {
        //     throw new ApiException("Không thể cập nhật giỏ hàng", 404);
        // }
        // return response()->json($response);
        echo Auth::id();
    }
}
