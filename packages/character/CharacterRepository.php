<?php

namespace Packages\character;

use \App\Character;

class CharacterRepository
{
    public function countAll()
    {
        return Character::all()->count();
    }
}
