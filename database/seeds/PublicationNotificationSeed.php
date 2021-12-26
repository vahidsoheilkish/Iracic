<?php

use Illuminate\Database\Seeder;

class PublicationNotificationSeed extends Seeder
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
                \App\PublicationNotification::create([
                    'publication_user_id'=> \App\PublicationUser::all()->random()->id,
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
