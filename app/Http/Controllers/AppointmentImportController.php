<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;

class AppointmentImportController extends Controller
{
    function import()
    {
    	$csv = explode(PHP_EOL, request('file'));
    	for ($i = 1; $i < count($csv); $i++)
    		$this->createAppointment(...explode(',', $csv[$i]));
    }

    function createAppointment($starts_at, $ends_at) 
    {
		Appointment::create(compact('starts_at', 'ends_at'));
    }
}
