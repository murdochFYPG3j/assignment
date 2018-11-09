<?php

namespace App;

class User extends JwtUser 
{
	protected $fillable = [
		'email',
		'first_name',
		'last_name',
		'role',
	];

	protected $hidden = [ 'password' ];

	static function createUser($data) 
	{
        $user = new self();
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->first_name = $data['first_name'];
        $user->last_name = $data['last_name'];
        $user->role = $data['role'];
        $user->save();
        return $user;
	}

	static function makeValidationRules($overrides = [], $required = true)
	{
		return parent::_makeValidationRules([
			'email' => 'email|unique:users,email',
            'password' => 'min:6',
            'role' => 'in:attendee,organiser,convenor',
            'first_name' => '',
			'last_name' => '',
		], $overrides, $required);
	}

	function setPasswordAttribute($password) 
	{
		if ($password) 
			$this->attributes['password'] = \Hash::make($password);
	}
}
