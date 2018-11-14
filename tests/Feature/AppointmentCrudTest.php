<?php

namespace Tests\Feature;

use Tests\CrudTest;
use App\Appointment;

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

    public function test_batch_update_appointments()
    {
        $fromStatus = Appointment::Statuses[0];
        $toStatus = Appointment::Statuses[1];
        $toCount = Appointment::whereStatus($toStatus)->count();

        $query = Appointment::whereStatus($fromStatus);
        $fromCurrent = $query->count();
        $apmts = $query->limit(3)->get();

        $postData = $apmts->map->only('id', 'status')->map(
            function($a) use ($toStatus) { $a['status'] = $toStatus; return $a; }
        )->toArray();

        $this->post("/update-appointments", $postData, $this->withToken())->assertOk();

        $this->assertEquals($fromCurrent - count($apmts), Appointment::whereStatus($fromStatus)->count());
        $this->assertEquals($toCount + count($apmts), Appointment::whereStatus($toStatus)->count());
    }
}