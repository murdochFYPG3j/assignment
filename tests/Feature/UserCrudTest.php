<?php

namespace Tests\Feature;

use Tests\CrudTest;

class UserCrudTest extends CrudTest
{
    public function setUp()
    {
        parent::setUp();
        $this->setToken('convenor');
        $this->user = $this->model::inRandomOrder()->first();
    }

	function modelClass() { return \App\User::class; }
    function apiPath() { return '/users/'; }
    function keyValue() { return ['last_name', str_random()]; }

	function test_create()
	{
		$data = factory($this->model)->make([$this->cKey => $this->cVal])->makeVisible('password')->toArray();

		$res = $this->post($this->path, $data, $this->withToken());
		$res->assertSuccessful();

        $this->assertEquals($this->cVal, $res->json()[$this->cKey]);
	}
}