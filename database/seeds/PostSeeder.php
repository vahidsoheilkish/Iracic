<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        $randomTages = ['book','conference','publication','wiley','ieee','science','journal'];
        for($i=1; $i<=100; $i++){
            $randomTagCount = rand(1,2);
            $randomImage = rand(1,20);
            $dir = \Carbon\Carbon::now()->timestamp;
            $img = '/img/fake_img/'.$randomImage.'.'.'jpg';
            if (!is_dir(public_path('upload/post/'.$i.'/'.$dir))) {
                mkdir(public_path('upload/post/'.$i.'/'.$dir) , 0744, true);
            }
            copy( (public_path($img)) , public_path('upload/post/'.$i.'/'.$dir."/postimg".$randomImage."."."jpg") );
            for($j=1 ; $j<=$randomTagCount; $j++){
                $random = array_random($randomTages);
                $randomTags[] = $random;
            }
                $post = \App\Post::create([
                    'title' => $faker->realText(40) ,
                    'body' => $faker->realText(100) ,
                    'tags' => $randomTags,
                    'imgUrl' => $i."/".$dir.'/postimg'.$randomImage."."."jpg"
                ]);

                \App\CategoryPost::create([
                    'category_id'=> \App\Category::all()->random()->id,
                    'post_id'=>$post->id ,
                ]);


            $randomTags = [];

        }
    }
}
