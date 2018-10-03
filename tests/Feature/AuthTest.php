<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;

class AuthTest extends TestCase
{
    function test_login()
    {
        $user = User::first();

        $this->post('/auth/login')->assertJson(['error' => 'Unauthorized']);

        $this->post('/auth/login', ['email' => $user->email, 'password' => 'password'])
            ->assertJsonStructure(['access_token']);
    }

    // function test_auth_me()
    // {
    //     $this->setTokenAsAdmin();

    //     $this->get("/auth/me", $this->withToken())
    //         ->assertJsonCount(10, 'data')
    //         ->assertJsonStructure([
    //             'data' => [
    //                 'id', 'email', 'first_name', 'last_name', 'phone_country_code',
    //                 'phone_number', 'company_id', 'role_id',
    //                 'company' => ['id', 'name'],
    //                 'role' => ['id', 'description']
    //             ]
    //         ]);
    // }

    // function test_logout()
    // {
    //     $this->setTokenAsAdmin();

    //     $this->post("/auth/logout", [], $this->withToken())
    //         ->assertJson(['message' => 'Successfully logged out']);

    //     $this->get("/auth/me", $this->withToken())->assertJson(['message' => 'The token has been blacklisted']);
    // }

    // function test_refresh_token()
    // {
    //     $this->setTokenAsAdmin();

    //     $res = $this->post("/auth/refresh", [], $this->withToken());

    //     $res->assertJsonStructure(['access_token']);

    //     $this->get("/auth/me", ['HTTP_AUTHORIZATION' => 'bearer ' . $res->json()['access_token']])->assertSuccessful();
    // }
}
