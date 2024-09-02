<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    //direct profile details
    public function profileDetails()
    {
        return view('admin.profile.details');
    }

    //direct profile details
    public function update(Request $request)
    {
        $this->validationCheck($request);
        //    dd($request->all());
        $adminData = $this->requestAdminData($request);
        // dd($adminData);
        if ($request->hasFile('image')) {
            // delete old Img
            // dd($request->oldImage);
            if ($request->oldImage != null) {
                if (file_exists(public_path('adminProfile/' . $request->oldImage))) {
                    unlink(public_path('adminProfile/' . $request->oldImage));
                }
            }

            // upload new Image
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(public_path() . '/adminProfile/', $fileName);
            $adminData['profile'] = $fileName;
        } else {
            $adminData['profile'] = $request->oldImage;
        }

        User::where('id', Auth::user()->id)->update($adminData);
        Alert::success('Profile Update Success', 'Profile Update Succefully');

        return back();
    }

    //direct profile
    public function accountProfile($id)
    {
        $account = User::where('id', $id)->first();
        // dd($account);
        return view('admin.profile.accountProfile', compact('account'));
    }

    //request admin data
    public function requestAdminData($request)
    {
        $data = [];

        if (Auth::user()->name != null) {
            $data['name'] = Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        } else {
            $data['nickname'] = Auth::user()->provider == 'simple' ? $request->name : Auth::user()->name;
        }

        $data['email'] = Auth::user()->provider == 'simple' ? $request->email : Auth::user()->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;

        return $data; // Make sure to return the data array
    }

    //validations
    private function validationCheck($request)
    {
        $rules = [

            'phone' => 'required|unique:users,phone,' . Auth::user()->id,
            'address' => 'required',
            'image' => 'mimes:png,jpg,jpeg,avif,webp',
        ];

        if (Auth::user()->provider == 'simple') {
            $rules['name'] = 'required';
            $rules['email'] = 'required|unique:users,email,' . Auth::user()->id;
        }

        $messages = [
            'name.required' => 'Name ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'image.mimes' => '"png,jpg,jpeg,avif,webp" file types များကိုသာ လက်ခံပါသည်။',
            'email.required' => 'Email ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'phone.required' => 'Phone ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
            'address.required' => 'Address ဖြည့်စွက်ရန် လိုအပ်ပါသည်။',
        ];

        $validator = $request->validate($rules, $messages);
    }

    //create admin account
    public function createAdminAccount()
    {
        return view('admin.profile.createAdminAccount');
    }

    //create
    public function create(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',
        ]);

        $adminAccount = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'provider' => 'simple',
        ];
        User::create($adminAccount);
        Alert::success('Admin Account Create Success', 'Admin Account Create Succefully');
        return back();
    }
}
