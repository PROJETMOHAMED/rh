<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view("admin.content.profile.index");
    }

    function UpdateProfile(Request $request)
    {
        $this->validate($request, [
            "name" => "required|max:200",
            "email" => "required|email|max:200",
        ]);
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->update([
            "name" => $request->name,
            "email" => $request->email
        ]);
        return redirect()->back()->with([
            "success" => "profile update with success"
        ]);
    }

    function resetPassword(Request $request)
    {
        $this->validate($request, [
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ]);

        $id = Auth::user()->id;

        $user = User::find($id);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with([
            'success' => 'Password reset successfully.',
        ]);
    }
}
