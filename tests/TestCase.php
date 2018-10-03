<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;
    private $token;

    function setUp()
    {
        parent::setUp();

        $this->artisan("db:seed");

        $this->mysql = config('database.default') === 'mysql';
    }

    function setToken($role) 
    {
    	$this->user = User::whereRole($role)->first();

    	$this->token = $this->post('/auth/login', ['email' => $this->user->email, 'password' => 'password'])->json()['access_token'];
    }
    
    function withToken($data = [])
    {
        $data['HTTP_AUTHORIZATION'] = 'bearer ' . $this->token;

        return $data;
    }
}
