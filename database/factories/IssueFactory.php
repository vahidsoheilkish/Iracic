<?php

use Faker\Generator as Faker;

$factory->define(App\Issue::class, function (Faker $faker) {
    $page = $faker->numberBetween(1, 50);
    $page2 = $page + 6;
    return [
        'volume_id' => \App\Volume::all()->random()->id,
        'duration' => "",
        'pages_number' => "{$page} - {$page2}"
    ];
});
