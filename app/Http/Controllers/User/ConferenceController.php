<?php

namespace App\Http\Controllers\User;

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
            return view('user/conferences' , compact('conferences','group','major'));
        }else{
            $conferences = Conference::with('volumes')->where(['lang'=>'en','group_id' => $group->id])->orderBy('title','asc')->get();
            return view('user/conferences' , compact('conferences','group','major'));
        }
    }

    public function conference($id,$slug){
        $conference=Conference::with('volumes')->orderBy('startDate','ASC')->where(['_id'=>$id,'slug'=>$slug])->first();
        return view('user/conference_info',compact('conference'));
    }

    // get publication of a major used ajax => post
    public function ajaxConferences(Group $group,$major){
        if($major == -1){
            $conferences = Conference::with('volumes')->where(['group_id' => $group->id ])->orderBy('title','asc')->get();

        }else {
            $conferences = Conference::with('volumes')->where(['group_id' => $group->id, 'major_id' => $major])->orderBy('title', 'asc')->get();
        }
        sleep(1);
        return $conferences;
    }

    public function alphabeticConference(Request $request , $alphabetic){
        $inputs = $request->all();
        $order_by_letter = [];
        if($inputs['major'] == -1 || $inputs['major'] == ""){
            $conferences = Conference::where('group_id',$inputs['group'])->get();
        }else{
            $conferences = Conference::where(['group_id'=>$inputs['group'] , 'major_id'=>$inputs['major']])->get();
        }
        foreach ($conferences as $conference){
            if( preg_match("/[".strtolower($alphabetic)."|".strtoupper($alphabetic)."]+/" , $conference->title) ){
                $order_by_letter[] = $conference;
            }
        }
        sleep(1);
        return response()->json(['message'=>'success' , 'conferences'=>$order_by_letter]);
    }

    public function articles(Request $request){
        $request->validate([
            'volume'=>'required'
        ]);
        $volume_id = $request->input('volume');
        return ConferenceArticle::where('conference_volume_id',$volume_id)->get();
    }

    public function article(Conference $conference){
        $articles = ConferenceArticle::where('conference_id' , $conference->id)->with('conference')->get();
        sleep(1);
        return $articles;
    }

    public function conferenceArticle(ConferenceArticle $article){
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
        return view('user/conference_article',compact('article','authors','abstract','keywords','structs','resource','resource_cite','pdf_file'));
    }

}
