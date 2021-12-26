<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// English language controller
Route::namespace('User')->group(function(){
    $this->get('/' , 'UserController@index');
    $this->get('/library' , 'UserController@library');
    $this->post('/group/{group}' , 'UserController@majors');
    $this->post('/user/register' , 'UserController@register')->name('user.register');
    $this->get('/blog/{post}' , 'UserController@blogDetail')->name('post.detail');
    $this->get('/about' , 'UserController@about');


    $this->get('/menus' , 'UserController@menu');

//    $this->get('/test' , 'UserController@test');
//    $this->get('/excel' , 'UserController@excel');


// PUBLICATION CONTROLLER
    // get publication of group or major
    $this->get('/journal/group/{group}/major/{major?}' , 'PublicationController@publications');
    // get publication view page
    $this->get('/journal/{id}/' , 'PublicationController@publication')->name('publication.link');
    // get publications by ajax on publications page
    $this->post('/pi/journal/group/{group}/major/{major}' , 'PublicationController@ajaxPublications');
    // get publication by alphabetic ajax
    $this->post('/journal/alphabetic/{alphabetic}' , 'PublicationController@alphabeticPublication')->name('publications.alphabetic');
    // publication volumes page with issue
    $this->get('/journal/{journal}/volume/{volume}' , 'PublicationController@volumes');
    // publication get issue ajax
    $this->post('/get/issue/{issue}' , 'PublicationController@ajaxIssue')->name('usr.get.issue');
    // display article :)
    $this->get('/journal/article/page/{article}' , 'PublicationController@article')->name('usr.get.journal.article');
// END PUBLICATION


// CONFERENCE CONTROLLER
    // get conference of group or major
    $this->get('/conference/group/{group}/major/{major?}' , 'ConferenceController@conferences');
    // get conference view page
    $this->get('/conference/{id}/{conference}' , 'ConferenceController@conference')->name('conference.link');
    // get conferences by ajax on conference page
    $this->post('/pi/conference/group/{group}/major/{major}' , 'ConferenceController@ajaxConferences');
    // get conference view page
    $this->get('/conference/{id}/{conference}' , 'ConferenceController@conference')->name('conference.link'); //todo
    // get conference by alphebetic ajax
    $this->post('/conference/alphabetic/{alphabetic}' , 'ConferenceController@alphabeticConference')->name('conferences.alphabetic');
    // get conference articles from volume
    $this->post('/conference/volumes/articles' , 'ConferenceController@articles')->name('get.conference.volume');
    // get conference volume articles ajax
    $this->post('/get/articles/{conference}' , 'ConferenceController@article')->name('usr.get.conference.article');
    // display article :)
    $this->get('/conference/article/page/{article}' , 'ConferenceController@conferenceArticle')->name('usr.get.conference.article');
    // user register
});
// END CONFERENCE
// *************************************************************************************************************************************************************
// Persian language controller
Route::namespace('UserFa')->group(function() {
    $this->get('/fa' , 'UserController@index');
    $this->get('/fa/library' , 'UserController@library');
    $this->post('/fa/group/{group}' , 'UserController@majors');

    $this->post('/user/fa/register' , 'UserController@register')->name('user.fa.register');
    $this->get('/fa/about' , 'UserController@about');


// PUBLICATION CONTROLLER
    // get publication of group or major
    $this->get('/fa/journal/group/{group}/major/{major?}' , 'PublicationController@publications')->name('user.fa.publications');
    // get publications by ajax on publications page
    $this->post('/fa/pi/journal/group/{group}/major/{major}' , 'PublicationController@ajaxPublications');

    $this->get('/fa/journal/{id}' , 'PublicationController@publication')->name('user.fa.publication.page');

    $this->post('/fa/get/issue/{issue}' , 'PublicationController@ajaxIssue')->name('usr.fa.get.issue');
    // display article :)
    $this->get('/fa/journal/article/page/{article}' , 'PublicationController@article')->name('user.fa.journal.article.page');

// END PUBLICATION

// CONFERENCE CONTROLLER
    // get conference of group or major
    $this->get('/fa/conference/group/{group}/major/{major?}' , 'ConferenceController@conferences')->name('user.fa.conferences');
    // get conference view page
    $this->get('/fa/conference/{id}/{conference}' , 'ConferenceController@conference')->name('user.fa.conference.page');
    // get conferences by ajax on conference page
    $this->post('/fa/pi/conference/group/{group}/major/{major}' , 'ConferenceController@ajaxConferences');
    // display article :)
    $this->get('/fa/conference/article/page/{article}' , 'ConferenceController@article')->name('user.fa.conference.article.page');
// END CONFERENCE

});

//$this->get('/pdf/article/{article}' , 'HomeController@test')->name('article.pdf');

Route::namespace('Publication')->prefix('publication')->group(function(){
    $this->group([],function(){
        $this->get('/' , 'UserController@index')->name('publication.index');
        $this->post('/login' , 'UserController@login')->name('publication.login');
        $this->get('/register' , 'UserController@registerForm')->name('publication.registerForm');
        $this->post('/register' , 'UserController@register')->name('publication.register');
    });

    // inside publication panel
    $this->group(['middleware'=>['CheckPublicationUserAuth'] ],function(){
        // USER CONTROLLER
            $this->get('/dashboard' , 'PublicationController@dashboard')->name('publication.dashboard');
            $this->get('/create' , 'PublicationController@create')->name('publication.create');
            $this->post('/store' , 'PublicationController@store')->name('publication.store');
            $this->post('/logout' , 'PublicationController@logout')->name('publication.logout');
        // END USER CONTROLLER


        // VOLUME CONTROLLER
            $this->post('/volume/store' , 'VolumeController@store')->name('user.publication.volume.store');
        // END VOLUME CONTROLLER

        // VOLUME CONTROLLER
        $this->post('/issue/store' , 'IssueController@store')->name('publication.issue.store');
        // END ISSUE CONTROLLER

        // Article Controller
            $this->get('/article/create' , 'ArticleController@create')->name('publication.article.create');
            $this->post('/article/store' , 'ArticleController@store')->name('publication.article.store');
            $this->get('/edit/article/{article}' , 'ArticleController@edit')->middleware(['PublicationArticeActiveNotAllowToEdit'])->name('publication.edit.article');
            $this->patch('/article/update/{article}','ArticleController@update')->middleware(['PublicationArticeActiveNotAllowToEdit'])->name('user.publication.article.update');
        // End article controller

        $this->get('/notifications','PublicationController@notifications')->name('publication.notifications');
        // change seen of notification ajax
        $this->post('/notification/seen','PublicationController@changeNotificationSeen')->name('publication.change.notification.seen');

        // get all majors of a group with ajax
        $this->post('/majors/group/{group_id}' , 'PublicationController@majorsGroup')->name('publication.majors.group');
        // get all issues of a volume with ajax
        $this->post('/issues/volume/{volume_id}' , 'PublicationController@issuesVolume')->name('publication.issues.volume');

        $this->get('/change/password/form','PublicationController@changePasswordForm')->name('publication.change.password.form');
        $this->patch('/change/password','PublicationController@changePassword')->name('publication.change.password');

        $this->get('/tree/list' , 'PublicationController@tree')->name('publication.tree.list');
        $this->post('/article/delete/pdf','PublicationController@deletePdf')->name('publication.article.delete.pdf');
        //$this->post('/article/uploadFile' , 'UserPublicationController@articleUploadFile')->name('publication.article.upload.file');

    });
});

Route::namespace('PublicationFa')->prefix('fa/publication')->group(function(){
    $this->group([],function(){
        $this->get('/' , 'UserController@index')->name('publication.index.fa');
        $this->post('/login' , 'UserController@login')->name('publication.login.fa');
        $this->get('/register' , 'UserController@registerForm')->name('publication.registerForm.fa');
        $this->post('/register' , 'UserController@register')->name('publication.register.fa');
    });

    $this->group(['middleware'=>['CheckPublicationUserAuth'] ],function(){

        // USER CONTROLLER
            $this->get('/dashboard' , 'PublicationController@dashboard')->name('publication.dashboard.fa');
            $this->post('/logout' , 'PublicationController@logout')->name('publication.logout.fa');
            $this->get('/create' , 'PublicationController@create')->name('publication.create.fa');
            $this->post('/store' , 'PublicationController@store')->name('publication.store.fa');
        // END USER

        // VOLUME CONTROLLER
            $this->post('/volume/store' , 'VolumeController@store')->name('user.publication.volume.store.fa');
        // END VOLUME

        // ISSUE CONTROLLER
            $this->post('/issue/store' , 'IssueController@store')->name('publication.issue.store.fa');
        // END ISSUE

        // Article controller
            $this->get('/article/create' , 'ArticleController@create')->name('publication.article.create.fa');
            $this->post('/article/store' , 'ArticleController@store')->name('publication.article.store.fa');
            $this->get('/edit/article/{article}' , 'ArticleController@edit')->middleware(['PublicationArticeActiveNotAllowToEdit'])->name('publication.edit.article.fa');
            $this->patch('/article/update/{article}','ArticleController@update')->middleware(['PublicationArticeActiveNotAllowToEdit'])->name('user.publication.article.update.fa');
        // End Article controller


        $this->get('/notifications','PublicationController@notifications')->name('publication.notifications.fa');
        // change seen of notification ajax
        $this->post('/notification/seen','PublicationController@changeNotificationSeen')->name('publication.change.notification.seen.fa');

        // get all majors of a group with ajax
        $this->post('/majors/group/{group_id}' , 'PublicationController@majorsGroup')->name('publication.majors.group.fa');
        // get all issues of a volume with ajax
        $this->post('/issues/volume/{volume_id}' , 'PublicationController@issuesVolume')->name('publication.issues.volume.fa');

        $this->get('/change/password/form','PublicationController@changePasswordForm')->name('publication.change.password.form.fa');
        $this->patch('/change/password','PublicationController@changePassword')->name('publication.change.password.fa');

        $this->get('/tree/list' , 'PublicationController@tree')->name('publication.tree.list.fa');
        $this->post('/article/delete/pdf','PublicationController@deletePdf')->name('publication.article.delete.pdf.fa');
//        $this->post('/article/uploadFile' , 'UserPublicationController@articleUploadFile')->name('publication.article.upload.file.fa');
    });
});

Route::namespace('Admin')->prefix('admin')->middleware(['CheckAdmin','auth'])->group(function() {
    // admin dashboard
    $this->get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
// BLOG CONTROLLER
    $this->get('/blog', 'BlogController@index')->name('admin.blog');
    $this->get('/blog/edit/{post}', 'BlogController@edit')->name('admin.blog.edit');
    $this->patch('/blog/update/{post}', 'BlogController@update')->name('admin.blog.update');
    $this->delete('/blog/delete/{post}', 'BlogController@destroy')->name('admin.blog.delete');
    $this->get('/blog/create', 'BlogController@create')->name('admin.blog.create');
    $this->post('/blog/store', 'BlogController@store')->name('admin.blog.store');
// END BLOG

// GROUP CONTROLLER
    $this->get('/groups', 'GroupController@index')->name('admin.groups');
    $this->get('/group/create', 'GroupController@create')->name('admin.group.create');
    $this->get('/group/edit/{group}', 'GroupController@edit')->name('admin.group.edit');
    $this->post('/group/store', 'GroupController@store')->name('admin.group.store');
    $this->patch('/group/update/{group}', 'GroupController@update')->name('admin.group.update');
// END GROUP

// MAJOR CONTROLLER
    $this->get('/majors', 'MajorController@index')->name('admin.majors');
    $this->get('/major/create', 'MajorController@create')->name('admin.major.create');
    $this->post('/major/store', 'MajorController@store')->name('admin.major.store');
    $this->get('/major/edit/{major}', 'MajorController@edit')->name('admin.major.edit');
    $this->patch('/major/update/{major}', 'MajorController@update')->name('admin.major.update');
// END MAJOR

// COUNTRY CONTROLLER
    $this->get('/countries', 'CountryController@index')->name('admin.countries');
    $this->post('/country/store', 'CountryController@store')->name('admin.country.store');
    $this->delete('/country/remove/{country}', 'CountryController@destroy')->name('admin.country.remove');
// END COUNTRY

// CITY CONTROLLER
    $this->post('/city/store', 'CityController@store')->name('admin.city.store');
    $this->delete('/city/remove/{city}', 'CityController@destroy')->name('admin.city.remove');
// END CITY

// CATEGORY CONTROLLER
    $this->get('/category', 'CategoryController@index')->name('admin.categories');
    $this->get('/category/create', 'CategoryController@create')->name('admin.categories.create');
    $this->post('/category/store', 'CategoryController@store')->name('admin.categories.store');
// END CATEGORY

// MENU CONTROLLER
    $this->get('/menus', 'MenuController@index')->name('admin.menus');
    $this->get('/menu/create', 'MenuController@create')->name('admin.menu.create');
    $this->post('/menu/store', 'MenuController@store')->name('admin.menu.store');
    $this->get('/menu/edit/{menu}', 'MenuController@edit')->name('admin.menu.edit');
    $this->patch('/menu/update/{menu}', 'MenuController@update')->name('admin.menu.update');
    $this->post('/menu/remove/{menu}', 'MenuController@destroy')->name('admin.menu.remove');
    // display or nondisplay menu ajax
    $this->post('/menu/change/display', 'MenuController@display')->name('admin.menu.change.display');
// END MENU


// SUBMEN CONTROLLER
    $this->get('/submenu/create', 'SubmenuController@create')->name('admin.submenu.create');
    $this->post('/submenu/store', 'SubmenuController@store')->name('admin.submenu.store');
    $this->get('/submenu/edit/{submenu}', 'SubmenuController@edit')->name('admin.submenu.edit');
    $this->patch('/submenu/update/{submenu}', 'SubmenuController@update')->name('admin.submenu.update');
    $this->post('/submenu/remove/{submenu}', 'SubmenuController@destroy')->name('admin.submenu.remove');
    // display or nondisplay submenu ajax
    $this->post('/submenu/change/display', 'SubmenuController@submenuDisplay')->name('admin.submenu.change.display');
// END SUBMENU
});

Route::namespace('Admin\Publication')->prefix('admin/publication')->middleware(['CheckAdmin','auth'])->group(function() {
    // Publication user and publication menu in admin panel > all method in Admin\PublicationController
    // user controller
    $this->get('/users' , 'UserController@index')->name('admin.publication.users');
    $this->get('/users/edit/{publicationUser}' , 'UserController@edit')->name('admin.publication.users.edit');
    $this->patch('/users/update/{publicationUser}' , 'UserController@update')->name('admin.publication.users.update');
    $this->get('/user/new', 'UserController@create')->name('admin.publication.new.user');
    $this->post('/user/store' , 'UserController@store')->name('admin.publication.new.user.store');
    $this->post('/send/notification/{publicationUser}' , 'UserController@sendNotification')->name('admin.publication.send.notification');
    $this->post('/majors/group' , 'UserController@majorsGroup')->name('admin.publication.majors.group');
    // end user controller

    // publication controller
        $this->get('/' , 'PublicationController@index')->name('admin.publications');
        $this->get('/add' , 'PublicationController@add')->name('admin.add.publication');
        $this->get('/new/publication/{user}', 'PublicationController@create')->name('admin.publication.new.publication');
        $this->post('/new/publication/store', 'PublicationController@store')->name('admin.publication.store.publication');
        $this->get('/edit/{publication}' , 'PublicationController@edit')->name('admin.publication.edit');
        $this->patch('/update/{publication}' , 'PublicationController@update')->name('admin.publication.update');
        // active deactive publication
        $this->post('/edit/active/{publication}' , 'PublicationController@active')->name('admin.publication.active');
        // page of publication with volumes with issue all in view page
        $this->get('/group/{group}/major/{major}/publication/{publication}/volume/{volume}/issues' , 'PublicationController@publicationVolumeIssues')->name('admin.publication.volume.issues');
    // end publication

    // volume controller
        Route::get('/{publication}' , 'VolumeController@index')->name('admin.publication.volume');
        $this->post('/volume/store' , 'VolumeController@store')->name('admin.publication.volume.store');
        $this->post('/volume/update/{volume}' , 'VolumeController@update')->name('admin.publication.volume.update');
    // end volume controller


    // issue controller
        $this->post('/volume/issue/store' , 'IssueController@store')->name('admin.publication.volume.issue.store');
        $this->post('/issue/update' , 'IssueController@update')->name('admin.publication.issue.update');
        // show
    // end issue controller

    // article controller
    $this->get('/article/create/group/{group}/major/{major}/publication/{publication}/volume/{volume}/issue/{issue}', 'ArticleController@create')->name('publication.article.admin.create');
    $this->post('/article/store' , 'ArticleController@store')->name('admin.publication.article.store');
    $this->get('/edit/article/{article}' , 'ArticleController@edit')->name('publication.article.edit');
    $this->put('/update/article/{article}' , 'ArticleController@update')->name('publication.article.update');
    $this->post('/remove/article/{article}' , 'ArticleController@destroy')->name('publication.article.remove');
    $this->post('/article/file/remove' , 'ArticleController@removeFile')->name('admin.publication.article.remove.file');
    $this->post('/get/article/{article}' , 'ArticleController@get')->name('admin.publication.get.article');
    $this->post('/article/edit/active/{publication}/{article}' , 'ArticleController@active')->name('admin.publication.article.active');
    // ajax get articles in a issue and get article
    $this->post('/get/issue/{issue}' , 'ArticleController@issue')->name('admin.publication.get.issue');
    // delete article pdf file
    $this->post('/publication/article/delete/pdf','ArticleController@deletePdf')->name('admin.publication.article.delete');
    // end article

//    $this->post('/article/admin/uploadFile' , 'PublicationController@articleUploadFile')->name('admin.publication.article.upload.file');
//    $this->post('/article/admin/uploadFile/update' , 'PublicationController@articleUploadFileUpdate')->name('admin.publication.article.upload.file.update');
    // ajax get article info
//    $this->post('/article/admin/dir/session' , 'PublicationController@setDirSession')->name('publication.article.dir.session');
    // get all majors from a group
});
Route::namespace('Admin\Conference')->prefix('admin/conference')->middleware(['CheckAdmin','auth'])->group(function() {
    // Conference user and conference menu in admin panel > all method in Admin\ConferenceController

    // user controller
    $this->get('/users', 'UserController@index')->name('admin.conference.users');
    $this->get('/users/edit/{conferenceUser}', 'UserController@edit')->name('admin.conference.users.edit');
    $this->patch('/users/update/{conferenceUser}', 'UserController@update')->name('admin.conference.users.update');
    $this->get('/user/new', 'UserController@create')->name('admin.conference.new.user');
    $this->post('/user/store', 'UserController@store')->name('admin.conference.new.user.store');

    // send notification to conference user in admin panel
    $this->post('/send/notification/{conferenceUser}' , 'UserController@sendNotification')->name('admin.conference.send.notification');
    // end user controller

    // conference controller
    $this->get('/', 'ConferenceController@index')->name('admin.conferences');
    $this->get('/create/{user}', 'ConferenceController@create')->name('admin.create.conference');
    $this->get('/edit/{conference}', 'ConferenceController@edit')->name('admin.conference.edit');
    $this->post('/store/{user}', 'ConferenceController@store')->name('admin.conference.store');
    $this->patch('/update/{conference}', 'ConferenceController@update')->name('admin.conference.update');
    $this->post('/edit/active/{conference}' , 'ConferenceController@active')->name('admin.conference.active');
    // end conference controller

    // volume controller
    $this->post('/volume/store', 'VolumeController@store')->name('admin.conference.volume.store');
    $this->post('/volume/update/{volume}', 'VolumeController@update')->name('admin.conference.volume.update');
    $this->get('/conference/volume/{volume}/articles','VolumeController@show')->name('admin.conference.volume.articles');
    $this->get('/create/volume/{conference}','VolumeController@create')->name('admin.conference.new.volume');
    $this->post('/conference/submit/new/volume/{conference}', 'VolumeController@store')->name('admin.conference.submit.volume');
    // end volume controller

    // article controller
    $this->get('/article/create/group/{group}/major/{major}/volume/{volume}' , 'ArticleController@create')->name('admin.conference.create.article');
    $this->post('/admin/article/store' , 'ArticleController@store')->name('admin.conference.article.store');
    $this->get('/edit/article/{article}' , 'ArticleController@edit')->name('conference.article.edit');
    $this->patch('/update/article/{article}' , 'ArticleController@update')->name('conference.article.update');
    $this->post('/remove/article/{article}' , 'ArticleController@destroy')->name('conference.article.remove');

    $this->post('/article/edit/active/{conference}/{article}' , 'ArticleController@active')->name('admin.conference.article.active');

    $this->post('/article/file/remove' , 'ArticleController@removeFile')->name('admin.conference.article.remove.file');
    $this->post('/get/article/{conferenceArticle}' , 'ArticleController@get')->name('admin.conference.get.article');
//    $this->get('/articles/{volume}' , 'ArticleController@conferenceVolumes')->name('admin.conference.volumes');

    // end article controller

//    $this->get('/group/{group}/major/{major}/conference/{conference}' , 'ConferenceController@conferenceVolumes')->name('admin.conference.volume');
    // active article
//    $this->post('/article/admin/uploadFile' , 'ConferenceController@articleUploadFile')->name('admin.conference.article.upload.file');
//    $this->post('/article/admin/uploadFile/update' , 'ConferenceController@articleUploadFileUpdate')->name('admin.conference.article.upload.file.update');
    //remove file in edit article
    // ajax get articles in a volume and get article
//    $this->post('/volumes/article/{conferenceVolume}' , 'ConferenceController@getVolumesArticle')->name('admin.conference.volumes.article');
    // set a session to make unique directory of an articles => post
//    $this->post('/article/admin/dir/session' , 'ConferenceController@setDirSession')->name('conference.article.dir.session');

    // ajax get all majors of group
    $this->post('/majors/group' , 'ConferenceController@majorsGroup')->name('admin.conference.majors.group');
    // **********************************************************************************************************
    // get all articles from a conference
    $this->post('/conference/article/delete/pdf','ConferenceController@deletePdf')->name('admin.conference.delete.pdf');
});

Route::namespace('ConferenceNotification')->prefix('conferences')->group(function() {
    // USER CONTROLLER
    $this->get('/','UserController@index')->name('conference.notice');
    $this->get('/gate','UserController@gate')->name('conference.notice.gate');
    $this->get('/register' , 'UserController@registerForm')->name('conference.notice.registerForm');
    $this->post('/login','UserController@login')->name('conference.notice.login');
    $this->post('/register','UserController@userRegister')->name('conference.notice.register');

    // get conferences of a major used ajax => post
    $this->post('/get/group/{group}/major/{major}','UserController@getConferences')->name('conference.notice.get.all');
    $this->get('/single/{conference}/{conference_volume}','UserController@singleConference')->name('conference.notice.single.page');
    $this->post('/search','UserController@searchConference')->name('conference.notice.search');
    // END USER CONTROLLER

    $this->group(['middleware'=>['CheckAuthUserConferenceNotice']] , function(){
        $this->get('/dashboard','ConferenceController@dashboard')->name('conference.notice.dashboard');
        $this->post('/logout','ConferenceController@logout')->name('conference.notice.logout');

        // conference controller
            $this->get('/create','ConferenceController@create')->name('conference.notice.create');
            $this->post('/store/conference','ConferenceController@store')->name('conference.notice.store');
            $this->get('/edit/conference/{conference}','ConferenceController@edit')->name('conference.notice.edit.conference');
            $this->patch('/update/conference/{conference}','ConferenceController@update')->name('conference.notice.update.conference');

            // get all cities of a country ajax
            $this->post('/get/cities','ConferenceController@getCities')->name('conference.notice.get.cities');
            $this->get('/conferences/list','ConferenceController@conferencesList')->name('conference.notice.conferences.list');
        // end conference

        // volume controller
            $this->get('/create/volume','VolumeController@create')->name('conference.notice.create.volume');
            $this->post('/volume/store','VolumeController@store')->name('conference.notice.volume.store');
        // end volume

        // article controller
            $this->get('/articles/{conference}','ArticleController@show')->name('conference.notice.conference.articles');
            $this->get('/article/create/{conference}' , 'ArticleController@create')->name('conference.article.create');
            $this->post('/article/store' , 'ArticleController@store')->name('conference.article.store');
            $this->get('/conference/article/edit/{article}','ArticleController@edit')->middleware(['ConferenceArticeActiveNotAllowToEdit'])->name('conference.notice.article.edit');
            $this->patch('/conference/article/update/{article}','ArticleController@update')->middleware(['ConferenceArticeActiveNotAllowToEdit'])->name('conference.notice.article.update');
            $this->get('/{conference}/volume/{volume}/article', 'ArticleController@show')->name('admin.conference.volume.article');
        // end article

        $this->get('/notifications','ConferenceController@notifications')->name('conference.notice.notifications');
        $this->post('/notification/seen','ConferenceController@changeNotificationSeen')->name('conference.notice.change.notification.seen');

        $this->get('/change/password','ConferenceController@changePasswordForm')->name('conference.notice.change.pass.form');
        $this->patch('/change/password','ConferenceController@changePassword')->name('conference.notice.change.pass');

        $this->post('/conference/article/article/delete/pdf','ConferenceController@deletePdf')->name('conference.notice.article.delete.pdf');

        //$this->post('/article/uploadFile' , 'ConferenceNoticeController@articleUploadFile')->name('conference.article.upload.file');
    });

});

Route::namespace('ConferenceNotificationFa')->prefix('fa/conferences')->group(function() {
    // user controller
    $this->get('/','UserController@index')->name('conference.notice.fa');
    $this->get('/gate','UserController@gate')->name('conference.notice.gate.fa');
    $this->post('/login','UserController@login')->name('conference.notice.login.fa');
    $this->get('/register' , 'UserController@registerForm')->name('conference.notice.registerForm.fa');
    $this->post('/register','UserConferenceController@userRegister')->name('conference.notice.register.fa');
    // get conferences of a major used ajax => post
    $this->post('/get/group/{group}/major/{major}','UserController@getConferences')->name('conference.notice.get.all.fa');
    $this->get('/single/{conference}','UserController@singleConference')->name('conference.notice.single.page.fa');
    $this->post('/search','UserController@searchConference')->name('conference.notice.search.fa');

    // end user controller

    // ajax get all cities of a country
    $this->post('/get/cities','ConferenceController@getCities')->name('conference.notice.get.cities.fa');
    $this->get('/volumes/list','ConferenceController@conferencesList')->name('conference.notice.volumes.list.fa');

    $this->group(['middleware'=>['CheckAuthUserConferenceNotice']] , function(){
        $this->get('/dashboard','ConferenceController@dashboard')->name('conference.notice.dashboard.fa');
        $this->post('/logout','ConferenceController@logout')->name('conference.notice.logout.fa');

        // conference controller
        $this->get('/create','ConferenceController@create')->name('conference.notice.create.fa');
        $this->post('/store/conference','ConferenceController@store')->name('conference.notice.store.fa');
        $this->get('/edit/conference/{conference}','ConferenceController@edit')->name('conference.notice.edit.conference.fa');
        $this->patch('/update/conference/{conference}','ConferenceController@update')->name('conference.notice.update.conference.fa');
        // end conference controller


        // article controller
        Route::get('/articles/{article}','ArticleController@show')->name('conference.notice.conference.articles.fa');
        Route::get('/article/create/{group}/{major}/{conference}/{volume}' , 'ArticleController@create')->name('conference.article.create.fa');
        $this->post('/article/store' , 'ArticleController@store')->name('conference.article.store.fa');
        $this->get('/conference/article/edit/{article}','ArticleController@edit')->middleware(['ConferenceArticeActiveNotAllowToEdit'])->name('conference.notice.article.edit.fa');
        $this->patch('/conference/article/update/{article}','ArticleController@update')->middleware(['ConferenceArticeActiveNotAllowToEdit'])->name('conference.notice.article.update.fa');
        // end article controller

        // volume controller
        $this->get('/create/volume/{conference}','VolumeController@create')->name('conference.notice.create.volume.fa');
        $this->post('/volume/store/{conference}','VolumeController@store')->name('conference.notice.volume.store.fa');
        // end volume controller


        $this->get('/notifications','ConferenceController@notifications')->name('conference.notice.notifications.fa');
        $this->post('/notification/seen','ConferenceController@changeNotificationSeen')->name('conference.notice.change.notification.seen.fa');

        $this->get('/change/password','ConferenceController@changePasswordForm')->name('conference.notice.change.pass.form.fa');
        $this->patch('/change/password','ConferenceController@changePassword')->name('conference.notice.change.pass.fa');

        $this->post('/conference/article/article/delete/pdf','ConferenceController@deletePdf')->name('conference.notice.article.delete.pdf.fa');

        //$this->post('/article/uploadFile' , 'ConferenceNoticeController@articleUploadFile')->name('conference.article.upload.file.fa');
    });
});


Route::namespace('Auth')->group(function() {
    // Authentication Routes...
    $this->get('login', 'LoginController@showLoginForm')->name('login');
    $this->post('login', 'LoginController@login');
    $this->post('logout', 'LoginController@logout')->name('logout');
    // Registration Routes...
    $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
    $this->post('register', 'RegisterController@register');

});

Route::get('/test/search/', 'HomeController@search');
