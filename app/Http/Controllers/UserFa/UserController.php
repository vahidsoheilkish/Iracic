<?php

namespace App\Http\Controllers\UserFa;


use App\Article;
use App\Conference;
use App\ConferenceArticle;
use App\Group;
use App\Issue;
use App\Major;
use App\Post;
use App\Publication;
use App\Http\Controllers\Controller;
use App\User;
use App\Volume;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(){
        $groups = Group::all();
        $majors = Major::all();
        $posts = Post::latest()->orderBy('id','DESC')->take(3)->get();
        $articles = Article::take(5)->latest()->get();
        $conferences = ConferenceArticle::take(5)->latest()->get();
        return view('user_fa/index' , compact('groups' ,'majors', 'posts', 'articles','conferences'));
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

        return view('user_fa/library' , compact('groups' ,'majors',  'recent_journals','recent_conferences','popular_articles_journal','popular_articles_conference'));
    }


    // all majors of a group
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

    //todo blogDetail

    public function about(){
        return view('user_fa.about');
    }

}