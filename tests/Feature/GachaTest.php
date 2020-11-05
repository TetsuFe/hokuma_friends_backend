<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
}
