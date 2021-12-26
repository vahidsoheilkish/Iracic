<?php

use Illuminate\Database\Seeder;

class ConferenceNoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        for($i=1 ; $i<=400; $i++) {
            try {
                $title = $faker->realText(40);
                \App\ConferenceNotice::create([
                    'group_id' => \App\Group::all()->random()->id,
                    'major_id' => \App\Major::all()->random()->id,
                    'conference_user_id' => \App\ConferenceUser::all()->random()->id,
                    'title' => $title,
                    'slug' => str_replace(' ', '-', $title),
                    'conference_subjects' => $faker->realText(10) . $faker->realText(10) . $faker->realText(10),
                    'description' => $faker->realText(100),
                    'level' => 'international',
                    'sent_article' => 1,
                    'startDate' => $faker->date("Y-m-d H:i"),
                    'endDate' => $faker->date("Y-m-d H:i"),
                    'sendAbstractDate' => $faker->date("Y-m-d"),
                    'sendArticleDate' => $faker->date("Y-m-d"),
                    'declareRefereeDate' => $faker->date("Y-m-d"),
                    'organizer' => $faker->name . '-' . $faker->lastName,
                    'country' => $faker->country,
                    'city' => $faker->city,
                    'siteAddress' => $faker->url,
                    'postAddress' => $faker->address,
                    'tell' => $faker->phoneNumber,
                    'conferenceSecretary' => $faker->lastName,
                    'conferencePresidency' => $faker->lastName,
                    'scientificSecretary' => $faker->lastName,
                    'executiveSecretary' => $faker->lastName,
                    'poster' => "no-img",
                    'active' => 0,
                    'code' => '1234',
                    'lang'=>'en'
                ]);
            } catch (Exception $e) {
                echo "Error conference notification in {$i} ...\n";
                continue;
            }
        }
    }
}
