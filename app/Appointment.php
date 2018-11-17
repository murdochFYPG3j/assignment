<?php

namespace App;
use Carbon\Carbon;

class Appointment extends Model
{
	const Statuses = ['Available', 'Pending', 'Confirmed'];

	const zuluFormat = 'Y-m-d\TH:i:s\Z';

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

	function attendee()
	{
		return $this->belongsTo(User::class);
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

    function setStartsAtAttribute($input) {
    	$isZulu = ends_with($input, 'Z');
    	$this->attributes['starts_at'] = $isZulu ?
	    	Carbon::createFromFormat(self::zuluFormat, $input)->addHours(8) :
	    	Carbon::parse($input);
    }

    function setEndsAtAttribute($input) {
    	$isZulu = ends_with($input, 'Z');
    	$this->attributes['ends_at'] = $isZulu ?
	    	Carbon::createFromFormat(self::zuluFormat, $input)->addHours(8) :
	    	Carbon::parse($input);
    }
}
