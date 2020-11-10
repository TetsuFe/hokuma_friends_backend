<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestResultController extends Controller
{
    public function updateQuestClearStatus(Request $request)
    {
        $questId = $request->input('questId');
        $isCleared = $request->input('isCleared');
        Log::debug([$questId, $isCleared]);
        return response()->json(["questId" => 1, 'isCleared'=>true]);
    }
}
