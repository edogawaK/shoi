<?php

namespace App\Http\Services;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Exception;

class OrderService
{
    public $productService, $cartService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }

    public function store($user)
    {
        try {
            $cart = $this->cartService->getCart();
            $total = 0;
            $order = User::find($user)->order()->create([
                "order_total" => $total
            ]);
            foreach ($cart as $index => $item) {
                if (!$this->productService->checkProductAmount($item->product_id, $item->size_id, $item->cart_amount)) {
                    $item->cart_amount = $this->productService->getAmount($item->product_id, $item->size_id);
                    $item->save();
                }
                $order->detail()->create([
                    "product_id" => $item->product_id,
                    "size_id" => $item->size_id,
                    "detail_amount" => $item->cart_amount,
                ]);
                $this->productService->updateAmount($item->product_id, $item->size_id, $item->cart_amount);

                $item->product->product_sold += $item->cart_amount;
                $item->product->save();

                $item->delete();


                $total += ($item->cart_amount * $item->product->product_price);
            }
            $order->order_total = $total;
            $order->save();
            return 1;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function update()
    {
    }

    public function getByTotal()
    {
        return Order::orderBy('order_total', 'desc')->with('user')->paginate(10);
    }

    public function getByDate()
    {
        return Order::orderBy('order_date', 'desc')->with('user')->paginate(10);
    }
}
