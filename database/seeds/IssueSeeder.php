<?php

use Illuminate\Database\Seeder;

class IssueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1; $i<=50; $i++) {
            try {
                $page = $faker->numberBetween(1, 50);
                $page2 = $page + 6;
                    \App\Issue::create([
                        'volume_id' => \App\Volume::all()->random()->id,
                        'duration' => "--",
                        'pages_number' => "{$page} - {$page2}"
                    ]);
            }catch (Exception $e){
                echo "Error publication Issue in {$i} ...\n";
                continue;
            }
        }
    }
}
