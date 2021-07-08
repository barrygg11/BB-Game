<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_PlayGameIndex()
    {
        $response = $this->get('/bingo');

        $response->assertStatus(200)->assertSee('台灣賓果賓果');
    }
}
