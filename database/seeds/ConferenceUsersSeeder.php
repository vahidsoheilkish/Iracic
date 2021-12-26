<?php

use Illuminate\Database\Seeder;

class ConferenceUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=300; $i++){
            try {
                \App\ConferenceUser::create([
                    'name' => $faker->name ,
                    'lastname' => $faker->lastName ,
                    'password' => bcrypt("123456") ,
                    'email' => $faker->email ,
                    'codemeli' => $faker->phoneNumber ,
                    'tell' => $faker->phoneNumber ,
                    'real_password' => "123456" ,
                ]);
            }catch (Exception $e){
                echo "Error conference user in {$i} ...\n";
                continue;
            }
        }
    }
}
