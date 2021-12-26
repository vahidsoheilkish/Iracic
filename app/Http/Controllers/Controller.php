<?php

namespace App\Http\Controllers;

use App\Article;
use App\Publication;
use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function findPdfFile($path){
        $path = array_diff($path , ['.','..']);
        foreach ($path as $item){
            $ex = explode('.',$item);
            if($ex[1] == "pdf"){
                return $item;
            }
        }
    }

    protected function normal_text($string){
        $unwanted_punc = ['"',"'",'=','@','&','%','.',',',':','\\','$','^','!','?','{','}',';','\n','\t','(',')','[',']','/','*','+','#','\u200c','\ufeff','-','_','|','<html>','</html>','<p>','</p>','<table>','</table>','<body>','</body>','<div>','</div>','<a>','</a>','<span>','</span>','<ul>','</ul>','<','>'];
        foreach ( $unwanted_punc as $punc){
            $string = str_replace($punc, "" , $string);
        }
        return $string;
    }

    protected function match($resource , $title ){
        $regex = explode(" ",$title);
        $regex = implode('.*',$regex);
        if(preg_match("/".$regex."/",$resource)){
            return true;
        }
        return false;
    }

    protected function pdf(Article $article){
        $authors = json_decode($article->authors_info);
        $abstract = json_decode($article->abstract);
        $keywords = explode(';' , $article->keywords);
        $structs = json_decode($article->structure);
        $resource = json_decode($article->resource , true);

        if(!is_dir(resource_path('views/pdf'))){
            mkdir(resource_path('views/pdf') , 0777, true);
        }

        $articlePdf = fopen( resource_path( 'views/pdf/article_' . $article->id . '.blade.php' ), 'w' );
        $content = view('document',compact('article','authors','abstract','keywords','structs','resource'));
        $pdf_file_name =  str_replace(' ','-',$article->title);
        fwrite($articlePdf , $content);
        $data = ['foo' => 'bar'];
        $pdf = PDF::loadView('pdf/article_'.$article->id, $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        $file = $pdf->stream($pdf_file_name.'_'.$article->id.'.pdf');
        fclose($articlePdf);

        if(file_exists(resource_path( 'views/pdf/article_' . $article->id . '.blade.php'))){
            unlink(resource_path( 'views/pdf/article_' . $article->id . '.blade.php'));
        }
        return $file;
    }



    // delete image of contains blog file
    protected function delete_directory($dirname) {
        $dir_handle = opendir($dirname);
        while($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                    unlink($dirname."/".$file);
                else
                    $this->delete_directory($dirname.'/'.$file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    protected function checkPublicationActive($publication){
        $pub = Publication::where('_id',$publication)->first();
        if($pub->active == "0"){
            alert()->error("Your journal did'nt submit or active","warning")->autoclose(3500);
            return false;
        }elseif($pub->active =="2" ){
            alert()->error("You can't submit article","warnings")->autoclose(3500);
            return false;
        }
        return true;
    }

    protected function checkField($field){
        if(isset($field)){
            return $field;
        }
        return "";
    }

    protected function delete_similar_name($path){
        $assets = glob(public_path($path));
        $assets = array_diff($assets,['.','..']);
        foreach($assets as $file){
            unlink($file);
        }
    }

    // make directory upon conference
    protected function getDirName(){
        return uniqid();
    }

    private function reverseNumber($num){
        $revnum = 0;
        while ($num > 1)
        {
            $rem = $num % 10;
            $revnum = ($revnum * 10) + $rem;
            $num = ($num / 10);
        }
        return $revnum;
    }

    private function explodeExtension($target){
        $val = [];
        for($i=0;$i<count($target);$i++){
            $tmp = explode('.',$target[$i]);
            array_push($val , $tmp[0]);
        }
        return $val;
    }


}
