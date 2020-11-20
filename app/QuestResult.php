<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestResult extends Model
{
    public function user(){
        return $this->belongsTo('\App\User')->get();
    }

    protected $fillable = [
        'user_id',
        'questId',
        'isCleared',
    ];

    protected $casts = [
        'isCleared' => 'boolean'
    ];
}
