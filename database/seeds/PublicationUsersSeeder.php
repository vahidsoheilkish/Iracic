<?php

use Illuminate\Database\Seeder;

class PublicationUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=50; $i++){
            try {
                \App\PublicationUser::create([
                    'name' => $faker->name ,
                    'password' => md5("123456") ,
                    'email' => $faker->email ,
                    'website' => $faker->url ,
                    'ISSN' => $faker->numberBetween(1000,99999) ,
                ]);
            }catch (Exception $e){
                echo $e->getMessage();
                echo "Error publication user in {$i} ...\n";
                continue;
            }
        }
    }
}
