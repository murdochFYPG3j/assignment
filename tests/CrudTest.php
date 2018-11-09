<?php

namespace Tests;

abstract class CrudTest extends TestCase 
{
	function setUp()
	{
		parent::setUp();

		$this->model = $this->modelClass();
		$this->path = $this->apiPath();
		list($this->cKey, $this->cVal) = $this->keyValue();
	}

	abstract function modelClass();
	abstract function apiPath();
	abstract function keyValue();

	function test_index()
	{
		$res = $this->get($this->path, $this->withToken());
		$res->assertSuccessful();
		$res->assertJsonCount($this->model::count());
	}

	function test_create()
	{
		$data = factory($this->model)->make([$this->cKey => $this->cVal])->toArray();

		$res = $this->post($this->path, $data, $this->withToken());
		$res->assertSuccessful();

        $this->assertEquals($this->cVal, $res->json()[$this->cKey]);
	}

	function test_update()
	{
		$model = $this->model::inRandomOrder()->first();

		$res = $this->put($this->path.$model->getKey(), [$this->cKey => $this->cVal], $this->withToken());
		$res->assertSuccessful();

        $this->assertEquals($this->cVal, $res->json()[$this->cKey]);
	}

	function test_delete()
	{
		$model = $this->model::inRandomOrder()->first();

		$res = $this->delete($this->path.$model->getKey(), [], $this->withToken());
		$res->assertSuccessful();

		$this->assertFalse($this->model::whereKey($model->getKey())->exists());	
	}
}