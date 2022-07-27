<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\ProductService;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        switch ($request->filter) {
            case 'date':
                $this->productService->setSort('product_date', 'desc');
                // $data = $this->productService->getByNew();
                break;
            case 'sold':
                $this->productService->setSort('product_sold', 'desc');
                // $data = $this->productService->getBySold();
                break;
            default:
                $this->productService->setSort('product_price', 'desc');
                // $data = $this->productService->getByNew();
                break;
        }
        $data=$this->productService->getAll($request->page??1);
        return view('admin.page.product.index', [
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
        $size = Size::all();
        $category = Category::where('category_parent', '<>', NULL)->get();
        return view('admin.page.product.create', [
            "size" => $size,
            "category" => $category
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
        $product = Product::create([
            "category_id" => $request->category,
            "product_avt" => "",
            "product_name" => $request->product_name,
            "product_cost" => $request->product_cost,
            "product_price" => $request->product_price,
            "product_description" => $request->product_description,
        ]);
        if ($request->hasFile('product_avt')) {
            $url = $request->file('product_avt')->store('image', 'public');
            $product->product_avt = asset('/storage/' . $url);
        }
        $product->save();
        $url = [];
        if ($request->hasFile('product_avt')) {
            foreach ($request->file('product_image') as $file) {
                $url[] = ["image_link" =>  asset('/storage/' . $file->store('image', 'public'))];
            }
        }
        $product->image()->create(...$url);
        foreach ($request->size as $index => $item) {
            if ($item) {
                $product->size()->attach($index, [
                    "amount" => $item
                ]);
            }
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
        $data = Product::find($id);
        return view('admin.page.product.edit', [
            "data" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        foreach ($request->size as $size => $amount) {
            $pivot = $product->size()->wherePivot('size_id', $size)->get()[0]->pivot;
            $pivot->amount = $amount;
            $pivot->save();
        }
        foreach ($request->image as $image => $link) {
            $image = $product->image()->where('image_id', $image)->get()[0];
            if ($link == "") {
                $image->delete();
            } else {
                $image->image_link = $link;
                $image->save();
            }
        }
        return back();
        // return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $product=Product::find($id);
        // $product->product_status=0;
        // $product->save();

        // $size=$product->size;
        // foreach($size as $item){
        //     $item->pivot->delete();
        // }
        return "delete";
    }
}
