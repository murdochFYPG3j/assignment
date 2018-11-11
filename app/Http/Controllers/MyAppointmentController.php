<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;

class MyAppointmentController extends Controller
{
    public function index()
    {
        return Appointment::where('attendee_id', auth()->id())->get();
    }
}
