<?php

namespace Tests\Feature;

use App\QuestResult;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class QuestResultTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNotAuthenticated()
    {
        $response = $this->postJson('/api/questResult/updateQuestClearResult', ['questId' => 1, 'isCleared' => true]);

        $response->assertStatus(401);
    }

    public function testAuthenticated()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->postJson('/api/questResult/updateQuestClearResult', ['questId' => 1, 'isCleared' => true]);
        $response->assertStatus(200);
    }

    public function testPostClearedQuest(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->postJson('/api/questResult/updateQuestClearResult', ['questId'=>1, 'isCleared'=>true]);
        $response->assertStatus(200);
        $response->assertJson(['user_id'=>$user->id,'questId'=>1,'isCleared'=>true]);
    }

    public function testUpdateQuest(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->postJson('/api/questResult/updateQuestClearResult', ['questId'=>1, 'isCleared'=>false]);
        $response->assertJson(['user_id'=>$user->id,'questId'=>1,'isCleared'=>false]);
        Log::debug($response->json());
        $response2 = $this->actingAs($user)->postJson('/api/questResult/updateQuestClearResult', ['questId'=>1, 'isCleared'=>true]);
        Log::debug($response2->json());
        $response2->assertJson(['user_id'=>$user->id,'questId'=>1,'isCleared'=>true]);
        $questResult = QuestResult::query()->where('user_id',$user->id)->where('questId',1)->get()->first();
        assert($questResult->isCleared, true);
    }

    public function testGetQuestResults(){
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->postJson('/api/questResult/updateQuestClearResult', ['questId'=>1, 'isCleared'=>false]);
        $response->assertJson(['user_id'=>$user->id,'questId'=>1,'isCleared'=>false]);
        $response2 = $this->actingAs($user)->getJson('api/questResult/index');
        $response2->assertJson(['questResults' => ['0' => ['user_id' => $user->id, 'questId'=> 1, 'isCleared' => false]]]);
    }
}
