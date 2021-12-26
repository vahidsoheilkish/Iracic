<?php

use Faker\Generator as Faker;

$factory->define(App\Group::class, function (Faker $faker ) {
    $group = [
        'fa'=>"گروه تست".$faker->numberBetween(1,100) ,
        'en'=>$faker->realText(30)
    ];
    return [
        'name' => json_encode($group)
    ];
});
