<?php

use App\Http\Controllers\CartController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test',function(){
    $data=Product::paginate(
        perPage: 2,
        page: 2
    );
    // dd($data->items());
    return view('client.page.test')->with(['data'=>$data]);
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home");
Route::get('/shop/{id}', 'App\Http\Controllers\ShopController@shop')->name("shop");
Route::get('/product/{id}', 'App\Http\Controllers\ProductController@product')->name("product");

// ---------------------------Cart

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart')->middleware('auth');
Route::post('/cart/store', 'App\Http\Controllers\CartController@store')->name('cart.store')->middleware('auth');
Route::post('/cart/update', 'App\Http\Controllers\CartController@update')->name('cart.update')->middleware('auth');
Route::post('/cart/delete', 'App\Http\Controllers\CartController@delete')->name('cart.delete')->middleware('auth');

// --------------------------Auth

Route::get('/login', 'App\Http\Controllers\AuthController@userLogin')->name("login");
Route::get('/register', 'App\Http\Controllers\AuthController@userRegister')->name("register");
Route::post('/login', 'App\Http\Controllers\AuthController@handleUserLogin')->name("handleLogin");
Route::post('/register', 'App\Http\Controllers\AuthController@handleUserRegister')->name("handleRegister");
Route::get('/logout', 'App\Http\Controllers\AuthController@userLogout')->name("logout")->middleware('auth');

//---------------------------Order

Route::post('/order','App\Http\Controllers\OrderController@store')->name('user.order.store')->middleware('auth');
Route::get('/order','App\Http\Controllers\OrderController@create')->name('user.order.create')->middleware('auth');
Route::put('/order/cancel/{id}','App\Http\Controllers\OrderController@cancel')->name('order.cancel')->middleware('auth');
Route::get('/profile','App\Http\Controllers\UserController@index')->name('profile')->middleware('auth');
Route::put('/profile','App\Http\Controllers\UserController@update')->name('profile.update')->middleware('auth');




Route::get("/admin/manage/user",'App\Http\Controllers\AdminController@user');
Route::get("/admin/manage/product",'App\Http\Controllers\AdminController@product');
Route::get("/admin/manage/order",'App\Http\Controllers\AdminController@order');
Route::get("/admin/manage/product/update/{id}",'App\Http\Controllers\AdminController@updateProduct');
Route::get("/admin/manage/product/create",'App\Http\Controllers\AdminController@createProduct');

// Route::prefix('/admin')->group(function(){
//     Route::resource('user', 'A');
// });



Route::get('/admin/login','App\Http\Controllers\Admin\AuthController@login')->name('admin.login');
Route::post('/admin/login','App\Http\Controllers\Admin\AuthController@handleLogin')->name('admin.handleLogin');
// Route::get('/admin/manage/dashbroad')
Route::middleware('auth.admin')->prefix('/admin/manage')->group(function(){
    Route::resource('user','App\Http\Controllers\Admin\UserController');
    Route::resource('product','App\Http\Controllers\Admin\ProductController');
    Route::resource('order','App\Http\Controllers\Admin\OrderController');
});

Route::middleware('auth.admin')->post('/form',function(Request $request){
    if($request->hasFile('product_image')){
        foreach($request->file('product_image') as $file){
            $file=$file->store('image','public');
            echo Storage::url($file);
        }
    }
})->name('form');