<?php

namespace App\Http\Controllers\StoryProgress;

use App\StoryProgress;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StoryProgressController extends Controller
{
    public function getLatestReadableId(){
        return response()->json(['latest_readable'=> StoryProgress::query()->where('id', '=', 1)->first()->latest_readable]);
    }
}
