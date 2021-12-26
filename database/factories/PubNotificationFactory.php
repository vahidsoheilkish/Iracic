<?php

use Faker\Generator as Faker;

$factory->define(App\PublicationNotification::class, function (Faker $faker) {
    return [
        'publication_user_id'=> \App\PublicationUser::all()->random()->id,
        'message'=>$faker->realText(200)
    ];
});
