<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'name' => $faker->name,
        'password' => Hash::make('password'),
        'role' => $faker->randomElement(['attendee', 'organiser', 'convenor']),
    ];
});
