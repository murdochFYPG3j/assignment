<?php

namespace Tests\Feature;

use Tests\CrudTest;

class AppointmentCrudTest extends CrudTest
{
    public function setUp()
    {
        parent::setUp();
        $this->setToken('convenor');
        $this->user = $this->model::inRandomOrder()->first();
    }

	function modelClass() { return \App\Appointment::class; }
    function apiPath() { return '/appointments/'; }
    function keyValue() { return ['starts_at', now()]; }
}