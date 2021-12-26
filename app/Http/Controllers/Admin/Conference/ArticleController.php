<?php

namespace App\Http\Controllers\Admin\Conference;

use App\ConferenceArticle;
use App\ConferenceVolume;
use App\Group;
use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Group $group
     * @param Major $major
     * @param ConferenceVolume $volume
     * @return \Illuminate\Http\Response
     */
    public function create($group,$major,ConferenceVolume $volume)
    {
        $volume = $volume->with('conference')->first();
        return view('admin.conferences.new_article.conference',compact('group','major','volume'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'volume_id' => 'required',
            'group_id' => 'required',
            'major_id' => 'required',
            'lang' => 'required',

            'title' => 'required',
            'type' => 'required',
            'abstract' => 'required',
            'keywords' => 'required',
            'highlight' => 'required',

            'resource' => 'required',
            'explode_resource' => 'required',

            'author_name.*' => 'required',
            'author_family.*' => 'required',
            'author_email.*' => 'required|email',

            'DOI' => 'required',
            'receieved_date' => 'required',
            'accepted_date' => 'required',

            'price' => 'required|numeric',

            'page_count' => 'required|numeric',
            'page_from' => 'required|numeric',
            'page_to' => 'required|numeric',

            'press' => 'required',
            'upload' => 'required|max:5120',
        ],[]);
        $inputs = $request->all();
        $struct = array();
        for($i=0; $i< count($inputs['struct_title']) ; $i++){
            if( isset( $inputs['sub_struct_'.($i+1)] ) ){
                $substr = array();
                for($j=0 ; $j<count($inputs['sub_struct_'.($i+1)]); $j++ ){
                    if($inputs['sub_struct_'.($i+1)][$j] == null){
                        continue;
                    }
                    array_push($substr ,$inputs['sub_struct_'.($i+1)][$j]);
                }
            }
            if(empty($substr)){
                array_push($struct , [
                    'str'=>$inputs['struct_title'][$i],
                ]);
            }else{
                array_push($struct , [
                    'str'=>$inputs['struct_title'][$i],
                    'substr'=>$substr
                ]);
                $substr = [];
            }
        }
        $struct =  json_encode($struct);
        $resource_explode = explode("#\r\n**********\r\n#", $inputs['explode_resource']);
        $resource = array();
        foreach ($resource_explode as $val){
            array_push($resource , $val);
        }
        $resource = json_encode($resource) ;
        $author = array();
        for($i=0; $i< count( $inputs['author_name'] ) ; $i++){
            $author_info = array(
                'name' => $inputs['author_name'][$i] ,
                'family' => $inputs['author_family'][$i] ,
                'email' => $inputs['author_email'][$i] ,
                'education' => $inputs['author_education'][$i] ,
                'rate' => $inputs['author_rate'][$i] ,
                'group' => $inputs['group'][$i] ,
                'college' => $inputs['college'][$i] ,
                'university' => $inputs['university'][$i] ,
                'city' => $inputs['city'][$i] ,
                'country' => $inputs['country'][$i] ,
                'manager' => $inputs['author_manager_'.$i],
            );
            array_push($author ,$author_info);
        }
        try {
            $article_directory = $this->getDirName();
            $dir = $inputs['group_id'].'/'.$inputs['major_id'].'/'.$inputs['conference_id'].$inputs['volume_id'].'/'.$article_directory;
            $IOI = $inputs['group_id'].'.'.$inputs['major_id'].'.'.$inputs['conference_id'].'.'.$article_directory;
            ConferenceArticle::create([
                'conference_volume_id' => $inputs['volume_id'],
                'lang' => $inputs['lang'],
                'title' => $inputs['title'],
                'type' => $inputs['type'],
                'abstract' => $inputs['abstract'],
                'authors_info' => $author,

                'keywords' => $inputs['keywords'],
                'highlight' => $inputs['highlight'],
                'pageCount' => $inputs['page_count'],
                'page_from' => $inputs['page_from'],
                'page_to'=>$inputs['page_to'],

                'DOI' => $inputs['DOI'],
                'IOI' => $IOI,
                'struct' => $struct,
                'resource' => $resource,

                'receieved' => $inputs['receieved_date'],
                'accepted' =>  $inputs['accepted_date'],
                'press' =>  $inputs['press'],
                'price' =>  $inputs['price'],

                'dir' => $dir,

                'viewCount'=>0
            ]);
            $file_name = ConferenceArticle::count() + 1;
            $file = $request->file('upload');
            $directory = $inputs['group_id']."/".$inputs['major_id']."/".$inputs['volume_id']."/".$article_directory;
            $upload_files = public_path('upload/conferences/articles/'.$directory);
            if (!is_dir($upload_files)) {
                mkdir(public_path('upload/conferences/articles/'.$directory) , 0777, true);
            }
            $file->move($upload_files, $file_name.".".$file->getClientOriginalExtension());
            alert()->success("مقاله شما با موفقیت ثبت شد","ثبت شد")->autoclose(3500);
            return back();
        }catch (Exception $e){
            alert()->error("خطا در ثبت مقاله","خطا")->autoclose(2000);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConferenceArticle  $conferenceArticle
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference,ConferenceVolume $volume)
    {
        $articles = ConferenceArticle::where('conference_volume_id',$volume->id)->get();
        return view('admin.conferences.articles',compact('articles','volume','conference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConferenceArticle  $conferenceArticle
     * @return \Illuminate\Http\Response
     */
    public function edit(ConferenceArticle $article)
    {
        $authors = json_decode($article->authors_info);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->struct);
        $resource = json_decode($article->resource , true);
        try{
            $files = scandir(public_path().'/upload/conferences/articles/'.$article->files_directory) ;
        }catch (\Exception $e){
            return "Directory or files not exist";
        }
        $struct_counts = count($structs);
        $files = array_diff($files, array('.', '..')) ;
//        $resource = implode("#\r\n**********\r\n#",$resource);
        return view('admin.conferences.edit_article.edit',compact('article','authors','keywords','structs','resource','files','struct_counts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConferenceArticle  $conferenceArticle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConferenceArticle $article)
    {
        $assets = scandir(public_path(conference_article_path.'/'.$article->files_directory));
        $assets = array_diff($assets,['.','..']);
        if( empty($assets) ){
            $request->validate([
                'type' => 'required',
                'title' => 'required',
                'author_name.*' => 'required',
                'author_email.*' => 'required|email',
                'author_rate.*' => 'required',
                'author_dependency.*' => 'required',
                'abstract' => 'required',
                'keywords' => 'required',
                'highlight' => 'required',
                'page_count' => 'required|numeric',
                'page_from' => 'required|numeric',
                'page_to' => 'required|numeric',
                'DOI' => 'required',
                'resource' => 'required',
                'explode_resource' => 'required',
                'receieved_date' => 'required',
                'accepted_date' => 'required',
                'press' => 'required',
                'price' => 'required|numeric',
                'file' => 'required|max:5120',
            ]);
            $pdf_file = $request->file('file');
            $file_name=str_replace(' ','_',$pdf_file->getClientOriginalName());
            try{
                $pdf_file->move(public_path(conference_article_path.'/'.$article->files_directory) , $file_name.'.'.$pdf_file->getClientOriginalExtension() );
            }catch (\Exception $e){
                alert()->error("PDF Article can't update.","warning");
                return back();
            }
        }else{
            $request->validate([
                'type' => 'required',
                'title' => 'required',
                'author_name.*' => 'required',
                'author_email.*' => 'required|email',
                'author_rate.*' => 'required',
                'author_dependency.*' => 'required',
                'abstract' => 'required',
                'keywords' => 'required',
                'highlight' => 'required',
                'page_count' => 'required|numeric',
                'page_from' => 'required|numeric',
                'page_to' => 'required|numeric',
                'DOI' => 'required',
                'resource' => 'required',
                'explode_resource' => 'required',
                'receieved_date' => 'required',
                'accepted_date' => 'required',
                'press' => 'required',
                'price' => 'required|numeric',
            ]);
        }
        $inputs = $request->all();
        $resource_explode = explode("#\r\n**********\r\n#", $inputs['explode_resource']);
        $resource = array();
        foreach ($resource_explode as $val){
            array_push($resource , $val);
        }
        $resource = json_encode($resource) ;
        $author = array();
        for($i=0; $i< count( $inputs['author_name'] ) ; $i++){
            $author_info = array(
                'name' => $inputs['author_name'][$i] ,
                'email' => $inputs['author_email'][$i] ,
                'rate' => $inputs['author_rate'][$i] ,
                'dependency' => $inputs['author_dependency'][$i] ,
            );
            array_push($author ,$author_info);
        }
        $author =  json_encode($author);
        $struct = array();
        for($i=0; $i< count($inputs['struct_title']) ; $i++){
            if( isset( $inputs['sub_struct_'.($i+1)] ) ){
                $substr = array();
                for($j=0 ; $j<count($inputs['sub_struct_'.($i+1)]); $j++ ){
                    if($inputs['sub_struct_'.($i+1)][$j] == null){
                        continue;
                    }
                    array_push($substr ,$inputs['sub_struct_'.($i+1)][$j]);
                }
            }
            if(empty($substr)){
                array_push($struct , [
                    'str'=>$inputs['struct_title'][$i],
                ]);
            }else{
                array_push($struct , [
                    'str'=>$inputs['struct_title'][$i],
                    'substr'=>$substr
                ]);
                $substr = [];
            }
        }
        $struct =  json_encode($struct);
        try {
            $article->update([
                'type' => $inputs['type'] ,
                'title' => $inputs['title'],
                'abstract' => $inputs['abstract'],
                'authors_info' => $author,
                'highlight' => $inputs['highlight'],
                'keywords' => $inputs['keywords'],
                'struct' => $struct,
                'pageCount' => $inputs['page_count'],
                'page' => $inputs['page_from'].'-'.$inputs['page_to'],
                'resource' => $resource,
                'DOI' => $inputs['DOI'],
                'price' => $inputs['price'],
                'receieved' => $inputs['receieved_date'],
                'accepted' => $inputs['accepted_date'],
                'press' => $inputs['press'],
            ]);
            alert()->success("مقاله ". $article->id ." با موفقیت ویرایش شد","ویرایش شد")->autoclose(3000);
            return redirect()->back();
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConferenceArticle  $conferenceArticle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConferenceArticle $article)
    {
        if($this->delete_directory('/upload/conferences/articles/'.$article->files_directory) ){
            try {
                $article->delete();
                alert()->success("مقاله با موفقیت حذف شد","حذف شد")->autoclose(2000);
                return back();
            } catch (\Exception $e) {
                alert()->error("خطا در حذف مقاله","خطا")->autoclose(2000);
                return back();
            }
        }
    }


    // active article (save authors and send email to authors) => post
    public function active($conferenceId , $articleId){
        $conference =  Conference::where('_id',$conferenceId)->first();
        $article = ConferenceArticle::where('_id',$articleId)->first();

        $id = $article->id;
        $title = $article->title;

        $authors_info = $article->authors_info;
        $authors_info = json_decode($authors_info);

        foreach ($authors_info as $author){
            $authors[] = $author->email;
        }

        if($article->saved_authors == 0){
            event(new ArticleActive($authors_info));
            $article->update([
                'saved_authors' => 1
            ]);
            //event(new ArticleSubmit($authors,$id,$title)); //todo send email to authors
        }

        if($conference->active == "1"){
            if($article->active == "0"){
                $article->update(['active'=>"1"]);
                return response()->json(['message'=>'success_active' , 'target'=>'success']);
            }else{
                $article->update(['active'=>"0"]);
                return response()->json(['message'=>'success_deactive' , 'target'=>'danger']);
            }
        }else{
            return response()->json(['message'=>'fail']);
        }
    }


    // remove file that uploaded => post
    public function removeFile(Request $request){
        if( unlink(public_path($request->input('fileUrl'))) ){
            return response()->json([
                'message' => 'success'
            ]);
        }else{
            return response()->json([
                'message' => 'success'
            ]);
        }
    }

    // get article used in ajax => post
    public function get(ConferenceArticle $conferenceArticle){
        return $conferenceArticle;
    }

//    // get all articles from a conference
//    public function conferenceArticles(ConferenceVolume $volume){
//        $volume = $volume->with('articles')->first();
//        return $volume;
//        return view('admin/conferences/articles',compact('volume'));
//    }
}
