<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
                \App\Comment::create([
                    'user_id' => \App\User::all()->random()->id ,
                    'post_id' => \App\Post::all()->random()->id,
                    'comment' => $faker->realText(150),
                ]);
            }catch (Exception $e){
                echo "Error this comment {$i} ...\n";
                continue;
            }
        }
    }
}
