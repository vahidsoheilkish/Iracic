<?php

namespace App\Http\Controllers\ConferenceNotification;

use App\Conference;
use App\ConferenceArticle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Conference $conference)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Conference $conference)
    {
        $conference_user = session()->get('conference_user_notice');
        if(!$conference_user){
            alert()->error("Error, please login again","warning");
            return redirect()->to( route('conference.notice.dashboard')  );
        }
        if($conference->active == 1){
            return view('conference/en/panel/article', compact('conference_user','conference'));
        }else{
            alert()->error("Error, your conference not submit","warning");
            return redirect()->to( route('conference.notice.dashboard')  );
        }
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
            'conference_id' => 'required',
            'title' => 'required',
            'type' => 'required',
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
                'email' => $inputs['author_email'][$i] ,
                'rate' => $inputs['author_rate'][$i] ,
                'dependency' => $inputs['author_dependency'][$i] ,
            );
            array_push($author ,$author_info);
        }
        $author_info = json_encode($author);
        try {
            $article_directory = $this->getDirName();
            $dir = $inputs['group_id'].'/'.$inputs['major_id'].'/'.$inputs['conference_id']."/".$article_directory;
            $IOI = $inputs['group_id'].'.'.$inputs['major_id'].'.'.$inputs['conference_id'].'.'.$article_directory;;
            ConferenceArticle::create([
                'type' => $inputs['type'],
                'conference_id' => $inputs['conference_id'],
                'abstract' => $inputs['abstract'],
                'authors_info' => $author_info,
                'keywords' => $inputs['keywords'],
                'highlight' => $inputs['highlight'],
                'pageCount' => $inputs['page_count'],
                'page' => $inputs['page_from'].'-'.$inputs['page_to'],
                'DOI' => $inputs['DOI'],
                'IOI' => $IOI,
                'title' => $inputs['title'],
                'struct' => $struct,
                'resource' => $resource,
                'files_directory' => $dir,
                'receieved' => $inputs['receieved_date'],
                'accepted' =>$inputs['accepted_date'],
                'price' => $inputs['price'],
            ]);
            $file_name = ConferenceArticle::count() + 1;
            $file = $request->file('upload');
            $directory = $inputs['group_id']."/".$inputs['major_id']."/".$inputs['conference_id']."/".$article_directory;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {
        $articles = ConferenceArticle::where('conference_id',$conference->id)->get();
        return view('conference.en.panel.conference_articles',compact('conference','articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ConferenceArticle $article)
    {
        $authors = json_decode($article->authors_info);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->struct);
        $resource = json_decode($article->resource , true);
        try {
            $files = scandir(public_path( conference_article_path. '/' . $article->files_directory));
        }catch (\Exception $e){
            return "Directory or files not exist";
        }
        $struct_counts = count($structs);
        $files = array_diff($files, array('.', '..')) ;
        return view('conference.en.panel.edit_article',compact('article','authors','keywords','structs','resource','struct_counts','files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConferenceArticle $article)
    {
        App::setLocale('en');
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
            $filename= str_replace(' ','_',$pdf_file->getClientOriginalName());
            try{
                $pdf_file->move(public_path(conference_article_path.'/'.$article->files_directory) , $filename.",".$pdf_file->getClientOriginalExtension());
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
