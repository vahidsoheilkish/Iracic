<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Author;
use App\Category;
use App\Cities;
use App\ConferenceArticle;
use App\Countries;
use App\Group;
use App\Issue;
use App\Major;
use App\Menu;
use App\Post;
use App\Submenu;
use App\User;
use function Couchbase\basicEncoderV1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    // admin dashboard => get
    public function dashboard(){
        $article_publication_count = Article::count();
        $article_conference_count = ConferenceArticle::count();
        $user_count = User::count();
        $author_count = Author::count();
        return view('admin.dashboard',compact('article_publication_count','article_conference_count','user_count','author_count'));
    }

}