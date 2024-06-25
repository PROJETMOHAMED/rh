<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\DB;
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
        $this->validate($request, [
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

    public function showForgetPasswordForm()
    {
        return view('admin.auth.forgetpassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $checkExist = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if ($checkExist) {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();
        }



        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        FacadesMail::send('Mail.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token)
    {
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'token' => $token,
            ])
            ->first();
        // if (condition) {
        //     # code...
        // }
        return view('admin.auth.resetpassword', ['token' => $token]);
    }
    public function submitResetPasswordForm(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
