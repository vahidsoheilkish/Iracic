<?php

namespace App\Http\Controllers\UserFa;

use App\Article;
use App\Conference;
use App\ConferenceArticle;
use App\Group;
use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferenceController extends Controller
{

    public function conferences(Group $group , Major $major){
        if($major->id != null){
            $conferences = Conference::with('volumes')->where(['lang'=>'en','group_id' => $group->id , 'major_id' => $major->id])->orderBy('title','asc')->get();
            return view('user_fa/conferences' , compact('conferences','group','major'));
        }else{
            $conferences = Conference::with('volumes')->where(['lang'=>'en','group_id' => $group->id])->orderBy('title','asc')->get();
            return view('user_fa/conferences' , compact('conferences','group','major'));
        }
    }


    public function conference($id,$slug){
        $conference=Conference::with('volumes')->orderBy('startDate','ASC')->where(['_id'=>$id,'slug'=>$slug])->first();
        return view('user_fa/conference_info',compact('conference'));
    }

    // get publication of a major used ajax => post
    public function ajaxConferences(Group $group,$major){
        if($major == -1){
            $conferences = Conference::with('volumes')->where(['lang'=>'en' ,'group_id' => $group->id ])->orderBy('title','asc')->get();

        }else {
            $conferences = Conference::with('volumes')->where(['lang'=>'en' ,'group_id' => $group->id, 'major_id' => $major])->orderBy('title', 'asc')->get();
        }
        sleep(1);
        return $conferences;
    }

    public function article(ConferenceArticle $article){
        $article = ConferenceArticle::with('volume')->where('_id',$article->id)->first();
        $pdf_file = $this->findPdfFile(scandir(public_path("upload/conferences/articles/".$article->files_directory)));
        $authors = json_decode($article->authors_info);
        $abstract = json_decode($article->abstract);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->struct);
        $resource = json_decode($article->resource , true);
        $resource_cite = [];
        $all_articles = [];
        $publication_articles = Article::all();
        $conference_articles = ConferenceArticle::all();
        array_push($all_articles, $publication_articles);
        array_push($all_articles, $conference_articles);
        foreach ($resource as $index=>$res){
            $res = $this->normal_text($res);
            foreach ($all_articles[0] as $key=>$db_article){
                $title = $this->normal_text($db_article->title);
                if($this->match(strtolower($res) , strtolower($title)) === true){
                    $resource_cite[] = ['resource'=>$res , 'citation'=>$db_article->id];
                    $saved = true;
                }else{
                    $saved = false;
                }
            }
            foreach ($all_articles[1] as $key=>$db_article){
                $title = $this->normal_text($db_article->title);
                if($this->match(strtolower($res) , strtolower($title)) === true){
                    $resource_cite[] = ['resource'=>$res , 'citation'=>$db_article->id];
                    $saved = true;
                }else{
                    $saved = false;
                }
            }
            if($saved == false) {
                $resource_cite[] = ['resource' => $res];
            }
            $saved = false;
        }
        return view('user_fa/conference_article',compact('article','authors','abstract','keywords','structs','resource','resource_cite','pdf_file'));
    }



}
