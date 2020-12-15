<?php

namespace App\Http\Controllers\Quest;

use App\Http\Controllers\Controller;

class QuestController extends Controller
{
    public function index(){
        $user = Auth()->user();

    }
}
