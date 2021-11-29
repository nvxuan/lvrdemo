<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    const USER_KEY = 'USER';
    const CART_KEY = 'CART';
    public function login()
    {
        return view('auth.login');
    }
    public function dologin(Request $request)
    {
        if ($request) {
            $password = $request->password;
            $email = $request->email;
            //dd($email . $password);
            if (!$request->session()->exists(self::USER_KEY)) {
                $user = User::where('email', $email)->where('password', $password)->first();
                if ($user) {
                    $request->session()->put(self::USER_KEY, $user);
                    return redirect(route('fe.home'));
                } else {
                    //return view('auth.login');
                    //$request->session()->put('error', 'LOI');
                    return redirect()->back()->with('error', 'Đăng Nhập Thất bại');
                }
            } else {
                return redirect(route('fe.home'));
            }
        }
    }
    public function checkout(Request $request)
    {
        if ($request) {
            if (!$request->session()->exists(self::USER_KEY)) {
                return view('auth.login');
            } else {
                return view('fe.user.checkout');
                //return redirect(route('fe.checkout'));
            }
        }
    }

    public function checkLevel(Request $request)
    {
        if ($request) {
            $level = $request->session()->get(self::USER_KEY)->level;
            if ($level == 1) {
                return view('be.home');
            } else {
                return redirect(route('fe.home'));
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget(self::USER_KEY);
        $request->session()->forget(self::CART_KEY);
        return view('auth.login');
    }
}