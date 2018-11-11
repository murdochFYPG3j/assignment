<?php

namespace App;

class Appointment extends Model
{
	const Statuses = ['Available', 'Pending', 'Confirmed'];
	
	protected $fillable = [
		'location_id',
		'starts_at',
		'ends_at',
		'status',
	];

	protected $hidden = ['created_at', 'updated_at'];

	protected $dates = ['starts_at', 'ends_at'];

	static function makeValidationRules($overrides = [], $required = true)
	{
		return parent::_makeValidationRules([
			'attendee_id' => 'nullable|exists:users,id',
			'starts_at' => 'date',
			'ends_at' => 'date',
			'status' => 'string',
		], $overrides, $required);
	}

	function scopeAvailable($query)
	{
		return $query->where('status', self::Statuses[0]);
	}

	function scopePending($query)
	{
		return $query->where('status', self::Statuses[1]);
	}

	function scopeConfirmed($query)
	{
		return $query->where('status', self::Statuses[2]);
	}
}
