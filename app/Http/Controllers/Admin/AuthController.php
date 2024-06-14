<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function LoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request,[
            "email" => "required|email|exists:users,email|max:200",
            "password" => "required"
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->intended('/admin')->with([
                    "success" => __("welcome to Admin Dashboard"),
                ]);
        } else {
            return redirect()->back()->with([
                "error" => __('Invalid credentials')
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
