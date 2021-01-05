<?php

namespace Tests\Feature;

use App\StoryProgress;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoryProgressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $storyProgress = StoryProgress::query()->create(['id'=>1, 'latest_readable'=>1]);

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->getJson('api/auth/storyProgress');

        $response->assertStatus(200);
        $response->assertJson(['latest_readable'=>$storyProgress->latest_readable]);
    }
}
