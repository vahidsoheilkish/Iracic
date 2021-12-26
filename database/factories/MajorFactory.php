<?php

use Faker\Generator as Faker;

$factory->define(App\Major::class, function (Faker $faker) {
    $major = [
        'fa'=>"رشته تست".$faker->numberBetween(1,100) ,
        'en'=>$faker->realText(30)
    ];
    return [
        'group_id' => \App\Group::all()->random()->id,
        'name' => json_encode($major)
    ];
});
