<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\ProductService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public $productService, $cartService;

    public function __construct(ProductService $productService, CartService $cartService)
    {
        $this->productService = $productService;
        $this->cartService = $cartService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->cartService->getCart();
        return view('client.page.cart', [
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->product_id;
        $size = $request->size_id;
        $amount = $request->amount;
        try{
            $this->cartService->addToCart(
                product: $product,
                size: $size,
                amount: $amount
            );
            return response()->redirectTo(route('cart'));
        }
        catch(Exception $e){
            return back()->with(['error'=>"Không đủ số lượng"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $this->cartService->updateCart(
                product: $request->product_id,
                size: $request->size_id,
                amount: $request->amount
            );
            return response()->redirectTo(route('cart'));
        } catch (Exception $e) {
            return back()->with(['error' => 'Không thể cập nhật số lượng']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function delete(Request $request)
    {
        $this->cartService->deleteCart($request->product_id, $request->size_id);
        return back();
    }
}
