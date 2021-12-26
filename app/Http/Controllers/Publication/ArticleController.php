<?php

namespace App\Http\Controllers\Publication;

use App\Article;
use App\Publication;
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
    public function create()
    {
        $publisher_user = session()->get('publication_user');
        $publication = Publication::where('publication_user_id',$publisher_user->id)->first() ;

        if(empty($publication)){
            alert()->error("Please first submit your journal","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard')  );
        }

        if(isset($publication->volumes)) {
            foreach ($publication->volumes as $volume) {
                $check_issues[] = $volume->issues;
            }
        }

        $count = 0;
        if( isset($check_issues)) {
            foreach ($check_issues as $issue) {
                if (!isset($issue->id)) {
                    $count += 1;
                }
            }
        }

        if( empty($check_issues) ){
            alert()->error("Please first submit volume or issue","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard')  );
        }

        if(!$publisher_user){
            return redirect()->to( route('publication.dashboard')  );
        }

        if($this->checkPublicationActive($publication->id)){
            return view('publication/en/article',compact('publisher_user','publication'));
        }else{
            return redirect()->to( route('publication.dashboard')  );
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
            'type' => 'required',
            'publisher_id' => 'required',
            'volume_id' => 'required',
            'issue_id' => 'required',
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
                'email' => $inputs['author_email'][$i] ,
                'rate' => $inputs['author_rate'][$i] ,
                'dependency' => $inputs['author_dependency'][$i] ,
            );
            array_push($author ,$author_info);
        }
        $author = json_encode($author);
        try {
            $article_directory = $this->getDirName();
            $dir = $inputs['group_id']."/".$inputs['major_id']."/".$inputs['publisher_id']."/".$inputs['volume_id']."/".$inputs['issue_id']."/".$article_directory;
            $IOI = $inputs['group_id']."-".$inputs['major_id']."-".$inputs['publisher_id']."-".$inputs['volume_id']."-".$inputs['issue_id'].'-'.$article_directory;
            Article::create([
                'type' => $inputs['type'],
                'issue_id' => $inputs['issue_id'],
                'abstract' => $inputs['abstract'],
                'authors_info' => $author,
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
                'accepted' => $inputs['accepted_date'],
                'price' => $inputs['price'],
                'active' => '0'
            ]);
            $file_name = Article::count() + 1;
            $file = $request->file('upload');
            $directory = $inputs['group_id']."/".$inputs['major_id']."/".$inputs['publisher_id']."/".$inputs['volume_id']."/".$inputs['issue_id']."/".$article_directory;
            $upload_files = public_path().'/upload/publications/articles/'.$directory;
            if (!is_dir($upload_files)) {
                mkdir(public_path('/upload/publications/articles/'.$directory) , 0777, true);
            }
            $file->move($upload_files, $file_name.'.'.$file->getClientOriginalExtension());
            alert()->success("Your article index successfully","done")->autoclose(3500);
            return redirect()->to( route('publication.dashboard')  );
        }catch (Exception $e){
            alert()->error("Error in index article","warning")->autoclose(2000);
            return redirect()->to( route('publication.dashboard')  );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $authors = json_decode($article->authors_info);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->struct);
        $resource = json_decode($article->resource , true);
        try {
            $files = scandir(public_path( publication_article_path. '/' . $article->files_directory));
        }catch (\Exception $e){
            return "Directory or files not exist";
        }
        $struct_counts = count($structs);
        $files = array_diff($files, array('.', '..')) ;
        return view('publication.en.dashboard.edit_article',compact('article','authors','keywords','structs','resource','struct_counts','files'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        App::setLocale('en');
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
            $filename= str_replace(' ','_',$pdf_file->getClientOriginalName());
            try{
                $pdf_file->move(public_path(publication_article_path.'/'.$article->files_directory) , $filename.",".$pdf_file->getClientOriginalExtension());
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
            alert()->success("Article with id : ". $article->id ." successfully update","done")->autoclose(3000);
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
