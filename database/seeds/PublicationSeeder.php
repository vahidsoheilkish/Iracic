<?php

use Illuminate\Database\Seeder;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($loop=1; $loop<=50; $loop++) {
            try {
                $dir = 'upload/publications/assets/'.uniqid();
                if (!is_dir($dir)) {
                    mkdir(public_path($dir) , 0744, true);
                }

                $title = $faker->text(30);
                $order = ['week','biweek','month','bimonth','season','biseason','triannual','annual'];
                $random_publisher_order = $order[rand(0,7)];

                $organizer_count = rand(1,6);

                $orgz =array();
                for ($i=0; $i<=$organizer_count; $i++){
                    $person_image_random = rand(1,13);
                    copy(public_path('poster/'.'poster'.$person_image_random."."."jpg") , public_path($dir.'/'.'person'.$person_image_random.'.'.'jpg') );
                    $orgz[] = ['name'=>$faker->name() , 'image'=> 'poster'.$person_image_random.'.'.'jpg'] ;
                }
                $organizers = json_encode($orgz);

                $subject_count = rand(1,10);
                $subject="";
                for($x=0; $x<=$subject_count;$x++){
                    $name = $faker->text(13);
                    if(strlen($subject) > 0){
                        $subject=$name;
                    }else{
                        $subject=$subject.",".$name;
                    }
                }

                $random_contact = rand(1,6);
                $information = array();
                for ($z = 0; $z < $random_contact; $z++) {
                    $info = array(
                        'email' => $faker->email ,
                        'address' => $faker->address,
                        'tell' => $faker->phoneNumber,
                        'fax' => $faker->phoneNumber,
                    );
                    array_push($information, $info);
                }
                $contacts = json_encode($information);

                $randomPoster = rand(1,13);
                copy(public_path("poster/"."poster".$randomPoster."."."jpg") , public_path($dir."/".'poster'.$randomPoster."."."jpg"));
                \App\Publication::create([
                    'publication_user_id' => \App\PublicationUser::all()->random()->id,

                    'title' => json_encode($title),

                    'subject' => $subject ,

                    'group_id' => \App\Group::all()->random()->id,
                    'major_id' => \App\Major::all()->random()->id,

                    'lang'=> 'en',

                    'country' => \App\Countries::all()->random()->id ,

                    'publication_publisher' => $faker->realText(30) ,

                    'ISBN' => $faker->text(10).$faker->numberBetween(1000,9999) ,
                    'printISSN' => $faker->numberBetween(1000,9999)  . $faker->text(10),
                    'onlineISSN' => $faker->numberBetween(1000,9999) . $faker->text(10)  ,

                    'website' => $faker->url()  ,

                    'DOI' => $faker->text("10") . $faker->numberBetween(1000, 2000),

                    'publisher_order'=>$random_publisher_order,
                    'first_publish_year'=>$faker->numberBetween(2000,2017) ,

                    'type'=>'fulltext' ,

                    'contancts' => $contacts,
                    'organizers' => $organizers,

                    'active' =>1,

                    'dir' => $dir,
                    'poster' => 'poster'.$randomPoster . "." . "jpg",

                    'viewCount'=>0
                ]);
            } catch (Exception $e) {
                echo $e->getMessage();
                continue;
            }
        }
    }
}
