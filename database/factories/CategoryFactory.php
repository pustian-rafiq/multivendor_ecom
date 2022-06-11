<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'slug' => $faker->unique()->slug,
        'summary' => $faker->sentences(3,true),
        'photo' => $faker->imageUrl('100','100'),
        'is_parent' => $faker->randomElement([true,false]),
        'status' => $faker->randomElement(['active','inactive']),
        'parent_id' => $faker->randomElement(Category::pluck('id')->toArray())
    ];
});
