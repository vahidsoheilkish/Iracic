<?php

namespace App\Http\Controllers\Admin;

use App\ConferenceArticle;
use App\ConferenceNotification;
use App\Events\ArticleActive;
use App\Events\ArticleSubmit;
use App\Group;
use App\Major;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Conference;
use App\ConferenceUser;
use App\ConferenceVolume;
use App\Issue;
use App\Publication;
use App\PublicationUser;
use App\Volume;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\Jalalian;

class ConferenceController extends Controller
{

    /*
    // upload article file => post
    public function articleUploadFile(Request $request){
        $validation = Validator::make($request->all() , [
            'file' => 'required|max:5120',
        ]);
        if($validation->passes()){
            $file = $request->file('file');
            $file_ext = $file->getClientOriginalExtension();
            $directory_info = session()->get('conf_admin_dirInfo');
            if($request->session()->has('conf_admin_dir')){
                $session = session()->get('conf_admin_dir');
                $directory = $session['group_id'].'/'.$session['major_id'].'/'.$session['conference_user'].'/'.$session['volume_id'];
            }else{
                $directory = $this->getDirName($directory_info['group_id'],$directory_info['major_id'],$directory_info['conference_user'],$directory_info['volume_id']);
            }
            $file_type = $request->input('file_type');
            $upload_files = public_path().'/upload/conferences/articles/'.$directory;
            $file_name = "";
            if (!is_dir($upload_files)) {
                mkdir(public_path('upload/conferences/articles/'.$directory) , 0777, true);
            }
            if(file_exists($upload_files."/".$file_type."1")){
                $file_name = $file_type."1";
            }else{
                $directory  = $upload_files;
                $scan = scandir($directory , SCANDIR_SORT_DESCENDING );
                $scan = $this->explodeExtension($scan);
                for($i=0;$i<count($scan);$i++){
                    $file_name=$file_type.($i+1);
                    if(!in_array($file_name , $scan)){
                        $file_name = $file_type.($i+1);
                        break;
                    }
                }
            }
            $file->move($upload_files, $file_name.".".$file_ext);
            return response()->json([
                'message' => 'success' ,
                'file_url' => $upload_files.'/'.$file_name ,
                'file_name' => $file_name.".".$file_ext,
                'file_ext' => $file->getClientOriginalExtension() ,
                'class_name' => '' ,
            ]);
        }else{
            return response()->json([
                'message' => 'fail',
                'errors' =>  $validation->errors()->all() ,
                'uploaded_image' => '' ,
                'class_name' => '' ,
            ]);
        }
    }

    // article upload file in update => post
    public function articleUploadFileUpdate(Request $request){
        $validation = Validator::make($request->all() , [
            'file' => 'required',
            'file_type' => 'required',
        ]);
        if($validation->passes()){
            $file = $request->file('file');
            $file_ext = $file->getClientOriginalExtension();
            $directory = $request->input('dir');
            $file_type = $request->input('file_type');
            $upload_files = public_path().'/upload/conferences/articles/'.$directory;
            $file_name = "";
            if (!is_dir($upload_files)) {
                mkdir(public_path('upload/conferences/articles/'.$directory) , 0777, true);
            }
            if(file_exists($upload_files."/".$file_type."1")){
                $file_name = $file_type."1";
            }else{
                $directory  = $upload_files;
                $scan = scandir($directory , SCANDIR_SORT_DESCENDING );
                $scan = $this->explodeExtension($scan);
                for($i=0;$i<count($scan);$i++){
                    $file_name=$file_type.($i+1);
                    if(!in_array($file_name , $scan)){
                        $file_name = $file_type.($i+1);
                        break;
                    }
                }
            }
            $file->move($upload_files, $file_name.".".$file_ext);
            return response()->json([
                'message' => 'success' ,
                'file_url' => $upload_files.'/'.$file_name ,
                'file_name' => $file_name.".".$file_ext,
                'file_ext' => $file->getClientOriginalExtension() ,
                'class_name' => '' ,
            ]);
        }else{
            return response()->json([
                'message' => 'fail',
                'errors' =>  $validation->errors()->all() ,
                'uploaded_image' => '' ,
                'class_name' => '' ,
            ]);
        }
    }
    */






    // get volume articles used in ajax => post
    public function VolumeArticles(ConferenceVolume $volume){
        $articles = ConferenceArticle::with('volume.conference')->where('conference_volume_id',$volume->id)->get();
        return view('admin.conferences.articles',compact('articles'));
    }

    // set a session to make unique directory of an articles => post
//    public function setDirSession(Request $request){
//        $inputs = $request->all();
//        session(
//            ['conf_admin_dirInfo'=>
//                [
//                    'conference_user' => $inputs['conference_user'],
//                    'group_id' => $inputs['group_id'],
//                    'major_id' => $inputs['major_id'],
//                    'volume_id' => $inputs['volume_id'],
//                ]
//            ]);
//        return response()->json([
//            'message'=>'success'
//        ]);
//    }





    // make directory upon conference
    public function getDirName(){
        $time = Carbon::now()->getTimestamp();
        $time = $time . md5($time);
        return $time;
    }

    // remove directory if it exist file or files
    public function delete_directory($dirname) {
        $dirname = public_path().$dirname;
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
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




    public function addConference(){
        return view('admin.conferences.add');
    }

}
