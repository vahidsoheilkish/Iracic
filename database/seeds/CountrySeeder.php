<?php

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=40; $i++){
            try {
                \App\Countries::create([
                    'name'=>$faker->city
                ]);
            }catch (Exception $e){
                echo "Error this country {$i} ...\n";
                continue;
            }
        }
    }
}
