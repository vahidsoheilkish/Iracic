<?php

use Illuminate\Database\Seeder;

class ConferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($loop=1 ; $loop<=100; $loop++){
            try{
                $dir = "/upload/conferences/assets/".uniqid();
                if(!is_dir(public_path($dir))){
                    mkdir(public_path($dir) ,0777,true);
                }


                $organizer_count = rand(1,6);
                $orgz =[];
                for ($i=0; $i<=$organizer_count; $i++){
                    $person_image_random = rand(1,13);
                    copy(public_path('poster/'.'poster'.$person_image_random."."."jpg") , public_path($dir."/".'person'.$person_image_random.'.'.'jpg'));
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
                $title =  $faker->text(30);
                \App\Conference::create([
                    'conference_user_id' => \App\ConferenceUser::all()->random()->id ,
                    'title' => $title,

                    'group_id' => \App\Group::all()->random()->id ,
                    'major_id' => \App\Issue::all()->random()->id ,

                    'level' =>'international',
                    'access' => 'open',
                    'type' => 'fulltext',
                    'subject'=>$subject,

                    'conference_publisher' => 'iracic',

                    'country' => \App\Countries::all()->random()->name,

                    'ISBN' => $faker->text() . $faker->numberBetween(1000,9999),
                    'printISSN' => $faker->numberBetween(1000,9999)  . $faker->text(10),
                    'onlineISSN' => $faker->numberBetween(1000,9999) . $faker->text(10)  ,

                    'DOI' => $faker->text(20) . $faker->numberBetween(2000,99999),

                    'organizer' => $organizers,

                    'active' => 1,
                    'dir' => $dir
                ]);
            } catch (Exception $exception) {
                echo $exception->getMessage() . "\n";
                continue;
            }
        }

    }
}
