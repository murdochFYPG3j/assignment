<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
	function setUp() 
	{
		parent::setUp();
	    $this->setToken('attendee');
	}

    public function test_view_profile()
    {
        $this->get("/auth/me", $this->withToken())
            ->assertSuccessful();
    }

    public function test_update_profile()
    {
    	$new_name = str_random();
    	$res = $this->post("/auth/me", ['first_name' => $new_name], $this->withToken());
        $res->assertSuccessful();

       $this->assertSame($new_name, $res->json()['first_name']);
    }

    public function test_update_password()
    {
    	$new_password = str_random();
    	$res = $this->post("/auth/me", ['password' => $new_password], $this->withToken());
        $res->assertSuccessful();

       $this->assertTrue(\Hash::check($new_password, auth()->user()->password));
    }
}
