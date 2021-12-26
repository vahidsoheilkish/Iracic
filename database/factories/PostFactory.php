<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $randomTagCount = rand(1,2);
    $randomImage = rand(1,20);
    $dir = \Carbon\Carbon::now()->timestamp;
    $img = '/img/fake_img/'.$randomImage.'.'.'jpg';
    if (!is_dir(public_path('upload/post/'.$i.'/'.$dir))) {
        mkdir(public_path('upload/post/'.$i.'/'.$dir) , 0744, true);
    }
    copy( (public_path($img)) , public_path('upload/post/'.$i.'/'.$dir."/postimg".$randomImage."."."jpg") );
    for($j=1 ; $j<=$randomTagCount; $j++){
        $random = array_random($randomTages);
        $randomTags[] = $random;
    }
    return [
        'title' => $faker->realText(40) ,
        'body' => $faker->realText(100) ,
        'tags' => $randomTags,
        'imgUrl' => $i."/".$dir.'/postimg'.$randomImage."."."jpg"
    ];
});
