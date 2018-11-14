<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Appointment;

class AppointmentSlotCollection extends ResourceCollection
{
    private $groupBy;

    public function __construct($resource, $groupBy = null)
    {
        parent::__construct($resource);
        $this->groupBy = $groupBy;
    }

    public function toArray($request)
    {
        switch ($this->groupBy) {
            case 'Month':
                return $this->singleMonth();
            
            default:
                return $this->prepData();
        }
    }

    private function prepData()
    {
        return $this->collection->map(function(Appointment $appointment){
            $start = $appointment->starts_at;
            $end = $appointment->ends_at;

            $appointment['meta'] = [
                'year' => $start->year,
                'month' => $start->month,
                'day' => $start->day,
                'start_time' => $start->format('H:i'),
                'end_time' => $end->format('H:i'),
            ];

            $appointment['attendee'] = new UserResource($appointment->attendee);

            return $appointment;
        });
    }

    private function singleMonth()
    {
        $data = $this->prepData();

        if ($data->isNotEmpty())
            return [
                'year' => $data[0]['meta']['year'],
                'month' => $data[0]['meta']['month'],
                'days' => $data->groupBy('meta.day')->values()->map(function($slots){
                    return [ 'day' => $slots[0]['meta']['day'], 'slots' => $slots ];
                })
            ];
    }
}
