<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Municipality;
use Faker\Generator as Faker;

$factory->define(Municipality::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'province_id' => factory(\App\Province::class),
        'phase_id' => factory(\App\Phase::class),
    ];
});
