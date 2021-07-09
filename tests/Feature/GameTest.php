<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Game;

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

    public function test_SearchOrders()
    {
        $this->get('/gameOrdersControl')->assertSuccessful();
    }

    public function test_GameNumControl()
    {
        $this->get('/gameNumControl')->assertSuccessful();
    }

    public function test_UserSearchControl()
    {
        $this->get('/userSearchControl')->assertSuccessful();
    }

    public function test_SearchGameNum()
    {
        $game_type = '';
        $create_time = '';
        $game_num = '';
        Game::gameNumControl($game_type, $create_time, $game_num);
        $this->assertTrue(true);
    }
}
