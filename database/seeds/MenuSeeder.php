<?php

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i = 1 ; $i<=5 ; $i++){
            $menu_img = $faker->numberBetween(1,8);
            $name = json_encode([
                'fa'=> $faker->realText(30),
                'en'=> $faker->realText(30) ,
            ]);
            $menu = \App\Menu::create([
                'name'=>$name ,
                'link'=>$faker->address ,
            ]);
            if( !is_dir(public_path('upload/menu/'.$menu->id)) ){
                mkdir( public_path('/upload/menu/'.$menu->id) , 0777 , true );
            }
            copy( public_path('menu/'.$menu_img.'.png') , public_path('upload/menu/'.$menu->id.'.png') );
            $menu->update(['img'=>$menu->id.'.png']);
        }
    }
}
