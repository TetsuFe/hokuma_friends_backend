<?php

namespace Tests\Feature;

use App\UserCharacter;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class MyCharactersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNotAuthenticated()
    {
        $response = $this->get('/api/myCharacters/');
        $response->assertStatus(302);

        $response = $this->followingRedirects()->get('/api/myCharacters/');
        $response->assertStatus(401);
    }

    public function testPossessOneCharacter(){
        $user = factory(User::class)->create();
        $userCharacter = UserCharacter::create(['user_id'=>$user->id, 'characterId' => 42]);
        $user->characters()->save($userCharacter);

        $this->actingAs($user)->get('api/myCharacters')->assertJson(['myCharacters'=> [42]]);
    }
}
