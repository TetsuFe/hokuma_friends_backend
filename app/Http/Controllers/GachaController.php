<?php

namespace App\Http\Controllers;

class GachaController extends Controller
{
   public function platinum(){
       return response()->json(["characterId"=> random_int(1, 5)]);
   }
}
