<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestResultTest extends TestCase
{
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

}
