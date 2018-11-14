<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Http\Resources\AppointmentSlotCollection;

class MyAppointmentController extends Controller
{
    public function index()
    {
    	$appointments = Appointment::where('attendee_id', auth()->id())->get();

        return new AppointmentSlotCollection($appointments);
    }
}
