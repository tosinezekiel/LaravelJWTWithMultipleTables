<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Investment;
use Faker\Generator as Faker;

$factory->define(Investment::class, function (Faker $faker) {
    return [
        'title' => $faker->text(),
        'description' => $faker->sentence(),
    ];
});
