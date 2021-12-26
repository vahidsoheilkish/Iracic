<?php

use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=10; $i++){
            $group = [
                'fa'=>"گروه تست".$i ,
                'en'=>$faker->realText(30)
            ];
            \App\Group::create([
                'name' => json_encode($group)
            ]);
        }
    }
}
