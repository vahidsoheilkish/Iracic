<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'user_id' =>  \App\User::all()->random()->id ,
        'post_id' =>  \App\Post::all()->random()->id,
        'comment' => $faker->realText(300),
    ];
});
