<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phytosanitary_limitation_status' => $faker->boolean,
        'product_status' => $faker->boolean,
        'dose_status' => $faker->boolean,
        'quantity_status' => $faker->boolean,
    ];
});
