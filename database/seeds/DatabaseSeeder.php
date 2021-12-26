<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @param \Faker\Generator $faker
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
//        factory(\App\User::class , 20)->create();
//        factory(\App\Group::class , 5)->create();
//        factory(\App\Major::class , 10)->create();
//        factory(\App\PublicationUser::class , 50)->create();
//        factory(\App\PublicationNotification::class , 300)->create();
//        factory(\App\Publication::class, 100)->create();
//        factory(\App\Volume::class , 200)->create();
//        factory(\App\Issue::class , 600)->create();
//        factory(\App\Article::class , 1000)->create();
//        factory(\App\ConferenceUser::class , 50)->create();
//        factory(\App\ConferenceNotification::class , 300)->create();
//        factory(\App\Conference::class , 100)->create();
//        factory(\App\ConferenceArticle::class , 1000)->create();
//        factory(\App\Post::class , 30)->create();
//        factory(\App\Comment::class , 400)->create();
//        factory(\App\Countries::class , 30)->create();
//        factory(\App\Cities::class , 60)->create();
//        $this->call(UsersTableSeeder::class);

        $this->call(UsersSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitySeeder::class);
        $this->call(GroupsSeeder::class);
        $this->call(MajorsSeeder::class);
        $this->call(PublicationUsersSeeder::class);
        $this->call(PublicationNotificationSeed::class);
        $this->call(PublicationSeeder::class);
        $this->call(VolumeSeeder::class);
        $this->call(IssueSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(ConferenceUsersSeeder::class);
        $this->call(ConferenceNotificationSeed::class);
        $this->call(ConferenceSeeder::class);
        $this->call(ConferenceVolumeSeeder::class);
        $this->call(ConferenceArticleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SubmenuSeeder::class);
    }
}
