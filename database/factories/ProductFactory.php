<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Brand;
use App\Category;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3,false),
        'slug' => $faker->unique->slug,
        'summary' => $faker->text,
        'description' => $faker->text,
        'stock' => $faker->numberBetween(2,10),
        'brand_id' => $faker->randomElement(Brand::pluck('id')->toArray()),
        'vendor_id' => $faker->randomElement(User::pluck('id')->toArray()),
        'cat_id' => $faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
        'child_cat_id' => $faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
        'photo' => $faker->imageUrl('60','60'),
        'price' => $faker->numberBetween(100,1000),
        'offer_price' => $faker->numberBetween(100,1000),
        'discount' => $faker->numberBetween(100,1000),
        'size' => $faker->randomElement(['S','M','L']),
        'conditions' => $faker->randomElement(['new','popular','winter']),
        'status' => $faker->randomElement(['active','inactive'])
    ];
});
