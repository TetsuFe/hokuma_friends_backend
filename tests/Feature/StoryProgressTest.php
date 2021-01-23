<?php

namespace Tests\Feature;

use App\StoryProgress;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class StoryProgressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetMyStoryProgress()
    {
        $user = factory(User::class)->create(['id'=>1]);
        $storyProgress = StoryProgress::query()->create(['user_id' => 1, 'id'=>1, 'latest_readable'=>1]);

        $response = $this->actingAs($user)->getJson('api/auth/storyProgress');
        $response->assertStatus(200);
        $response->assertJson(['latest_readable'=>$storyProgress->latest_readable]);
    }
}
