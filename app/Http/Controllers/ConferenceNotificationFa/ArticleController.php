<?php

namespace App\Http\Controllers\ConferenceNotificationFa;

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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Conference $conference
     * @return \Illuminate\Http\Response
     */
    public function create($group,$major,Conference $conference,$volume)
    {
        $conference_user = session()->get('conference_user_notice');
        if(!$conference_user){
            alert()->error("Error, please login again","warning");
            return redirect()->to( route('conference.notice.dashboard.fa')  );
        }
        if($conference->active == 1){
            return view('conference/fa/panel/article', compact('group','major','conference_user','conference','volume'));
        }else{
            alert()->warning("کنفرانس شما هنوز تایید نشده است","خطا");
            return redirect()->to( route('conference.notice.volumes.list.fa')  );
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
        //return $request->all();
        $request->validate([
            'conference_id' => 'required',
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
        $dir = $inputs['group_id'].'/'.$inputs['major_id'].'/'.$inputs['conference_id'].$inputs['volume_id'].'/'.$article_directory;
        $IOI = $inputs['group_id'].'.'.$inputs['major_id'].'.'.$inputs['conference_id'].'.'.$article_directory;
        try {
            ConferenceArticle::create([
                'volume_id' => $inputs['volume_id'],
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
            $file = $request->file('upload');
            $file_ext = $file->getClientOriginalExtension();
            $upload_files = public_path(conference_article_path.'/'.$dir);
            if (!is_dir($upload_files)) {
                mkdir(public_path(conference_article_path.'/'.$dir) , 0777, true);
            }
            $file->move($upload_files, 'article'.".".$file_ext);
            alert()->success("مقاله با موفقیت ثبت شد","")->autoclose(2000);
            return redirect()->to( route('conference.notice.conferences.list.fa')  );
        }catch (Exception $e){
            alert()->error("خطا در ثبت مقاله","error")->autoclose(2000);
            return redirect()->to( route('conference.notice.conferences.list.fa')  );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ConferenceArticle $conference
     * @return \Illuminate\Http\Response
     */
    public function show(ConferenceArticle $conference)
    {
        $articles = ConferenceArticle::where('conference_id',$conference->id)->get();
        return view('conference.fa.panel.conference_articles',compact('conference','articles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ConferenceArticle $article
     * @return string
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
        return view('conference.fa.panel.edit_article',compact('article','authors','keywords','structs','resource','struct_counts','files'));
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
        App::setLocale('fa');
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
            try{
                $pdf_file->move(public_path(conference_article_path.'/'.$article->files_directory) , $pdf_file->getClientOriginalName());
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
