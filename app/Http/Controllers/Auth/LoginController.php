<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends \App\Http\Controllers\Controller
{
    public function redirectToTwitterProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterProviderCallback(){
        $user = Socialite::driver('twitter')->user();
        dd($user);
    }
}
