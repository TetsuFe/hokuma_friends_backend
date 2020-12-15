<?php

namespace App\Http\Controllers\Gacha;

use App\UserCharacter;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Packages\gacha\PlatinumGacha;

class GachaController extends Controller
{
   public function platinum(){
       $gacha = new PlatinumGacha();
       $randomCharacterId = $gacha->draw();
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
