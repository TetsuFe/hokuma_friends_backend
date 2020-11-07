<?php

namespace App\Http\Controllers;

use App\UserCharacter;
use Illuminate\Support\Facades\Auth;

class GachaController extends Controller
{
   public function platinum(){
       $user = Auth::user();
       $characters = UserCharacter::query()->where('user_id', $user->id)->get();
       $charactersRef = $user->characters();
       $randomCharacterId = random_int(1, 5);
       $newCharacter = new UserCharacter(['characterId' => $randomCharacterId]);
       if($characters->count() == 0){
           $charactersRef->save($newCharacter);
       }
       return response()->json(["characterId"=> $newCharacter->characterId]);
   }
}

// composer require --dev doctrine/dbal
