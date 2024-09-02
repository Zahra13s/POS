<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
     //profile
     public function profile($id)
     {
         $account = User::where('id', $id)->first();
         return view('user.profile', compact('account'));
     }

     //direct update user profile
     public function profileDtails($id)
     {
         $account = User::where('id', $id)->first();
         return view('user.updateProfile', compact('account'));
     }

     //update user profile
     public function userprofileUpdate(Request $request)
     {

         $validator = $request->validate([
             'name' => 'required',
             'email' => 'required',
             'phone' => 'required',
             'address' => 'required',
         ]);

         $userData = [
             'name' => $request->name,
             'phone' => $request->phone,
             'email' => $request->email,
             'address' => $request->address,

         ];

         if ($request->hasFile('image')) {
             // delete old Img
             // dd($request->oldImage);
             if ($request->oldImage != null) {
                 if (file_exists(public_path('userProfile/' . $request->oldImage))) {
                     unlink(public_path('userProfile/' . $request->oldImage));
                 }
             }

             // upload new Image
             $fileName = uniqid() . $request->file('image')->getClientOriginalName();
             $request->file('image')->move(public_path() . '/userProfile/', $fileName);
             $userData['profile'] = $fileName;
         } else {
             $userData['profile'] = $request->oldImage;
         }
         // dd($userData);

         User::where('id', Auth::user()->id)->update($userData);

         return back();

     }
}
