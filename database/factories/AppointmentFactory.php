<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Appointment::class, function (Faker $faker) {
    return [
		'attendee_id' => App\User::inRandomOrder()->first()->id,
		// 'location_id' => App\Location::inRandomOrder()->first()->id,
		'starts_at' => $datetime = Carbon::instance($faker->dateTimeThisYear()),
		'ends_at' => (clone $datetime)->addMinutes(30),
		'status' => $faker->randomElement(\App\Appointment::Statuses),
    ];
});
