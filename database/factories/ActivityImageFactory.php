<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ActivityImage;
use Faker\Generator as Faker;

$factory->define(ActivityImage::class, function (Faker $faker) {
    return [
        'image_path' => $faker->word,
        'image_caption' => $faker->word,
        'activity_id' => factory(\App\Activity::class),
    ];
});
