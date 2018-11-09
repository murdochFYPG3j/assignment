<?php

namespace App;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel 
{
	static function _makeValidationRules($rules = [], $overrides = [], $required = true)
	{
		$rules = collect($rules);

		if ($required) 
			$rules = $rules->map(function($rule){
				return $rule .= $rule === '' ? 'required' : '|required';
			});

		return $rules->merge($overrides)->toArray();
	}
}