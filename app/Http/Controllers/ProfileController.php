<?php

namespace App\Http\Controllers;

use Hash;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware("auth:api");
    }

    function index() 
    { 
        return auth()->user(); 
    }

    function store()
    {
        $user = auth()->user();
        $user->fill(request()->except('password'));
        $user->password = request('password');
        $user->save();

        return auth()->user();
    }
}
