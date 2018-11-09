<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::all();
    }

    public function store()
    {
        request()->validate(Appointment::makeValidationRules());

        return Appointment::create(request()->all());
    }

    public function update(Appointment $appointment)
    {
       request()->validate(Appointment::makeValidationRules([], $required = false));
        
        $appointment->update(request()->all());

        return $appointment;
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
    }
}
