<?php

namespace App\Http\Controllers;

use App\QuestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestResultController extends Controller
{
    public function updateQuestClearStatus(Request $request)
    {
        $questId = $request->input('questId');
        $isCleared = $request->input('isCleared');
        if (QuestResult::query()->where('questId', $questId)->where('user_id', Auth::user()->id)->count() == 0) {
            $questResult = QuestResult::query()->create(['user_id' => Auth::user()->id, 'questId' => $questId, 'isCleared' => $isCleared]);
            return response()->json(['user_id' => $questResult->user()[0]->id, "questId" => $questResult->questId, 'isCleared' => $questResult->isCleared]);
        } else {
            return response()->json(['user_id' => Auth::user()->id, "questId" => $questId, 'isCleared' => $isCleared]);
        }
    }
}
