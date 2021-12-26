<?php

use Illuminate\Database\Seeder;

class ConferenceVolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($loop=1 ; $loop<=100; $loop++) {
            try {
                $random_conference_dir = \App\Conference::all()->random();
                $dir =$random_conference_dir->dir."/".uniqid();


                if (!is_dir( public_path($dir) )) {
                    mkdir( public_path($dir) , 0744, true);
                }


                $organizer_count = rand(1,6);

                $orgz = array();
                for ($i=0; $i<=$organizer_count; $i++){
                    $person_image_random = rand(1,13);
                    copy(public_path('poster/'.'poster'.$person_image_random."."."jpg") , public_path($dir.'/'.'person'.$person_image_random.'.'.'jpg' ) );
                    $orgz[] = ['name'=>$faker->name() , 'image'=> 'person'.$person_image_random.'.'.'jpg'] ;
                }
                $organizers = json_encode($orgz);

                $random_contact = rand(1,6);
                $information = array();
                for ($i = 0; $i <= $random_contact; $i++) {
                    $info = array(
                        'email' => $faker->email ,
                        'address' => $faker->address,
                        'tell' => $faker->phoneNumber,
                        'fax' => $faker->phoneNumber,
                    );
                    array_push($information, $info);
                }
                $contacts = json_encode($information);

                $randomPoster = rand(1, 13);
                copy(public_path("poster/" . 'poster'.$randomPoster . "." . "jpg"), public_path($dir . "/" ."poster".$randomPoster . "." . "jpg") );
                \App\ConferenceVolume::create([
                    'conference_id' => $random_conference_dir->id,

                    'city' => \App\Cities::all()->random()->id,
                    'place' => $faker->city,

                    'website' => $faker->url(),

                    'contancts' => $contacts,
                    'organizers' => $organizers,

                    'description' => $faker->text(),

                    'start_date' => \Carbon\Carbon::now(),
                    'end_date' => \Carbon\Carbon::now(),

                    'sendAbstractDate' => \Carbon\Carbon::now(),
                    'sendArticleDate' => \Carbon\Carbon::now(),
                    'declareRefereeDate' => \Carbon\Carbon::now(),
                    'deadTime' => \Carbon\Carbon::now(),

                    'dir' => $dir ,
                    'poster' => 'poster'.$randomPoster . "." . "jpg",
                ]);
            } catch (Exception $e) {
                echo $e->getMessage(). "\n";
                continue;
            }
        }
    }
}
