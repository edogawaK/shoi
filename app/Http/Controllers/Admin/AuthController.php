<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('admin.page.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return response()->redirectTo(route('admin.login'));
    }

    public function handleLogin(Request $request){
        if(!Auth::guard('admin')->attempt(["admin_email"=>$request->admin_email,"password"=>$request->admin_password])){
            return response()->redirectTo(route('admin.login'));
        }
        return response()->redirectTo(route('product.index'));
        // var_dump($request->all());
        // var_dump(Auth::guard('admin')->attempt(["admin_email"=>$request->admin_email,"password"=>$request->admin_password]));
    }
}
