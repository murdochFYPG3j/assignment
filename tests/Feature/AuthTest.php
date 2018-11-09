<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class AuthTest extends TestCase
{
    function test_login()
    {
        $user = User::first();

        $this->post('/auth/login')->assertStatus(401)->assertJson(['error' => 'Unauthorized']);

        $this->post('/auth/login', ['email' => $user->email, 'password' => 'password'])
            ->assertSuccessful()
            ->assertJsonStructure(['access_token']);
    }

    function test_logout()
    {
        $this->setToken('convenor');

        $this->post("/auth/logout", [], $this->withToken())
            ->assertJson(['message' => 'Successfully logged out']);

        $this->get("/auth/me", $this->withToken())->assertStatus(401);
    }

    function test_refresh_token()
    {
        $this->setToken('convenor');

        $res = $this->post("/auth/refresh", [], $this->withToken());

        $res->assertJsonStructure(['access_token']);

        $this->get("/auth/me", ['HTTP_AUTHORIZATION' => 'bearer ' . $res->json()['access_token']])->assertSuccessful();
    }

    function test_register()
    {
        $data = factory(User::class)->make()->toArray();
        
        $data['password'] = '';
        $this->post("/auth/register", $data)->assertStatus(422);
        
        $data['password'] = 'password';
        $this->post("/auth/register", $data)->assertSuccessful();

        // can login
        $this->post('/auth/login', ['email' => $data['email'], 'password' => $data['password']])
            ->assertSuccessful()
            ->assertJsonStructure(['access_token']);   
    }
}
