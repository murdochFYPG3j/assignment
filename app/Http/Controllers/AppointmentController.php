<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\Http\Resources\AppointmentSlotCollection;

class AppointmentController extends Controller
{
    public function index()
    {
        return new AppointmentSlotCollection(Appointment::all());
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

    public function batchCreate()
    {
        $data = request()->validate([
            '*.starts_at' => 'required|date',
            '*.ends_at' => 'required|date'
        ]);

        collect($data)->each(function($apmt){
            Appointment::create($apmt);
        });
    }

    public function batchUpdate()
    {
        request()->validate([
            '*.id' => 'required|numeric|exists:appointments,id'
        ]);

        collect(request()->all())->each(function($data){
            Appointment::whereKey($data['id'])->update($data);
        });
    }
}
