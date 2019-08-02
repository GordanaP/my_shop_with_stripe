<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence($nbWords = 10, $variableNbWords = true) ,
        'price_in_cents' => $faker->numberBetween($min = 100, $max = 5000),
    ];
});
