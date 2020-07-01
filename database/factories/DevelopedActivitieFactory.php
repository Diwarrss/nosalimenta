<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DevelopedActivitie;
use Faker\Generator as Faker;

$factory->define(DevelopedActivitie::class, function (Faker $faker) {
    return [
        'date_performed' => $faker->date(),
        'employees' => $faker->numberBetween(-10000, 10000),
        'product' => $faker->word,
        'quantity' => $faker->randomFloat(0, 0, 9999999999.),
        'measure_type' => $faker->word,
        'description' => $faker->text,
        'images' => $faker->text,
        'tracing_id' => factory(\App\Tracing::class),
        'activity_id' => factory(\App\Activity::class),
    ];
});
