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

    public function batchCreateOrUpdate()
    {
        $data = request()->validate([
            '*.id' => 'nullable|numeric|exists:appointments,id',
            '*.starts_at' => 'date',
            '*.ends_at' => 'date',
            '*.status' => 'string'
        ]);

        collect($data)->each(function($apmt){
            $apmt = Appointment::updateOrCreate(
                ['id' => $apmt['id'] ?? null],
                collect($apmt)->except('id')->toArray()
            );
        });
    }
}
