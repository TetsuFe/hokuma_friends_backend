<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends \App\Http\Controllers\Controller
{
    public function redirectToTwitterProvider(){
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterProviderCallback(){
        try {
            $user = Socialite::driver("twitter")->user();
        }
        catch (\Exception $e) {
            return redirect('/login')->with('oauth_error', 'ログインに失敗しました');
            // エラーならログイン画面へ転送
        }
        // token（メールアドレスと違ってソーシャルアカウントで不変）を持ったユーザがなければ作る
        // あれば token を持ったユーザを返す
        $myinfo = User::firstOrCreate(['oauth_token' => $user->token ],
            ['name' => $user->nickname,'email' => $user->getEmail(), 'oauth_token' => $user->token]);
        Auth::login($myinfo);
        return redirect()->to('/'); // homeへ転送

    }
}
