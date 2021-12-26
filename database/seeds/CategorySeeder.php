<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=20; $i++){
            $name = $faker->realText(20);
            try {
                \App\Category::create([
                    'name'=>$name,
                    'slug'=>str_replace(' ','-',$name),
                ]);
            }catch (Exception $e){
                echo "Error this comment {$i} ...\n";
                continue;
            }
        }
    }
}
