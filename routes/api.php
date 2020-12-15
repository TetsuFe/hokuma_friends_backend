<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Gacha\GachaController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Character\MyCharacterController;
use App\Http\Controllers\Quest\QuestResultController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/gacha/platinum', [GachaController::class, 'platinum'])->middleware('auth:api');;
Route::get('/myCharacters', [MyCharacterController::class, 'myCharacters'])->middleware('auth:api');
Route::post('/register', [RegisterController::class, 'register']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});

Route::get('/', function () {
    return response()->json(['error' => 'Unauthenticated.'], 401);
})->name('login');

Route::post('/questResult/updateQuestClearResult', [QuestResultController::class, 'updateQuestClearStatus'])->middleware('auth:api');
// Route::post('/questResult/updateQuestClearResult', [QuestResultController::class, 'updateQuestClearStatus']);
Route::get('/questResult/index', [QuestResultController::class, 'index'])->middleware('auth:api');
