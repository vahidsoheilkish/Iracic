<?php

namespace App\Http\Controllers\Publication;

use App\Issue;
use App\Publication;
use App\PublicationNotification;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationController extends Controller
{
    // publication user dashboard
    public function dashboard(){
        $publication_user = session()->get('publication_user');
        $publication = Publication::where('publication_user_id' , $publication_user->id)->first();

        if($publication){
            switch ($publication->lang){
                case 'en':
                    if($publication->publish_order == "month" ){
                        $period = Setting::where('key', 'en_month')->first();
                    }elseif($publication->publish_order == "season" ){
                        $period = Setting::where('key', 'en_season')->first();
                    }else{
                        $period = Setting::where('key', 'en_half_year')->first();
                    }
                    $current_year = date("Y");
                    break;
                case 'fa':
                    if($publication->publish_order == "month" ){
                        $period = Setting::where('key', 'fa_month')->first();
                    }elseif($publication->publish_order == "season" ){
                        $period = Setting::where('key', 'fa_season')->first();
                    }else{
                        $period = Setting::where('key', 'fa_half_year')->first();
                    }
                    $current_year = \Morilog\Jalali\Jalalian::now()->getYear();
                    break;
            }
        }
        return view('publication/en/dashboard/index' ,compact('publication_user','publication','period','current_year'));
    }

    // user publication logout
    public function logout(){
        session()->forget('publication_user');
        return redirect()->to( route('publication.index')  );
    }

    // form of publication submit
    public function create(){
        return view('publication/en/dashboard/create');
    }

    // publication submit just one publication and save in publication table (post method)
    public function store(Request $request){
        App::setLocale('en');
        $request->validate([
            'captcha' => 'required|captcha',
            'group_id' => 'required' ,
            'major_id' => 'required' ,
            'lang' => 'required' ,
            'title' => 'required' ,
            'publish_order' => 'required' ,
            'first_publish_year' => 'required' ,
            'website' => 'required' ,
            'publication_type' => 'required'
        ],[]);
        try {
            $inputs = $request->all();
            $publication_user_id = session()->get('publication_user');
            $title = [
                't1' =>$inputs['title'],
                't2' => '',
            ];
            $this_publication = Publication::create([
                'group_id' => $inputs['group_id'],
                'major_id' => $inputs['major_id'],
                'publication_user_id' => $publication_user_id->id,
                'lang' => $inputs['lang'],
                'title' => json_encode($title) ,
                'publication_type' => $inputs['publication_type'],
                'publish_order' => $inputs['publish_order'],
                'first_publish_year' => $inputs['first_publish_year'],
                'slug' => str_replace(' ', '-', $inputs['title']),
                'iracic_code' => 'no iracic code',
                'active'=>'0'
            ]);

            $unique_publication_dir = publication_assets_path."/".$this_publication->id;
            if(!is_dir(public_path($unique_publication_dir))){
                mkdir(public_path($unique_publication_dir) , 0777, true);
            }

            $count = Publication::where(['group_id'=> $inputs['group_id'] , 'major_id'=>$inputs['major_id'] ])->count();
            $count+=1;
            switch ($inputs['lang']){
                case 'en': $lang_code = 1; break;
                case 'fa': $lang_code = 2; break;
                case 'ar': $lang_code = 3; break;
            }
            $abbreviation ='';
            $abbr = $inputs['title'];
            $abbr = explode(' ',$abbr);
            foreach ($abbr as $item){
                $abbreviation.=$item[0];
            }
            $iracic_code = $inputs['group_id'].'-'.$inputs['major_id'].'-'.$count.'-'.$lang_code.'-'.$abbreviation;
            $this_publication->update([ 'iracic_code'=>$iracic_code , 'dir'=>$this_publication->id]);
            alert()->success("Publication submit successfully","success")->autoclose(3500);
            return redirect()->to( route('publication.dashboard')  );
        } catch (\Exception $e){
            alert()->error("Your publication had submitted before.","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard')  );
        }
    }

    public function notifications(){
        $publication_user = session()->get('publication_user');
        $notifications = PublicationNotification::where('publication_user_id',$publication_user->id)->orderBy('id','DESC')->paginate();
        return view('publication.en.dashboard.notification',compact('notifications'));
    }

    public function changeNotificationSeen(Request $request){
        $id = $request->input('id');
        $notification = PublicationNotification::where('_id',$id)->first();
        if($notification->seen == "1"){
            $notification->update([
                'seen'=>"0"
            ]);
            return response()->json([
                'message'=>'fail'
            ]);
        }else{
            $notification->update([
                'seen'=>"1"
            ]);
            return response()->json([
                'message'=>'success'
            ]);
        }
    }


    // get all majors from a group
    public function majorsGroup($group_id){
        return \App\Major::where('group_id', $group_id)->get();
    }

    // get all issue from a volume
    public function issuesVolume($volume_id){
        return Issue::where('volume_id' , $volume_id)->get();
    }


    public function changePasswordForm(){
        return view('publication/en/dashboard/change_password');
    }

    public function changePassword(Request $request){
        App::setLocale('en');
        $request->validate([
            'captcha' => 'required|captcha',
            'old_password'=>'required' ,
            'password'=>'required|min:6' ,
            'password2'=>'required|min:6|same:password' ,
        ],[

        ]);
        $data = $request->all();
        $user= session()->get('publication_user');
        if($user->password === md5($data['old_password'] )) {
            if($data['password'] === $data['password2'] ){
                $user->update([
                    'password'=>md5($data['password'])
                ]);
                alert()->success("Password changed successfully","");
                return back();
            }else{
                alert()->error("Confirm password are'nt match" , "warning");
                return back();
            }
        }else{
            alert()->error("Incorrect old password" , "warning");
            return back();
        }
    }

    public function tree(){
        $publication_user = session()->get('publication_user');
        $publication = Publication::where('publication_user_id',$publication_user->id)->with('volumes.issues.articles')->first();
        if( empty($publication) ){
            alert()->error("You did'nt submit your jorunal.","warning")->autoclose(3500);
            return back();
        }
        return view('publication.en.dashboard.tree',compact('publication'));
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






/*
        public function articleUploadFile(Request $request){
            $validation = Validator::make($request->all() , [
                'file' => 'required|max:5120',
            ]);
            if($validation->passes()){
                $file = $request->file('file');
                $file_ext = $file->getClientOriginalExtension();
                $file_type = $request->input('file_type');
                $inputs= $request->all();
                $article_directory = $this->getDirName();
                $directory = $inputs['group']."/".$inputs['major']."/".$inputs['publisher']."/".$inputs['volume']."/".$inputs['issue']."/".$article_directory;
                Cookie:Cookie::queue(Cookie::make('user_publication_uploaded', $directory , 10 ));
                //session(['user_publication_uploaded' => ['res'=>'no','dir'=>$directory] ]);
                $upload_files = public_path().'/upload/publications/articles/'.$directory;
                $file_name = "";
                if (!is_dir($upload_files)) {
                    mkdir(public_path('/upload/publications/articles/'.$directory) , 0777, true);
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