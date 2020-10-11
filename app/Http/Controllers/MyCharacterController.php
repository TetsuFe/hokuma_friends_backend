<?php


namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Auth;
use \App\User;

class MyCharacterController extends Controller
{
    public function myCharacters()
    {
        $user = Auth::user();
        if ($user) {
            // return response()->json(["myCharacters" => []]);
            // $user->characters()->saveMany([new \App\UserCharacter(['characterId'=>1])]);
            //return response()->json(["myCharacters" => [User::with('characters')->find(1)]]);
            return response()->json(["myCharacters" => $user->characters]);
        } else {
            return response()->json(["error" => "error"]);
        }
    }
}
