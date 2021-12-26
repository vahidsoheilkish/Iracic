<?php

use Faker\Generator as Faker;

$factory->define(App\Setting::class, function (Faker $faker) {
    $en_month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
    $fa_month = ['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'];

    $en_season = ['winter','spring','summer','autumn'];
    $fa_season = ['بهار','تابستان','پاییز','زمستان'];


    $en_half_year = ['winter spring','summer autumn'];
    $fa_half_year = ['بهار تابستان','پاییز زمستان'];
    return [
        'key'=>'en_month',
        'value'=>json_encode($en_month),

        'key'=>'fa_month',
        'value'=>json_encode($fa_month),

        'key'=>'en_season',
        'value'=>json_encode($en_season),

        'key'=>'fa_season',
        'value'=>json_encode($fa_season),

        'key'=>'en_half_year',
        'value'=>json_encode($en_half_year),

        'key'=>'fa_half_year',
        'value'=>json_encode($fa_half_year),
    ];
});
