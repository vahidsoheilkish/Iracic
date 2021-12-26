<?php

use Illuminate\Database\Seeder;

class MajorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=20; $i++){
            $major = [
                'fa'=>"رشته تست".$i ,
                'en'=>$faker->realText(30)
            ];
            \App\Major::create([
                'group_id' => \App\Group::all()->random()->id,
                'name' => json_encode($major)
            ]);
        }
    }
}
