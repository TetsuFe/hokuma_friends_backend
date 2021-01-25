<?php

namespace App\Http\Controllers\StoryProgress;

use App\StoryProgress;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StoryProgressController extends Controller
{
    public function getLatestReadableId(){
        $storyProgress = auth()->user()->storyProgress()->first();
        if(is_null($storyProgress)){
            return response()->json(['latest_readable'=>1]);
        }else{
            return response()->json(['latest_readable'=> $storyProgress->latest_readable]);
        }
    }

    public function updateStoryProgress(Request $request){
        $storyProgress = auth()->user()->storyProgress()->first();
        $readStoryId = $request->json('read_story_id');
        if($readStoryId == $storyProgress->latest_readable){
            $storyProgress->latest_readable = $storyProgress->latest_readable + 1;
            $storyProgress->save();
            return response()->json(['latest_readable'=> $storyProgress->latest_readable]);
        }else{
            return response()->json(['message'=> 'bad request'], 400);
        }
    }
}
