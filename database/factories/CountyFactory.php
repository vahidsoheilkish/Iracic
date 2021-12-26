<?php

use Faker\Generator as Faker;

$factory->define(App\Countries::class, function (Faker $faker) {
    return [
        'name'=>$faker->city
    ];
});
