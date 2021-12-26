<?php

use Faker\Generator as Faker;

$factory->define(App\PublicationUser::class, function (Faker $faker) {
    return [
        'name' => $faker->name ,
        'password' => md5("123456") ,
        'email' => $faker->email ,
        'website' => $faker->url ,
        'ISSN' => $faker->numberBetween(1000,99999) ,
    ];
});
