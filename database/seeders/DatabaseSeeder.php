<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $contents = Storage::get('seed/category.json');
        $contents=json_decode($contents,true);
        foreach($contents as $item){
            $child=array_map(function($i){
                return new Category(['category_name'=>$i]);
            },$item['child']??[]);
            Category::create([
                'category_name'=>$item['category']
            ])->child()->saveMany($child);
        }

        $contents = Storage::get('seed/product.json');
        $contents = json_decode($contents, true);
        foreach ($contents as $item) {
            $category = $item['category'];
            $products = $item['data'];
            foreach ($products as $product) {
                $image = array_map(function ($i) {
                    return new Image(['image_link' => $i]);
                }, $product['image'] ?? []);
                Product::create([
                    'product_name' => $product['name'],
                    'product_price' => $product['price']>1000000000?$product['price']/100000:$product['price'],
                    'product_cost' => 100000,
                    'product_description' => $product['descript'],
                    'product_avt' => $product['image'][0],
                    'product_amount' => 100,
                    'category_id' => $category
                ])->image()->saveMany($image);
            }
        }
        Size::insert([
            ['size_name'=>'S'],
            ['size_name'=>'M'],
            ['size_name'=>'L'],
        ]);
        for($i=1;$i<312+2;$i++){
            Product::find($i)->size()->attach(1,['amount'=>10]);
            Product::find($i)->size()->attach(2,['amount'=>10]);
            Product::find($i)->size()->attach(3,['amount'=>10]);
        }
        Admin::create([
            "admin_name"=>"admin",
            "admin_email"=>"admin@kr",
            "admin_password"=>bcrypt("admin@kr")
        ]);
    }
}
