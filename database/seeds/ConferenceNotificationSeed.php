<?php

use Illuminate\Database\Seeder;

class ConferenceNotificationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1; $i<=300; $i++){
            try {
                \App\ConferenceNotification::create([
                    'conference_user_id'=> \App\ConferenceUser::all()->random()->id,
                    'message'=>$faker->realText(200),
                    'seen' => 0
                ]);
            }catch (Exception $e) {
                echo "Error this publication notification in {$i} ...\n";
                continue;
            }
        }
    }
}
