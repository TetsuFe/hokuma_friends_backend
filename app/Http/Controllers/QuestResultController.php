<?php

namespace App\Http\Controllers;

use App\QuestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestResultController extends Controller
{
    public function updateQuestClearStatus(Request $request)
    {
        $questId = $request->input('questId');
        $isCleared = $request->input('isCleared');
        Log::debug([$questId, $isCleared]);
        $questResult = QuestResult::query()->create(['questId'=> $questId, 'isCleared'=>$isCleared]);
        return response()->json(["questId" => $questResult->questId, 'isCleared'=>$questResult->isCleared]);
    }
}
