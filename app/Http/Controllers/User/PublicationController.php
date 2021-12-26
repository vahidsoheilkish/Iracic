<?php

namespace App\Http\Controllers\User;

use App\Article;
use App\ConferenceArticle;
use App\Group;
use App\Issue;
use App\Major;
use App\Publication;
use App\Volume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationController extends Controller
{

    public function publications(Group $group , Major $major){
        if($major->id != null){
            $publications = Publication::with('volumes')->where(['lang'=>'en','group_id' => $group->id , 'major_id' => $major->id])->orderBy('title','asc')->get();
            return view('user/publications' , compact('publications','group','major'));
        }else{
            $publications = Publication::with('volumes')->where(['lang'=>'en','group_id' => $group->id])->orderBy('title','asc')->get();
            return view('user/publications' , compact('publications','group','major'));
        }
    }

    // display publication informations in the view => get
    public function publication($id){
        $journal=Publication::where(['_id'=>$id])->first();
        $journal->update(['viewCount'=>$journal->viewCount +1]);
        $group= $journal->getGroup();
        $major=$journal->getMajor();
        return view('user/publication_volumes',compact('journal','group','major'));
    }

    // get publication of a major used ajax => post
    public function ajaxPublications(Group $group,$major){
        if($major == -1){
            $publications = Publication::with('volumes')->where(['lang'=>'en','group_id' => $group->id ])->orderBy('title','asc')->get();

        }else {
            $publications = Publication::with('volumes')->where(['lang'=>'en','group_id' => $group->id, 'major_id' => $major])->orderBy('title', 'asc')->get();
        }
        sleep(1);
        return $publications;
    }

    public function alphabeticPublication(Request $request , $alphabetic){
        $inputs = $request->all();
        $order_by_letter = [];
        if($inputs['major'] == -1 || $inputs['major'] == ""){
            $publications = Publication::where('group_id',$inputs['group'])->get();
        }else{
            $publications = Publication::where(['group_id'=>$inputs['group'] , 'major_id'=>$inputs['major']])->get();
        }
        foreach ($publications as $publication){
            if( preg_match("/[".$alphabetic."|".strtoupper($alphabetic)."]+/" , $publication->title) ){
                $order_by_letter[] = $publication;
            }
        }
        sleep(1);
        return response()->json(['message'=>'success' , 'publications'=>$order_by_letter]);
    }


    public function volumes(Publication $journal,Volume $volume){
        return view('user/publication_info',compact('volume','journal'));
    }

    public function ajaxIssue(Issue $issue){
        $articles = Article::where('issue_id' , $issue->id)->with('issue')->get();
        sleep(1);
        return $articles;
    }

    public function article(Article $article){
        $article->update(['viewCount'=>$article->viewCount +1]);
        $article = $article::with('issue.volume.publication')->where('_id',$article->id)->first();
        $related_articles = Article::where('issue_id',$article->issue_id)->get();
        $pdf_file = $this->findPdfFile(scandir(public_path("upload/publications/articles/".$article->dir)));
        $authors = json_decode($article->authors_info);
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
        return view('user/publication_article',compact('article','authors','keywords','structs','resource','resource_cite','pdf_file','related_articles'));
    }

}
