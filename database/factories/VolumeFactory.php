<?php

use Faker\Generator as Faker;

$factory->define(App\Volume::class, function (Faker $faker) {
    return [
        'publication_id'=> \App\Publication::all()->random()->id,
        'year'=>$faker->numberBetween(2000 , 2019)
    ];
});
