<?php

namespace App\Http\Controllers;

use App\UserCharacter;
use Illuminate\Support\Facades\Auth;

class GachaController extends Controller
{
   public function platinum(){
       $randomCharacterId = random_int(1, 5);
       $newCharacter = new UserCharacter(['characterId' => $randomCharacterId]);

       $user = Auth::user();
       $characters = UserCharacter::query()->where('user_id', $user->id)->get();
       if(!$characters->contains($randomCharacterId)){
           $charactersRef = $user->characters();
           $charactersRef->save($newCharacter);
       }
       return response()->json(["characterId"=> $newCharacter->characterId]);
   }
}

// composer require --dev doctrine/dbal
