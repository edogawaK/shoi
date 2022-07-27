<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/','App\Http\Controllers\HomeController@index')->name("home");

Route::get('/shop/{id}','App\Http\Controllers\ShopController@shop')->name("shop");

Route::get('/product/{id}','App\Http\Controllers\ProductController@product')->name("product");

Route::get('/oki',function(){return "okii";});


// ---------------------------Cart

Route::post('/cart','App\Http\Controllers\ShopController@addToCart')->name('cart')->middleware('auth');

Route::get('/cart','App\Http\Controllers\ShopController@cart')->middleware('auth');

// --------------------------Auth

Route::get('/login','App\Http\Controllers\AuthController@userLogin')->name("login");

Route::post('/login','App\Http\Controllers\AuthController@handleUserLogin')->name("handleLogin");

Route::get('/logout','App\Http\Controllers\AuthController@userLogout')->name("logout");
