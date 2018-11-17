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

        $this->post("/create-or-update-appointments", $postData, $this->withToken())->assertOk();

        $this->assertEquals($fromCurrent - count($apmts), Appointment::whereStatus($fromStatus)->count());
        $this->assertEquals($toCount + count($apmts), Appointment::whereStatus($toStatus)->count());
    }

    public function test_batch_create_appointments()
    {
        $initialCount = Appointment::count();

        $postData = factory(Appointment::class, 3)->make()
            ->map(function($apmt){
                return [
                    'starts_at' => $apmt['starts_at']->format(Appointment::zuluFormat),
                    'ends_at' => $apmt['ends_at']->format(Appointment::zuluFormat)
                    // 'starts_at' => $apmt['starts_at']->format('Y-m-d H:i:s'),
                    // 'ends_at' => $apmt['ends_at']->format('Y-m-d H:i:s')
                ];
            })
            ->toArray();

        $this->post("/create-or-update-appointments", $postData, $this->withToken())
            ->assertOk();

        $this->assertEquals($initialCount + 3, Appointment::count());
    }
}