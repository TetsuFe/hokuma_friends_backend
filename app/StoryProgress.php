<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoryProgress extends Model
{
    protected $fillable = ['latest_readable', 'user_id'];
}
