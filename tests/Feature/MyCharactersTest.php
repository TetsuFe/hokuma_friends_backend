<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MyCharactersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNotAuthenticatedUser()
    {
        $response = $this->get('/api/myCharacters/');
        $response->assertStatus(302);

        $response = $this->followingRedirects()->get('/api/myCharacters/');
        $response->assertStatus(401);
    }
}
