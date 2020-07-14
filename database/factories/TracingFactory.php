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
        'latitude' => $faker->text,
        'longitude' => $faker->text,
        'altitude' => $faker->text,
        'municipality_id' => factory(\App\Municipality::class),
        'production_line_id' => factory(\App\ProductionLine::class),
        'user_id' => factory(\App\User::class),
    ];
});
