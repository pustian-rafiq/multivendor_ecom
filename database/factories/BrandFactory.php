<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'slug' => $faker->unique->slug,
        'photo' => $faker->imageUrl('60','60'),
        'status' => $faker->randomElement(['active','inactive'])
    ];
});
