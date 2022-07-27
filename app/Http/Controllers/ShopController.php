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
        switch ($request->sort) {
            case 'new':
                $this->productService->setSort("product_date", "desc");
                break;
            case 'high':
                $this->productService->setSort("product_price", "desc");
                break;
            case 'low':
                $this->productService->setSort("product_price", "asc");
                break;
            default:
                $this->productService->setSort("product_sold", "desc");
                break;
        }
        $products = $this->productService->getByCategory($cate, $request->page ?? 1);

        return view('client.page.shop', [
            "data" => $products,
            "category" => $cate
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

    // public function setSort($sort="product_price",$mode=true){
    //     $
    // }
}
