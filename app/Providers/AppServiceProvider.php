<?php

namespace App\Providers;

use App\Category;
use App\ConferenceNotification;
use App\ConferenceUser;
use App\Countries;
use App\Group;
use App\Major;
use App\Menu;
use App\PublicationNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Morilog\Jalali\Jalalian;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        date_default_timezone_set("Asia/Tehran");

        define('publication_article_path','/upload/publications/articles/');
        define('conference_article_path','/upload/conferences/articles/');

        define('publication_assets_path','/upload/publications/assets');
        define('conference_assets_path','/upload/conferences/assets');

        Blade::directive('date',function(){
            return "<?php
                echo \Morilog\Jalali\Jalalian::now()->format('Y-m-d');
            ?>";
        });

        Blade::directive('digitToMonth',function($month){
           return "<?php
                switch($month){
                    case 1:
                    case 01:
                    echo 'January';
                    break;
                    
                    case 2:
                    case 02:
                    echo 'February';
                    break;
                    
                    case 3:
                    case 03:
                    echo 'March';
                    break;
                    
                    case 4:
                    case 04:
                    echo 'April';
                    break;
                    
                    case 5:
                    case 05:
                    echo 'May';
                    break;
                    
                    case 6:
                    case 06:
                    echo 'June';
                    break;
                    
                    case 7:
                    case 07:
                    echo 'July';
                    break;
                    
                    case 8:
                    case '08':
                    echo 'August';
                    break;
                    
                    case 9:
                    case '09':
                    echo 'September';
                    break;
                    
                    case 10:
                    echo 'October';
                    break;
                    
                    case 11:
                    echo 'November';
                    break;
                    
                    case 12:
                    echo 'December';
                    break;
                }
           ?>";
        });

        Blade::directive('time',function(){
            return "<?php
                echo \Morilog\Jalali\Jalalian::now()->format('H:i:sa');
            ?>";
        });

        Blade::directive('digitToFarsi', function($number){
            return "<?php
                switch ($number){
                    case 1 : echo 'اول'; break;
                    case 2 : echo 'دوم'; break;
                    case 3 : echo 'سوم'; break;
                    case 4 : echo 'چهارم'; break;
                    case 5 : echo 'پنجم'; break;
                    case 6 : echo 'ششم'; break;
                    case 7 : echo 'هفتم'; break;
                    case 8 : echo 'هشتم'; break;
                    case 9 : echo 'نهم'; break;
                    case 10 : echo 'دهم'; break;
                    case 11 : echo 'یازدهم'; break;
                    case 12 : echo 'دوازدهم'; break;
                    case 13 : echo 'سیزدهم'; break;
                    case 14 : echo 'چهاردهم'; break;
                    case 15 : echo 'پانزدهم'; break;
                    case 16 : echo 'شانزدهم'; break;
                    case 17 : echo 'هفدهم'; break;
                    case 18 : echo 'هجدهم'; break;
                    case 19 : echo 'نوزدهم'; break;
                    case 20 : echo 'بیستم'; break;
                    case 21 : echo 'بیست و یکم'; break;
                    case 22 : echo 'بیست و دوم'; break;
                    case 23 : echo 'بیست و سوم'; break;
                    case 24 : echo 'بیست و چهارم'; break;
                    case 25 : echo 'بیست و پنجم'; break;
                    case 26 : echo 'بیست و ششم'; break;
                    case 27 : echo 'بیست و هفتم'; break;
                    case 28 : echo 'بیست و هشتم'; break;
                    case 29 : echo 'بیست و نهم'; break;
                    case 30 : echo 'سی ام'; break;
                }
            ?>";
        });

        view()->composer('admin/publications/publication_users/new_publication' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('admin/conferences/volume/new_volume' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('admin/conferences/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('admin/conferences/volume/new_volume' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });

        view()->composer('admin/major/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('publication/en/dashboard/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('publication/fa/dashboard/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/en/panel/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/fa/panel/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('admin/publications/edit' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('admin/conferences/edit' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        // in English template
        view()->composer('user/publications' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        //in Persian template
        view()->composer('user_fa/publications' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('user/conferences' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('user_fa/conferences' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('admin/blog/create' , function($view){
            $cats = Category::all();
            $view->with(compact('cats'));
        });

        view()->composer('admin/blog/edit' , function($view){
            $cats = Category::all();
            $view->with(compact('cats'));
        });

        view()->composer('admin/major/edit' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/en/create' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/en/index' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/fa/index' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/en/panel/edit_conference' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/fa/panel/edit_conference' , function($view){
            $groups_list = Group::all();
            $view->with(compact('groups_list'));
        });

        view()->composer('conference/en/panel/create' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });

        view()->composer('conference/fa/panel/create' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });

        view()->composer('admin/conferences/create' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });

        view()->composer('publication/fa/dashboard/create' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });


        view()->composer('admin/publications/publication_users/new_publication' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });

        view()->composer('admin/conferences/edit' , function($view){
            $countries = Countries::all();
            $view->with(compact('countries'));
        });

        view()->composer('conference/en/panel/master' , function($view){
            $conference_user = session()->get('conference_user_notice');
            $user = ConferenceUser::with('conference')->where('_id',$conference_user->id)->first();
            $notifications_unseen = ConferenceNotification::where(['seen'=>0,'conference_user_id'=>$conference_user->id])->orderBy('id','DESC')->count();
            $view->with(compact('notifications_unseen','user'));
        });

        view()->composer('conference/fa/panel/master' , function($view){
            $conference_user = session()->get('conference_user_notice');
            $user = ConferenceUser::with('conference')->where('_id',$conference_user->id)->first();
            $notifications_unseen = ConferenceNotification::where(['seen'=>0,'conference_user_id'=>$conference_user->id])->orderBy('id','DESC')->count();
            $view->with(compact('notifications_unseen','user'));
        });

        view()->composer('publication/en/dashboard/master' , function($view){
            $publication_user = session()->get('publication_user');
            $notifications_unseen = PublicationNotification::where(['seen'=>0,'publication_user_id'=>$publication_user->id])->orderBy('id','DESC')->count();
            $view->with(compact('notifications_unseen'));
        });

        view()->composer('publication/fa/dashboard/master' , function($view){
            $publication_user = session()->get('publication_user');
            $notifications_unseen = PublicationNotification::where(['seen'=>0,'publication_user_id'=>$publication_user->id])->orderBy('id','DESC')->count();
            $view->with(compact('notifications_unseen'));
        });

        view()->composer('admin/menu/submenu_create' , function($view){
            $menus = Menu::all();
            $view->with(compact('menus'));
        });

        view()->composer('admin/menu/submenu_edit' , function($view){
            $menus = Menu::all();
            $view->with(compact('menus'));
        });



    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
