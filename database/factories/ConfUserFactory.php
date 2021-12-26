<?php

use Faker\Generator as Faker;

$factory->define(App\ConferenceUser::class, function (Faker $faker) {
    return [
        'name' => $faker->name ,
        'lastname' => $faker->lastName ,
        'password' => bcrypt("123456") ,
        'email' => $faker->email ,
        'codemeli' => $faker->phoneNumber ,
        'tell' => $faker->phoneNumber ,
        'real_password' => "123456" ,
    ];
});
