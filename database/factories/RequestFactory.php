<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Requests;
use Faker\Generator as Faker;

$factory->define(Requests::class, function (Faker $faker) {
    return [
        'person_id' => $faker->numberBetween(1, 10),
        'description' => $faker->sentence(10, true),
    ];
});
