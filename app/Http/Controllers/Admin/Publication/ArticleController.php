<?php

namespace App\Http\Controllers\Admin\Publication;

use App\Article;
use App\Events\ArticleActive;
use App\Group;
use App\Issue;
use App\Major;
use App\Publication;
use App\Volume;
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
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group,Major $major,Publication $publication ,Volume $volume , Issue $issue)
    {
        return view('admin.publications.new_article.article', compact('group','major','publication','volume','issue'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'publisher_id' => 'required',
            'group_id' => 'required',
            'major_id' => 'required',

            'volume_id'=>'required',
            'issue_id'=>'required',

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
            'publish_year' => 'required',

            'price' => 'required|numeric',

            'page_count' => 'required|numeric',
            'page_from' => 'required|numeric',
            'page_to' => 'required|numeric',

            'press' => 'required',
            'upload' => 'required|max:5120',
        ]);

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
        $author =  json_encode($author);

        $article_directory = $this->getDirName();
        $dir = $inputs['group_id'].'/'.$inputs['major_id'].'/'.$inputs['publisher_id'].'/'.$inputs['volume_id'].'/'.$inputs['issue_id'].'/'.$article_directory;
        $IOI = $inputs['group_id'].'.'.$inputs['major_id'].'.'.$inputs['publisher_id'].'.'.$article_directory;

        $file = $request->file('upload');
        $file_ext = $file->getClientOriginalExtension();
        $upload_files = public_path(publication_article_path.'/'.$dir);
        if (!is_dir($upload_files)) {
            mkdir(public_path(publication_article_path.'/'.$dir) , 0777, true);
        }
        $file->move($upload_files, 'article'.".".$file_ext);
        try {
            Article::create([
                'issue_id' => $inputs['issue_id'],
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
                'publish_year' =>  $inputs['publish_year'],

                'press' =>  $inputs['press'],
                'price' =>  $inputs['price'],

                'dir' => $dir,
                'viewCount'=>0
            ]);
            alert()->success("مقاله با موفقیت ثبت شد","")->autoclose(2000);
            return redirect()->to( route('admin.publications')  );
        }catch (Exception $e){
            alert()->warning("خطا در ثبت مقاله","اخطار")->autoclose(2000);
            return redirect()->to( route('admin.publications')  );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $authors = json_decode($article->authors_info);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->struct);
        $resource = json_decode($article->resource , true);
        try {
            $files = scandir(public_path('upload/publications/articles/'. $article->files_directory));
        }catch (\Exception $e){
            return "Directory or files not exist";
        }
        $struct_counts = count($structs);
        $files = array_diff($files, array('.', '..')) ;
        return view('admin.publications.edit_article.edit',compact('article','authors','keywords','structs','resource','files','struct_counts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $assets = scandir(public_path(publication_article_path.'/'.$article->files_directory));
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
                $pdf_file->move(public_path(publication_article_path.'/'.$article->files_directory) , $file_name.'.'.$pdf_file->getClientOriginalExtension());
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
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if($this->remove_directory('/upload/publications/articles/'.$article->files_directory)){
            try {
                $article->delete();
                alert()->success("مقاله با موفقیت حذف شد","حذف شد")->autoclose(2000);
                return back();
            } catch (\Exception $e) {
                alert()->error("خطا در حذف مقاله","خطا")->autoclose(2000);
                return back();
            }
        }else{
            alert()->error("خطا در حذف دایرکتوری مقاله","خطا")->autoclose(2000);
        }
    }

    // remove file of publication article
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

    // used ajax to get an article from issue => post
    public function get(Article $article){
        return $article;
    }

    // active deactive article (send email to authors of article and save information of each authors in author table) => post
    public function active($publicationId , $articleId){
        $publication =  Publication::where('_id',$publicationId)->first();
        $article = Article::where('_id',$articleId)->first();
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


        if($publication->active == 1){
            if($article->active == 0){
                $article->update(['active'=>1]);
                return response()->json(['message'=>'success_active' , 'target'=>'success']);
            }else{
                $article->update(['active'=>0]);
                return response()->json(['message'=>'success_deactive' , 'target'=>'danger']);
            }
        }else{
            return response()->json(['message'=>'fail']);
        }
    }

    // used ajax to get issues of volume => post
    public function issue(Issue $issue){
        $articles = Article::where('issue_id' , $issue->id)->get();
        return $articles;
    }

    // remove directory if it exist file or files
    private function remove_directory($dir) {
        $lastdir = scandir(public_path($dir));
        try{
            $lastdir= array_diff($lastdir,['.','..']);
            foreach ($lastdir as $folder){
                $article_dir = $folder;
                $files = scandir(public_path($dir."/".$folder));
                $files= array_diff($files,['.','..']);
                foreach ($files as $file){
                    unlink(public_path($dir."/".$folder."/".$file));
                }
            }
            rmdir(public_path($dir . "/" . $article_dir));
            return true;
        }catch (\Exception $e){
            return $e->getMessage();
        }

    }

    public function deletePdf(Request $request){
        if(file_exists(public_path($request->input('path')))) {
            if (unlink(public_path($request->input('path')))) {
                return response()->json([
                    'message' => 'success'
                ]);
            } else {
                return response()->json([
                    'message' => 'fail'
                ]);
            }
        }else{
            return response()->json([
                'message' => 'file_not_exist'
            ]);
        }
    }
}
