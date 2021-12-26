<?php

use Faker\Generator as Faker;

$factory->define(App\City::class, function (Faker $faker) {
    return [
        'countries_id'=>\App\Countries::all()->random()->id ,
        'name'=>$faker->city
    ];
});
