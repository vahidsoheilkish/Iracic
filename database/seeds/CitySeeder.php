<?php

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=280; $i++){
            try {
                \App\Cities::create([
                    'countries_id'=>\App\Countries::all()->random()->id ,
                    'name'=>$faker->city
                ]);
            }catch (Exception $e){
                echo "Error this city {$i} ...\n";
                continue;
            }
        }
    }
}
