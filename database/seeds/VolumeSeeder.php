<?php

use Illuminate\Database\Seeder;

class VolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
            for($i=1; $i<=50; $i++){
                try {
                    \App\Volume::create([
                        'publication_id'=> \App\Publication::all()->random()->id,
                        'year'=>$faker->numberBetween(1900 , 2019)
                    ]);
                }catch (Exception $e) {
                    echo "Error publication volume in {$i}...\n";
                    continue;
                }
            }
    }
}
