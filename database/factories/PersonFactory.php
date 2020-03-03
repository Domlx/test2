<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Persons;
use Faker\Generator as Faker;

$factory->define(Persons::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'infix' => Str::random(3),
        'street' => $faker->streetName,
        'zip_code' => Str::random(8),
        'house_number' => $faker->numberBetween(1, 100),
        'city' => $faker->city,
        'country' => $faker->country,
    ];
});
