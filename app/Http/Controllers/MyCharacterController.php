<?php


namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Auth;

class MyCharacterController extends Controller
{
    public function myCharacters()
    {
        $user = Auth::user();
        if ($user) {
            return response()->json(["myCharacters" => []]);
        } else {
            return response()->json(["error" => "error"]);
        }
    }
}
