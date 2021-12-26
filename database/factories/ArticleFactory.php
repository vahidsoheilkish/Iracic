<?php

use Faker\Generator as Faker;


$factory->define(App\Article::class, function (Faker $faker) {



    $group_id = $faker->numberBetween(1,10);
    $major_id = $faker->numberBetween(1,20);
    $publication_id = $faker->numberBetween(1,299);
    $volume_id = $faker->numberBetween(1,299);
    $issue_id = $faker->numberBetween(1,300);

    $time = \Carbon\Carbon::now()->getTimestamp();
    $random = rand(0,1);
    if($random === 0){
        $timestamp = $time;
    }else{
        $revnum = 0;
        while ($num > 1)
        {
            $rem = $num % 10;
            $revnum = ($revnum * 10) + $rem;
            $num = ($num / 10);
        }
        $timestamp = $revnum;
    }
    $dir = $group_id."/".$major_id."/".$publication_id."/".$volume_id."/".$issue_id."/".$timestamp;
    $pre_IOI = explode('/', $dir);
    $IOI = implode('-',$pre_IOI);
    $author = array();
    for($a=0; $a< $faker->numberBetween(3,20)  ; $a++){
        $author_info = array(
            'name' => $faker->name() ,
            'email' => $faker->email() ,
            'rate' =>   $faker->realText(15),
            'dependency' => $faker->city ,
        );
        array_push($author ,$author_info);
    }
    $author =  json_encode($author);
    $randomPdfArticle = rand(1,13);
    if (!is_dir(public_path('upload/publications/articles/'.$dir))) {
        mkdir(public_path('upload/publications/articles/'.$dir) , 0744, true);
    }
    copy(public_path("article/".$randomPdfArticle."."."pdf") , public_path("upload/publications/articles/".$dir."/".$randomPdfArticle."."."pdf"));
    $struct = array();
    for($b=0; $b < rand(5,10) ; $b++){

        $randRepeat = rand(1,4);
        for($c=1; $c<=$randRepeat ;$c++){
            $randomSub[] = $faker->realText(40);
        }
        $struct_info = array(
            'str'       => $faker->realText(40) ,
            'substr'        => $randomSub ,
        );
        $randomSub = null;
        array_push($struct ,$struct_info);
    }
    $struct =  json_encode($struct);
    $resouce = array();
    for($d=0; $d< $faker->numberBetween(1,40)  ; $d++){
        $resouce[] = $faker->realText(150);
    }
    $resouce =  json_encode($resouce);
    return [
        'issue_id' =>  \App\Issue::all()->random()->id,
        'title' => $faker->text(40),
        'abstract' => $faker->text(200),
        'authors_info' => $author ,
        'highlight' => $faker->text(10) . ',' . $faker->text(10) . ',' . $faker->text(10) ,
        'keywords' => $faker->text(10) . ',' . $faker->text(10) . ',' . $faker->text(10) ,
        'struct' => $struct ,
        'pageCount' => $faker->numberBetween(4,16) ,
        'page' => $faker->numberBetween(1,200) ,
        'resource' => $resouce,
        'DOI' => $faker->text(10),
        'IOI' => $IOI,
        'files_directory' => $dir,
        'price' => '0',
        'accepted' => \Carbon\Carbon::now(),
        'receieved' => \Carbon\Carbon::now(),
        'press' => '0'
    ];
});
