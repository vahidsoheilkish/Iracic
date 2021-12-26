<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1; $i<=10; $i++){
            try {
                \App\User::create([
                    'name' => $faker->name,
                    'family' => $faker->lastName,
                    'email' => $faker->email,
                    'melicode' => $faker->numberBetween(1000000000,2147483646),
                    'password' => Hash::make('123456'),
                    'address'=>'...'
                ]);
            }catch (Exception $e) {
                echo "Error this user in {$i} ...\n";
                continue;
            }
        }

    }
}
