<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Registration;
use Faker\Generator as Faker;

$factory->define(Registration::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'data_of_birth'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'registration_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'registration_number'=>$faker->numerify(),
        'password'=>$faker->regexify('[A-Za-z0-9]{20}'),
    ];
});
