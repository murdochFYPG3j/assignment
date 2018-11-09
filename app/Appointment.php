<?php

namespace App;

class Appointment extends Model
{
	protected $fillable = [
		'location_id',
		'starts_at',
		'ends_at',
		'confirmed',
	];

	protected $hidden = ['created_at', 'updated_at'];

	protected $dates = ['starts_at', 'ends_at'];

	protected $casts = [
		'confirmed' => 'boolean'
	];

	static function makeValidationRules($overrides = [], $required = true)
	{
		return parent::_makeValidationRules([
			'attendee_id' => 'nullable|exists:users,id',
			'starts_at' => 'date',
			'ends_at' => 'date',
			'confirmed' => 'boolean',
		], $overrides, $required);
	}
}
