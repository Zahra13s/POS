<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PasswordController extends Controller
{
    //

    // direct pw page
    public function changeUserPassword()
    {
        return view('user.changePassword');
    }

    //change password
    public function userChangePassword(Request $request)
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
