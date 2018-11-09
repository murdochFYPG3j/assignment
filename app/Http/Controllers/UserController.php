<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store()
    {
        request()->validate(User::makeValidationRules());

        return User::createUser(request()->all());
    }

    public function update(User $user)
    {
        request()->validate(User::makeValidationRules([
            'email' => Rule::unique('users')->ignore($user->email, 'email')
        ], $required = false));

        $user->fill(request()->all());
        $user->password = request('password');
        $user->save();

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();
    }
}
