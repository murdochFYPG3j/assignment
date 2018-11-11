<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Appointment;

class AppointmentAdminTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->setToken('convenor');
    }

    function test_get_stat() 
    {
    	$this->get('/stats', $this->withToken())->assertJsonStructure([
    		'Appointment' => [ 'Pending' ]
    	]);
    }

    function test_import_appointments()
    {
        $apmt_count = Appointment::count();

    	$this->post('import-appointments', [
            'file' => file_get_contents(public_path('files/template.csv'))
        ], $this->withToken())->assertOk();

        $this->assertTrue(Appointment::count() > $apmt_count);
    }
}
