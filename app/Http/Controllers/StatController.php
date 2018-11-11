<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;

class StatController extends Controller
{
    function index()
    {
    	return [
    		'Appointment' => [
    			'Pending' => Appointment::pending()->count()
    		]
    	];
    }
}
