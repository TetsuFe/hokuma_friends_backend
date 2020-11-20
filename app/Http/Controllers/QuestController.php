<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestController extends Controller
{
    public function index(){
        $user = Auth()->user();

    }
}
