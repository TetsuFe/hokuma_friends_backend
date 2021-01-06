<?php

namespace App\Http\Controllers\StoryProgress;

use App\StoryProgress;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class StoryProgressController extends Controller
{
    public function getLatestReadableId(){
        $storyProgress = auth()->user()->storyProgress()->first();
        return response()->json(['latest_readable'=> $storyProgress->latest_readable]);
    }
}
