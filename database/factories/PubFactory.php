<?php

use Faker\Generator as Faker;

$factory->define(App\Publication::class, function (Faker $faker) {

    $title_fa = $faker->text(30);
    $title_en = $faker->text(30);
    $title = [
        't1' => $title_en ,
        't2' => $title_fa ,
    ];
    $order = rand(1,3);
    if($order == 1 ){
        $publish_order = "month";
    }elseif($order == 2){
        $publish_order = "season";
    }elseif($order==3){
        $publish_order = "half-year";
    }
    $randomDir = rand(1,1000);
    $randomPoster = rand(1,13);
    if (!is_dir(public_path('upload/logo/publications/'.$randomDir))) {
        mkdir(public_path('upload/logo/publications/'.$randomDir) , 0744, true);
    }
    copy(public_path("poster/".$randomPoster."."."jpg") , public_path("upload/logo/publications/".$randomDir."/".$randomPoster."."."jpg"));
    return [
        'group_id' =>  \App\Group::all()->random()->id,
        'major_id' =>  \App\Major::all()->random()->id,
        'publication_user_id' =>  \App\PublicationUser::all()->random()->id,
        'title' => json_encode($title),
        'slug' => str_slug($title_en),
        'printISSN' => $faker->text("14"),
        'onlineISSN' => $faker->text("14"),
        'dependency' => $faker->text(10),
        'DOI' => $faker->text("10") . $faker->numberBetween(1000, 2000),
        'first_publish_year'=>$faker->numberBetween(2000,2019) ,
        'publish_order'=>$publish_order,
        'country' => $faker->country ,
        'city' => $faker->city ,
        'img' => $randomDir."/".$randomPoster."."."jpg",
        'iracic_code' => 'no iracic code' ,
        'publication_type' => 'fulltext',
    ];

});
