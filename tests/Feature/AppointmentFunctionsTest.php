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
    	$date = Appointment::whereNull('attendee_id')->where('status', Appointment::Statuses[0])->first()->starts_at;

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

    public function test_book_appointment()
    {
        $apmt = Appointment::available()->first(); // Find an available appointment.

        $this->post("/appointment-slot/{$apmt->id}/book", [], $this->withToken())->assertOk();

        $this->assertEquals(Appointment::Statuses[1], $apmt->fresh()->status);
    }

    public function test_cancel_appointment()
    {
        $apmt = Appointment::pending()->first(); // Find an unavilable appointment.

        $this->post("/appointment-slot/{$apmt->id}/cancel", [], $this->withToken())->assertOk();

        $this->assertEquals(Appointment::Statuses[0], $apmt->fresh()->status);
    }

    public function test_get_all_my_appointments()
    {
        $this->get('my-appointments', $this->withToken())->assertOk();
    }
}
