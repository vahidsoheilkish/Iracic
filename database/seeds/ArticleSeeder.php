<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param $group
     * @param $major
     * @param $conferenceUser
     * @param $volume
     * @param $issue
     * @return string
     */
    private function getDirName($group,$major,$conferenceUser,$volume,$issue){
        $time = \Carbon\Carbon::now()->getTimestamp();
        $random = rand(0,1);
        if($random === 0){
            $timestamp = $time;
        }else{
            $timestamp = $this->reverseNumber($time);
        }
        $dir = $group."/".$major."/".$conferenceUser."/".$volume."/".$issue."/".$timestamp;
        return $dir;
    }

    private function reverseNumber($num){
        $revnum = 0;
        while ($num > 1)
        {
            $rem = $num % 10;
            $revnum = ($revnum * 10) + $rem;
            $num = ($num / 10);
        }
        return $revnum;
    }

    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=100; $i++){
            $group_id = $faker->numberBetween(1,10);
            $major_id = $faker->numberBetween(1,20);
            $publication_id = $faker->numberBetween(1,299);
            $volume_id = $faker->numberBetween(1,299);
            $issue_id = $faker->numberBetween(1,300);
            $dir = $this->getDirName($group_id,$major_id,$publication_id,$volume_id,$issue_id);
            $pre_IOI = explode('/', $dir);
            $IOI = implode('-',$pre_IOI);
            $author = array();
            for($a=0; $a< $faker->numberBetween(3,20)  ; $a++){
                $author_info = array(
                    'name' => $faker->name("male") ,
                    'family' => $faker->lastName() ,
                    'email' => $faker->email() ,
                    'education' => $faker->realText(40),
                    'rate' => $faker->realText(40),
                    'group' => $faker->realText(40),
                    'college' => $faker->realText(40),
                    'university' => $faker->realText(40),
                    'city' => $faker->city() ,
                    'country' => $faker->country() ,
                    'manager' => rand(0,1),
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
            try{
                \App\Article::create([
                    'issue_id' => \App\Issue::all()->random()->id ,
                    'lang' => 'en',
                    'title' => $faker->text(40),
                    'type'=>'fulltext' ,

                    'abstract' => $faker->text(200),
                    'authors_info' => $author ,

                    'keywords' => $faker->text(10) . ',' . $faker->text(10) . ',' . $faker->text(10) ,
                    'highlight' => $faker->text(10) . ',' . $faker->text(10) . ',' . $faker->text(10) ,
                    'pageCount' => $faker->numberBetween(4,16) ,
                    'page_from' => $faker->numberBetween(1,15),
                    'page_to'=>$faker->numberBetween(16,35),

                    'DOI' => $faker->text(10),
                    'IOI' => $IOI,
                    'struct' => $struct ,
                    'resource' => $resouce,

                    'accepted' => \Carbon\Carbon::now(),
                    'receieved' => \Carbon\Carbon::now(),
                    'publish_year' => $faker->numberBetween(2000,2019),

                    'press' => 0,
                    'price' => 0,

                    'dir' => $dir,

                    'viewCount'=>0
                ]);
            }catch (Exception $e){
                echo "Error publication article in {$i} ...\n";
                continue;
            }
        }
    }
}
