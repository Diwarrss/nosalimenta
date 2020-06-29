<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tracing;
use Faker\Generator as Faker;

$factory->define(Tracing::class, function (Faker $faker) {
    return [
        'zone' => $faker->word,
        'producer' => $faker->text,
        'identification' => $faker->word,
        'phone' => $faker->phoneNumber,
        'municipality_id' => factory(\App\Municipality::class),
        'productionline_id' => factory(\App\Productionline::class),
        'user_id' => factory(\App\User::class),
    ];
});
