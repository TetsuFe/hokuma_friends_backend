<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class GachaController extends Controller
{
   public function platinum(){
       return response()->json(["characterId"=> random_int(1, 5)]);
   }
}
