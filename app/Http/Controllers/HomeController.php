<?php

namespace App\Http\Controllers;

use App\Article;
use App\ConferenceArticle;
use App\Events\ArticleSubmit;
use App\Publication;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function test(Article $article){
        $authors = json_decode($article->authors_info);
        $abstract = json_decode($article->abstract);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->structure);
        $resource = json_decode($article->resource , true);



        $pdf = App::make('dompdf.wrapper');
        $pdf->setOptions(['dpi' => 150, 'defaultFont' => 'tahoma']);
        $view = view('test',compact('article','authors','abstract','keywords','structs','resource'));
        $pdf->loadHTML($view);
        return $pdf->stream();
    }


    public function substring(){
        $authors = ['vahidsoheilkish@gmail.com'];
        $id = 13522;
        $title = "sample title 12xs12";
        event(new ArticleSubmit($authors,$id,$title));
//        $title =  "I have a book";
//        $resource =  "I have a book";
//
//        dd( $this->match());
    }

    private function contains($str , $search, $caseSensitive = false){
        if($caseSensitive){
            return strpos($str , $search) !== false;
        }else{
            return strpos(strtolower($str) , strtolower($search)) !== false;
        }
    }
    /*
    public function match(){
        $title = "consider iranian";
        $resource = "consider performance of longe in the iranian children lang that have got ill";

        $regex = explode(" ",$title);
		
        $regex = implode('.*',$regex);
        if(preg_match("/".$regex."/",$resource)){
            return true;
        }else{
            return false;
        }

    }
    */

    public function search(){
//        $publication =  Publication::with('volumes.issues.articles')->first();
//        return $publication;
        $article =  ConferenceArticle::where('_id', '5da2b3abab59e705c4007282')->first();
        $authors_info =  json_decode($article->authors_info);
        foreach ($authors_info as $author) {
            echo $author->name. "<br>";
            echo $author->family. "<br>";
            echo $author->rate. "<br>";
        }
    }

}
