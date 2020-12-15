<?php

namespace Packages\gacha;

use Packages\character\CharacterRepository;

class PlatinumGacha{
    public function draw(){
        return random_int(1, $this->getAllCharacterNumber());
    }

    public function getAllCharacterNumber(){
        $characterRepository = new CharacterRepository();
        return $characterRepository->countAll();
    }
}
