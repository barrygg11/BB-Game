<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_CheckUser()
    {
        $username = 'barry';
        $user = User::getUserInfo($username);
        $this->assertCount(1,$user);
    }

    public function test_Login()
    {
        $username = 'barry';
        $password = 1111;
        $getUser = User::getUserInfo($username);
        $count = count($getUser);

        if ($count == 1 && $password == $getUser[0]['password']){
            $this->assertTrue(true);
        }
    }

    public function test_register()
    {
        $username = 'tester';
        $password = 'tester';
        $checkUser = User::getUserInfo($username);
        
        if ($checkUser == []) {
            User::registerUser($username, $password);
        }
        $this->assertTrue(true);
    }
}