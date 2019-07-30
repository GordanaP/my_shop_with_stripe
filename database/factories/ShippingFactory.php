<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Shipping;
use App\RegisteredCustomer;
use Faker\Generator as Faker;

$factory->define(Shipping::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'street_address' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'city' => $faker->city,
        'country' => 'rs',
        'phone' => $faker->phoneNumber,
        'registered_customer_id' => RegisteredCustomer::inRandomOrder()->first()->id,
    ];
});
