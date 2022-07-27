<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function userLogin(Request $request)
    {
        if (!Auth::check()) {
            return view('client.page.login');
        }
        return response()->redirectTo(route('home'));
    }

    public function handleUserLogin(Request $request)
    {
        $data = $request->all();
        foreach ($data as $index => $item) {
            if (!$item) {
                return back()->with('error', 'Please update field ' . str_replace('user_', "", $index))->withInput();
            }
        }
        if (Auth::attempt(['user_email' => $request->user_email, 'password' => $request->user_password])) {
            return response()->redirectTo(route('home'));
        } else {
            return back()->with('error', 'Đăng nhập thất bại')->withInput();
        }
    }

    public function userLogout(Request $request)
    {
        User::find(1)->tokens()->delete();
        Auth::logout();
        return response()->redirectTo(route('home'));
    }

    public function userRegister(Request $request)
    {
        if (!Auth::check()) {
            return view('client.page.register');
        }
        return view('client.page.home');
    }

    public function handleUserRegister(Request $request)
    {
        $data = $request->all();
        foreach ($data as $index => $item) {
            if (!$item) {
                return back()->with('error', 'Please update field ' . str_replace('user_', "", $index))->withInput();
            }
        }
        if ($data['user_password'] != $data['user_repassword']) {
            return back()->withInput();
        }
        User::create([
            ...$data,
            "user_password"=>bcrypt($data["user_password"])
        ]);
        return response()->redirectTo(route('login'));
    }
}
