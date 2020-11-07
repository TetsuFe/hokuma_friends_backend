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
            $characterIds = Auth::user()->characters()->get()->map(function ($character){return $character->characterId;});
            return response()->json(["myCharacters" => $characterIds]);
        } else {
            return response()->json(["error" => "error"]);
        }
    }
}
