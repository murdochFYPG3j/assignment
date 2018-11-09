<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function store()
    {
        request()->validate(Location::makeValidationRules());

        return Location::create(request()->all());
    }

    public function update(Location $location)
    {
        request()->validate(Location::makeValidationRules([], $required = false));
        
        $location->update(request()->all());

        return $location;
    }

    public function destroy(Location $location)
    {
        $location->delete();
    }
}
