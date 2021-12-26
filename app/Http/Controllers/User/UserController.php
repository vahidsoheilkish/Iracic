<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\Category;
use App\CategoryPost;
use App\Conference;
use App\ConferenceArticle;
use App\Group;
use App\Issue;
use App\Major;
use App\Menu;
use App\Post;
use App\Publication;
use App\Http\Controllers\Controller;
use App\User;
use App\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    // home page
    public function index(){

        $groups = Group::all();

        $publication_count = Publication::count();
        $conference_count = Conference::count();


        $conference_article = ConferenceArticle::count();
        $journal_article = Article::count();
        $total_articles = $conference_article + $journal_article;


        $conference_article_count_en = ConferenceArticle::where('lang','en')->count();
        $journal_article_count_en = Article::where('lang','en')->count();

        $conference_article_count_fa = ConferenceArticle::where('lang','fa')->count();
        $journal_article_count_fa = Article::where('lang','fa')->count();

        $english_article_count = $conference_article_count_en + $journal_article_count_en;
        $persian_article_count = $conference_article_count_fa + $journal_article_count_fa;

        $journal_article_min_year = Article::select('publish_year')->min('publish_year');
        $journal_article_max_year = Article::select('publish_year')->max('publish_year');

        $conference_article_min_year = ConferenceArticle::select('publish_year')->min('publish_year');
        $conference_article_max_year = ConferenceArticle::select('publish_year')->max('publish_year');

        $count_article = [];
        for($i=$journal_article_min_year; $i<=$journal_article_max_year; $i++){
            $conference = ConferenceArticle::where('publish_year',$i)->count();
            $article    = Article::where('publish_year',$i)->count();
            $count_article[$i] = $conference + $article;
        }

        $journals = Publication::with('volumes.issues.articles')->get();

        $journal_articles_count = array();
        foreach ($journals as $journal) {
            foreach($journal->volumes as $volume){
                foreach ($volume->issues as $issue){
                    $journal_articles_count[] = ['id'=>$journal->id, 'count'=>count($issue->articles)];
                }
            }
        }
        usort( $journal_articles_count,function($a,$b){
            return $a['count'] <=> $b['count'];
        });

        $ranked_journals=array();
        for($e=count($journal_articles_count) -5; $e<=count($journal_articles_count) ; $e++){
            echo $e;
//            $journal = Publication::where('_id',$journal_articles_count[$e]['id'])->first();
//            $ranked_journals[] = $journal;
        }

        dd($ranked_journals);


        $posts = Post::latest()->orderBy('id','DESC')->take(3)->get();
        return view('user/index' , compact('groups' , 'posts'));
    }


    public function test(){
        $menus= Menu::with('submenus')->get();
        return $menus;
    }

    public function menu(){
        $menus= Menu::with('submenus')->get();
        return view('user/menu',compact('menus'));
    }

    public function excel(){
        $users = User::all();
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function library(){
        $groups = Group::all();
        $majors = Major::all();
        $popular_articles_journal = [];
        $popular_articles_conference = [];
        $recent_journals = [];
        $recent_conferences = [];

        $popular_article_publication_query = Article::with('issue.volume.publication')->where('viewCount','>=',0)->latest()->orderBy('viewCount','DESC')->get();
        $popular_article_conference_query = ConferenceArticle::with('conference')->where('viewCount','>=',0)->latest()->orderBy('viewCount','DESC')->get();

        foreach ($groups as $key=>$group){
            $recent_pub = Publication::where(['lang'=>'en','group_id'=>$group->id])->latest()->orderBy('id','DESC')->take(6)->get();
            array_push($recent_journals ,  $recent_pub );

            if( !empty($popular_article_conference_query[$key]) ){
                if(isset($popular_article_conference_query[$key]->conference->group_id) ) {
                    if ($popular_article_conference_query[$key]->conference->group_id == $group->id) {
                        array_push($popular_articles_conference, $popular_article_conference_query[$key]);
                    }
                }
            }

            $recent_conf = Conference::where(['lang'=>'en','group_id'=>$group->id])->latest()->orderBy('id','DESC')->take(6)->get();
            array_push($recent_conferences ,  $recent_conf );


            $limit = 1;
            foreach($popular_article_publication_query as $k=>$pub){
                if($pub->issue->volume->publication->group_id == $group->id && $limit<=4){
                    $popular_articles_journal[] = ['group_id'=>$group->id , 'articles'=> $pub];
                    $limit +=1;
                }
            }
            $limit = 1;
            foreach($popular_article_conference_query as $k=>$conf ){
                if(isset($conf->conference->group_id) ){
                    if($conf->conference->group_id == $group->id && $limit<=4){
                        $popular_articles_conference[] = ['group_id'=>$group->id , 'articles'=> $conf];
                        $limit +=1;
                    }
                }
            }
        }
        return view('user/library' , compact('groups' ,'majors',  'recent_journals','recent_conferences','popular_articles_journal','popular_articles_conference'));
    }

    // all majors of a group => ajax
    public function majors(Group $group){
        $majors = Major::where('group_id', $group->id)->get();
        sleep(1);
        return $majors;
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'captcha' => ['required','captcha'],
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'melicode' => ['required', 'numeric','regex:/\d\d\d\d\d\d\d\d\d\d/'],
            'password' => ['required', 'string', 'min:6'],
            'password2' => ['required', 'string', 'min:6','required_with:password|same:password|min:6'],
        ],[
            'captcha.required' => 'Captcha require' ,
            'captcha.captcha' => 'Incorrect captcha' ,
            'name.required' => 'Name require' ,
            'family.required' => 'Family require' ,
            'email.required' => 'Email require' ,
            'email.email' => 'The email format is\'nt correct' ,
            'email.unique' => 'This email already submit' ,
            'melicode.required' => 'Melicode require' ,
            'melicode.numeric' => 'Melicode must be contains number' ,
            'melicode.regex' => 'Invalid Melicode' ,
            'password.required' => 'Password require' ,
            'password.string' => 'Password must be string' ,
            'password.min' => 'Password must at least 6 characters' ,
            'password2.required' => 'Confirmation password require' ,
            'password2.string' => 'Confirmation password must be string' ,
            'password2.min' => 'Confirmation password must at least 6 characters' ,
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            return response()->json(['message'=>'fail' , 'err'=>$errors]);
        }
        else{
            $data = $request->all();
            try {
                $user = User::create([
                    'email' => $data['email'],
                    'name' => $data['name'],
                    'family' => $data['family'],
                    'melicode' => $data['melicode'],
                    'password' => bcrypt($data['password']),
                    'address' => '...'
                ]);
                auth()->loginUsingId($user->id);
                return response()->json([
                    'message' => 'success'
                ]);
            }catch (\Exception $e){
                alert()->error('خطا در ثبت نام لطفا مجددا تلاش کنید','خطا');
                return response()->json([
                    'message' => 'fail'
                ]);
            }
        }
    }

    public function blogDetail(Post $post){
        $categories = CategoryPost::where('post_id',$post->id)->get();
        $categories_id = [];
        foreach ($categories as $category){
            $categories_id[]=$category->category_id;
        }
        $category_name = Category::whereIn('id',$categories_id)->get();
        $post->update(['viewCount'=>$post->viewCount+1]);
        return view('user/blog_detail',compact('post','categories','category_name'));
    }

    public function about(){
        return view('user.about');
    }

}
