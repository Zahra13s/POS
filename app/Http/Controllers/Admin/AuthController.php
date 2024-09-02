<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    //direct change password
    public function passwordChange()
    {
        return view('admin.password.changePassword');
    }

    //change password
    public function changePassword(Request $request)
    {
        $validator = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $dbHashPasssword = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashPasssword = $dbHashPasssword['password'];
        $userOldPassword = $request->oldPassword;

        if (Hash::check($userOldPassword, $dbHashPasssword)) {
            $data = [
                'password' => Hash::make($request->newPassword),
            ];
            User::where('id', Auth::user()->id)->update($data);

            Alert::success('Password Change Success', 'Password Changed Succefully');
            return back();
        }
        Alert::error('Error Message', 'Do not Match');
        return back();
    }
}
