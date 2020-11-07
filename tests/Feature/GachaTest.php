<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class GachaTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNotAuthenticated()
    {
        $response = $this->get('/api/gacha/platinum');
        $response->assertStatus(302);

        $response = $this->followingRedirects()->get('/api/gacha/platinum');
        $response->assertStatus(401);
    }

    public function testGachaResult(){
        $user = factory(User::class)->create();
        $this->be($user);

        $response = $this->get('api/gacha/platinum');
        $response->assertStatus(200);
        $expectedGachaResultRange = range(1,5);
        $this->assertTrue(in_array($response['characterId'], $expectedGachaResultRange, true));
    }
}
