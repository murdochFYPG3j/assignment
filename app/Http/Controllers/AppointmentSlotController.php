<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Http\Resources\AppointmentSlotCollection;

const ALL = 'All';
const AVAIL = 'Available';

class AppointmentSlotController extends Controller
{
    function getAvailable() {
		return new AppointmentSlotCollection($this->get(AVAIL), 'Month');
    }

    function getAll() {
		return new AppointmentSlotCollection($this->get(ALL), 'Month');
    }

    function get($type) {
    	request()->validate([
    		'year' => 'required|numeric',
    		'month' => 'required|numeric',
    	]);

    	$Appointments = Appointment::whereYear('starts_at', request('year'))
						->whereMonth('starts_at', request('month'));

		if ($type === AVAIL)
			$Appointments->whereNull('attendee_id')->where('confirmed', false);

		return $Appointments->get();
    }
}
