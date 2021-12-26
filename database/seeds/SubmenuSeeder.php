<?php

use Illuminate\Database\Seeder;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i = 1 ; $i<=20 ; $i++) {

            $menu_img = $faker->numberBetween(1, 8);
            $name = json_encode([
                'fa' => $faker->realText(30),
                'en' => $faker->realText(30),
            ]);
            $submenu = \App\Submenu::create([
                "menu_id" => \App\Menu::all()->random()->id,
                'name' => $name,
                'link' => $faker->address,
            ]);
            if( !is_dir(public_path('upload/submenu/'.$submenu->id)) ){
                mkdir( public_path('/upload/submenu/'.$submenu->id) , 0777 , true );
            }
            copy( public_path('menu/'.$menu_img.'.png') , public_path('upload/submenu/'.$submenu->id.'.png') );
            $submenu->update(['img'=>$submenu->id.'.png']);
        }
    }
}
