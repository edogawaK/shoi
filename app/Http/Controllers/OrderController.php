<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Http\Services\OrderService;
use App\Http\Services\ProductService;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $orderService, $cartService;

    public function __construct(OrderService $orderService, CartService $cartService)
    {
        $this->orderService = $orderService;
        $this->cartService = $cartService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=Auth::user();
        $cart=$this->cartService->getCart();
        return view('client.page.checkout',[
            "data"=>$cart,
            "user"=>$user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->orderService->store(Auth::id());
        return response()->redirectTo(route('profile'));
        // echo 'ok';
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
    public function update(Request $request,$id)
    {
        $order=Order::find($id);
        $order->order_status=0;
        $order->save();

        $detail=$order->detail;
        foreach($detail as $index=>$item){
            $product=Product::find($item->product_id);
            $size=$product->size()->wherePivot('size_id',$item->size_id)->get();
            $size[0]->pivot->amount+=$item->detail_amount;
            $size[0]->pivot->save();
        }
    }

    public function cancel(Request $request,$id)
    {
        $order=Order::find($id);
        $order->order_status=0;
        $order->save();

        $detail=$order->detail;
        foreach($detail as $index=>$item){
            $product=Product::find($item->product_id);
            $size=$product->size()->wherePivot('size_id',$item->size_id)->get();
            $size[0]->pivot->amount+=$item->detail_amount;
            $size[0]->pivot->save();
        }

        return response()->redirectTo(route('profile'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
