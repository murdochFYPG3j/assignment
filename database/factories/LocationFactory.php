<?php

use Faker\Generator as Faker;

$factory->define(App\Location::class, function (Faker $faker) {
    return [
		'name' => $faker->streetName(),
		'address' => $faker->address(),
		'postal' => $faker->numerify('######')
    ];
});
