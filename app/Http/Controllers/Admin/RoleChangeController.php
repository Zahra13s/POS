<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class RoleChangeController extends Controller
{
    //direct admin list page
    public function adminList()
    {
        $data = User::select('id', 'name', 'nickname', 'email', 'phone', 'address', 'role')
            ->orWhere('role', 'admin')
            ->orWhere('role', 'superadmin')
            ->paginate(5);

        $userCount = User::where('role', 'user')->count();
        return view('admin.roleChange.adminList', compact('data', 'userCount'));
    }

    //delete admina account
    public function deleteAdminAccount($id)
    {
        User::where('id', $id)->delete();
        Alert::success('delete Success', 'Product Delete Succefully');
        return back();
    }

//direct user list page
    public function userList()
    {
        $data = User::select('id', 'name', 'nickname', 'email', 'phone', 'address', 'role')
            ->orWhere('role', 'user')
            ->paginate(5);
        $adminCount = User::orWhere('role', 'admin')
            ->orWhere('role', 'superadmin')->count();
        return view('admin.roleChange.userList', compact('data', 'adminCount'));
    }

    //delete admina account
    public function deleteUserAccount($id)
    {
        User::where('id', $id)->delete();
        Alert::success('delete Success', 'Product Delete Succefully');
        return back();
    }

//user to admin
    public function changeAdminRole($id)
    {
        User::where('id', $id)->update(['role' => 'admin']);
        Alert::success('Upgrade to Admin Success', 'Upgrade to Admin Succefully');
        return back();
    }

//admin to user
    public function changeUserRole($id)
    {
        User::where('id', $id)->update(['role' => 'user']);
        Alert::success('Down to Admin Success', 'Down to Admin Succefully');
        return back();
    }
}
