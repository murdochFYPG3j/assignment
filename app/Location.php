<?php

namespace App;

class Location extends Model
{
	protected $fillable = [
		'name',
		'address',
		'postal',
	];

	protected $hidden = ['created_at', 'updated_at'];

	static function makeValidationRules($overrides = [], $required = true)
	{
		return parent::_makeValidationRules([
			'name' => 'string',
            'address' => 'string',
            'postal' => 'numeric|digits_between:1,10',
		], $overrides, $required);
	}
}
