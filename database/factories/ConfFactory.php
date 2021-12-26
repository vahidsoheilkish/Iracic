<?php

use Faker\Generator as Faker;

$factory->define(App\Conference::class, function (Faker $faker) {
    $randomDir = rand(1,1000);
    $randomPoster = rand(1,13);
    if (!is_dir(public_path('upload/logo/conferences/'.$randomDir))) {
        mkdir(public_path('upload/logo/conferences/'.$randomDir) , 0744, true);
    }
    copy(public_path("poster/".$randomPoster."."."jpg") , public_path("upload/logo/conferences/".$randomDir."/".$randomPoster."."."jpg"));
    $title_en = $faker->text;
    $title_fa = $faker->text;
    $title = ['l1'=> $title_en, 'l2'=>$title_fa];
    return [
        'group_id' =>  \App\Group::all()->random()->id,
        'major_id' =>  \App\Major::all()->random()->id,
        'conference_user_id' =>  \App\ConferenceUser::all()->random()->id,
        'title' => json_encode($title),
        'slug' => str_slug($title_en),
        'description' => json_encode(['l1'=>$faker->text() , 'l2'=>$faker->text() ]),
        'conference_subjects'=> json_encode(['l1'=>$faker->text() , 'l2'=>$faker->text() ]),
        'level'=>'international',
        'sent_article'=> 1,
        'ISBN'=> $faker->numberBetween(1000,9999) ,
        'ISSN'=> $faker->numberBetween(1000,9999) ,

        'sendAbstractDate'=>  date('Y-m-d'),
        'sendArticleDate'=> date('Y-m-d'),
        'declareRefereeDate'=> date('Y-m-d'),
        'startDate'=> date('Y-m-d'),
        'endDate'=> date('Y-m-d'),

        'organizer' =>$faker->company.'-'.$faker->company ,
        'country' =>$faker->country ,
        'city' =>$faker->city ,
        'email' =>$faker->email ,
        'tell' =>$faker->phoneNumber ,
        'fax' =>$faker->phoneNumber ,

        'place'=>$faker->city,


        'conferenceSecretary' =>$faker->name ,
        'conferencePresidency' =>$faker->name ,
        'scientificSecretary' =>$faker->name ,
        'executiveSecretary' =>$faker->name ,
        'code' =>rand(1,100),
        'lang' =>'en',

        'poster' => $randomDir."/".$randomPoster."."."jpg"
    ];
});
