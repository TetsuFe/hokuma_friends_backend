<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestResultController extends Controller
{
    public function updateQuestClearStatus(Request $request){
        $json = $request->input;
        Log::debug($json);
        return response()->json(["isSuccess"=>true]);
    }
}
