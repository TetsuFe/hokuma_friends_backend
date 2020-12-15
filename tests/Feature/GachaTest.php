<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Character;

class GachaTest extends TestCase
{
    use RefreshDatabase;
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

        $character1 = new Character(['id'=>1, 'name'=>'赤ホクマ']);
        $character2 = new Character(['id'=>2, 'name'=>'青ホクマ']);
        $character1->save();
        $character2->save();

        $response = $this->get('api/gacha/platinum');
        $response->assertStatus(200);
        $expectedGachaResultRange = range(1,2);
        $this->assertTrue(in_array($response['characterId'], $expectedGachaResultRange, true));
    }
}
