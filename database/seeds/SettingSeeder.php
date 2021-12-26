<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekly_en = ['Week1','Week2','Week3','Week4','Week5','Week6','Week7','Week8','Week9','Week10','Week11','Week12','Week13','Week14','Week15','Week16','Week17','Week18','Week19','Week20','Week21','Week22','Week23','Week24',
            'Week25','Week26','Week27','Week28','Week29','Week30','Week31','Week32','Week33','Week34','Week35','Week36','Week37','Week38','Week39','Week40','Week41','Week42','Week43','Week44','Week45','Week46','Week47','Week48','Week49','Week50','Week51','Week52'];

        $weekly_fa = ['هفته1','هفته2','هفته3','هفته4','هفته5','هفته6','هفته7','هفته8','هفته9','هفته10','هفته11','هفته12','هفته13','هفته14','هفته15','هفته16','هفته17','هفته18','هفته19','هفته20','هفته21','هفته22','هفته23','هفته24',
            'هفته25','هفته26','هفته27','هفته28','هفته29','هفته30','هفته31','هفته32','هفته33','هفته34','هفته35','هفته36','هفته37','هفته38','هفته39','هفته40','هفته41','هفته42','هفته43','هفته44','هفته45','هفته46','هفته47','هفته48','هفته49','هفته50','هفته51','هفته52'];

        $biweekly_en = ['Biweek1','Biweek2','Biweek3','Biweek4','Biweek5','Biweek6','Biweek7','Biweek8','Biweek9','Biweek10','Biweek11','Biweek12','Biweek13','Biweek14','Biweek15','Biweek16','Biweek17','Biweek18','Biweek19','Biweek20','Biweek21','Biweek22','Biweek23','Biweek24','Biweek25','Biweek26'];
        $biweekly_fa = ['دوهفته1','دوهفته2','دوهفته3','دوهفته4','دوهفته5','دوهفته6','دوهفته7','دوهفته8','دوهفته9','دوهفته10','دوهفته11','دوهفته12','دوهفته13','دوهفته14','دوهفته15','دوهفته16','دوهفته17','دوهفته18','دوهفته19','دوهفته20','دوهفته21','دوهفته22','دوهفته23','دوهفته24','دوهفته25','دوهفته26'];

        $en_month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        $fa_month = ['فروردین','اردیبهشت','خرداد','تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'];

        $bimonthly_en = ['January,February','March,April','May,June','July,August','September,October','November,December'];
        $bimonthly_fa = ['فروردین,اردیبهشت','خرداد,تیر','مرداد,شهریور','مهر,آبان','آذر,دی','بهمن,اسفند'];

        $en_season = ['winter','spring','summer','autumn'];
        $fa_season = ['بهار','تابستان','پاییز','زمستان'];

        $triannual_en = ['January-April','May-August','September-December'];
        $triannual_fa = ['فروردین-تیر','مرداد-آبان','آذر-اسفند'];;

        $en_half_year = ['winter-spring','summer-autumn'];
        $fa_half_year = ['بهار-تابستان','پاییز-زمستان'];

        $en_year = ['Current year'];
        $fa_year = ['سال جاری'];


    // WEEK
        \App\Setting::create([
            'key'=>'weekly_en',
            'value'=>json_encode($weekly_en),
        ]);

        \App\Setting::create([
            'key'=>'weekly_fa',
            'value'=>json_encode($weekly_fa),
        ]);

    // Bi Week
        \App\Setting::create([
            'key'=>'biweekly_en',
            'value'=>json_encode($biweekly_en),
        ]);

        \App\Setting::create([
            'key'=>'biweekly_fa',
            'value'=>json_encode($biweekly_fa),
        ]);
    //

    // Month
        \App\Setting::create([
            'key'=>'en_month',
            'value'=>json_encode($en_month),
        ]);

        \App\Setting::create([
            'key'=>'fa_month',
            'value'=>json_encode($fa_month),
        ]);

    // Bi Monthly
        \App\Setting::create([
            'key'=>'bimonthly_en',
            'value'=>json_encode($bimonthly_en),
        ]);

        \App\Setting::create([
            'key'=>'bimonthly_fa',
            'value'=>json_encode($bimonthly_fa),
        ]);
    // Season
        \App\Setting::create([
            'key'=>'en_season',
            'value'=>json_encode($en_season),
        ]);

        \App\Setting::create([
            'key'=>'fa_season',
            'value'=>json_encode($fa_season),
        ]);
    // Triannual_en
        \App\Setting::create([
            'key'=>'triannual_en',
            'value'=>json_encode($triannual_en),
        ]);

        \App\Setting::create([
            'key'=>'triannual_fa',
            'value'=>json_encode($triannual_fa),
        ]);
    // Half year
        \App\Setting::create([
            'key'=>'en_half_year',
            'value'=>json_encode($en_half_year),
        ]);

        \App\Setting::create([
            'key'=>'fa_half_year',
            'value'=>json_encode($fa_half_year),
        ]);

    // year
        \App\Setting::create([
            'key'=>'en_year',
            'value'=>json_encode($en_year),
        ]);

        \App\Setting::create([
            'key'=>'fa_year',
            'value'=>json_encode($fa_year),
        ]);
    }


}
