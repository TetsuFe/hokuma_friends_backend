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
    use RefreshDatabase;

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

    public function testUpdateStoryProgress(){
        $user = factory(User::class)->create(['id'=>1]);
        StoryProgress::query()->create(['user_id'=>1, 'id'=>1, 'latest_readable'=>1]);

        $response = $this->actingAs($user)->postJson('api/auth/updateStoryProgress', ['read_story_id'=>1]);

        $response->assertStatus(200);
        $response->assertJson(['latest_readable'=>2]);
        $this->assertDatabaseHas('story_progress', ['user_id'=>1, 'latest_readable'=>2]);
    }

    public function testUpdateStoryProgressWhenItDoesNotExistYet(){
        $user = factory(User::class)->create(['id'=>1]);

        $response = $this->actingAs($user)->postJson('api/auth/updateStoryProgress', ['read_story_id'=>1]);

        $response->assertStatus(200);
        $response->assertJson(['latest_readable'=>2]);
        $this->assertDatabaseHas('story_progress', ['user_id'=>1, 'latest_readable'=>2]);
    }

    public function testUpdateStoryProgressWithBadReadStoryIdWhenItDoesNotExistYet(){
        $user = factory(User::class)->create(['id'=>1]);

        $response = $this->actingAs($user)->postJson('api/auth/updateStoryProgress', ['read_story_id'=>2]);

        $response->assertStatus(400);
    }


    public function testStoryProgressNotExist(){
        $user = factory(User::class)->create(['id'=>1]);

        $response = $this->actingAs($user)->getJson('api/auth/storyProgress');

        $response->assertStatus(200);
        $response->assertJson(['latest_readable'=>1]);
    }
}
