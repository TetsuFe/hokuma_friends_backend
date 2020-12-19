<?php

namespace App\Http\Controllers\Quest;

use App\QuestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Packages\quest\QuestResultValidator;

class QuestResultController extends Controller
{
    public function updateQuestClearStatus(Request $request)
    {
        $questId = $request->input('questId');
        $questResultValidator = new QuestResultValidator();
        if($questResultValidator->validateProperClearOrder($questId, Auth::user()->id)){
            $isCleared = $request->input('isCleared');
            $oldQuestResults = QuestResult::query()->where('questId', $questId)->where('user_id', Auth::user()->id);
            if ($oldQuestResults->count() == 0) {
                // $questResult = QuestResult::query()->create(['user_id' => Auth::user()->id, 'questId' => $questId, 'isCleared' => $isCleared]);
                $questResult = new QuestResult(['user_id' => Auth::user()->id, 'questId' => $questId, 'isCleared' => $isCleared]);
                Auth::user()->questResults()->save($questResult);
                return response()->json(['user_id' => $questResult->user()[0]->id, "questId" => $questResult->questId, 'isCleared' => $questResult->isCleared]);
            } else {
                $oldQuestResult = $oldQuestResults->get()->first();
                if(!$oldQuestResult->isCleared && $isCleared){
                    $oldQuestResults->update(['user_id' => Auth::user()->id, 'questId' => $questId, 'isCleared' => $isCleared]);
                    return response()->json(['user_id' => Auth::user()->id, "questId" => $questId, 'isCleared' => $isCleared]);
                }else{
                    return response()->json(['user_id' => Auth::user()->id, "questId" => $questId, 'isCleared' => $isCleared]);
                }
            }
        }else{
           return response()->json(['message'=>'bad request'], 400);
        }
    }

    public function index(){
        $questResults = Auth()->user()->questResults()->get();
        return response()->json(['questResults'=>$questResults]);
    }
}
