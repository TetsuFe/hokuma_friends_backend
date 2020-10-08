<?php

namespace App\http\controllers;

use App\Http\Controllers\Controller;

class MyCharactersController extends Controller{
    public function list(){
        return response()->json(['myCharacters'=> []]);
    }
}
