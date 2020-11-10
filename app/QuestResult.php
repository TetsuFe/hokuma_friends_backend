<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestResult extends Model
{
    protected $fillable = [
        'questId',
        'isCleared',
    ];
}
