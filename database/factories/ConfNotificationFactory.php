<?php

use Faker\Generator as Faker;

$factory->define(App\ConferenceNotification::class, function (Faker $faker) {
    return [
        'conference_user_id'=> \App\ConferenceUser::all()->random()->id,
        'message'=>$faker->realText(200)
    ];
});
