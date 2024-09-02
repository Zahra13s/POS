<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    //redirect sociallite
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    //callback sociallite
    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        // dd($user);

        $user = User::updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $socialUser->id,
            ],
            [
                'name' => $socialUser->name,
                'nickname' => $socialUser->nickname,
                'email' => $socialUser->email,
                'provider_token' => $socialUser->token,
                'role' => 'user',

            ]);

        Auth::login($user);

        if (Auth::user()->role == 'admin') {
            return to_route('adminDashboard');
        }

        if (Auth::user()->role == 'user') {
            return to_route('userDashboard');
        }

        // return redirect('dashboard');
    }
}
