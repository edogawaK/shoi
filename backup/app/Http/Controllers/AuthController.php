<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function userLogin(Request $request){
        if(!Auth::check()){
            return view('client.page.login');
        }
        return response()->redirectTo(route('home'));
    }
    
    public function handleUserLogin(Request $request){
        if(Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_password])){
            $token = User::find(Auth::id())->createToken('token')->plainTextToken;
            echo $token;
            return response()->cookie('token',$token,1);
        }
        else{
            echo "No";
        }
    }

    public function userLogout(Request $request){
        User::find(1)->tokens()->delete();
        Auth::logout();
    }
}
