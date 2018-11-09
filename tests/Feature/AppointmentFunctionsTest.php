<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Appointment;
use Carbon\Carbon;

class AppointmentFunctionsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setToken('attendee');
    }

    public function test_get_available_appointments()
    {
    	$date = Appointment::whereNull('attendee_id')->where('confirmed', false)->first()->starts_at;

    	$query = http_build_query([
    		'year' => $date->year,
    		'month' => $date->month,
    	]);

        $this->get("/appointment-slots/available?$query" , $this->withToken())->assertOk();
    }

    public function test_get_all_appointments()
    {
    	$date = Appointment::inRandomOrder()->first()->starts_at;

    	$query = http_build_query([
    		'year' => $date->year,
    		'month' => $date->month,
    	]);

        $this->get("/appointment-slots/all?$query" , $this->withToken())->assertOk();
    }
}
