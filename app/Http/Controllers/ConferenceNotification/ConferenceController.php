<?php

namespace App\Http\Controllers\ConferenceNotification;

use App\Cities;
use App\Conference;
use App\ConferenceArticle;
use App\ConferenceNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferenceController extends Controller
{
    public function dashboard(){
        return view('conference/en/panel/dashboard' );
    }

    public function logout(){
        session()->forget("conference_user_notice");
        return redirect()->to(route('conference.notice'));
    }

    public function create(){
        return view('conference/en/panel/create',compact(''));
    }

    public function store(Request $request){
        App::setLocale('en');
        $request->validate([
            'lang' => 'required' ,
            'group_id' => 'required' ,
            'major_id' => 'required' ,
            'title' => 'required' ,
            'subject' => 'required' ,
            'country' => 'required' ,
            'conference_publisher' => 'required' ,
            'ISBN' => 'required' ,
            'printISSN' => 'required' ,
            'onlineISSN' => 'required' ,
            'level' => 'required' ,
            'access' => 'required' ,
            'type' => 'required' ,
            'DOI' => 'required' ,
        ],[]);
        $conference_user = session()->get('conference_user_notice');
        $inputs = $request->all();

        try{
            $conference = Conference::create([
                'conference_user_id' => $conference_user->_id,
                'lang' => $inputs['lang'] ,
                'group_id' => $inputs['group_id'] ,
                'major_id' => $inputs['major_id'] ,
                'title' => $inputs['title'] ,
                'slug' => str_replace('','-',$inputs['title']) ,
                'subject' => $inputs['subject'] ,
                'country' => $inputs['country'] ,
                'conference_publisher' => $inputs['conference_publisher'] ,
                'ISBN' => $inputs['ISBN'] ,
                'printISSN' => $inputs['printISSN'] ,
                'onlineISSN' => $inputs['onlineISSN'] ,
                'level' => $inputs['level'] ,
                'access' => $inputs['access'] ,
                'type' => $inputs['type'] ,
                'DOI' => $inputs['DOI'] ,
            ]);
            $dir_code = $conference->_id;
            if(!is_dir(public_path(conference_assets_path."/".$dir_code) )){
                mkdir( public_path(conference_assets_path."/".$dir_code) , 0777);
            }
            $conference->update([
                'dir'=>$dir_code
            ]);
            alert()->success("Conference has been successfully submit");
            return back();
        }catch (\Exception $exception){
            alert()->error("Sorry, there is a problem to submit conference" , "warning");
            return back();
        }
    }

    public function conferencesList(){
        $user = session()->get('conference_user_notice');
        $conferences_noactive=Conference::where(['conference_user_id'=>$user->_id,'active'=>'0'])->orderBy('active','DESC')->get();
        $conferences_active=Conference::where(['conference_user_id'=>$user->_id,'active'=>'1'])->orderBy('active','DESC')->get();
        return view('conference.en.panel.list',compact('conferences_noactive','conferences_active') );
    }


    public function notifications(){
        $conference_user = session()->get('conference_user_notice');
        $notifications = ConferenceNotification::where('conference_user_id',$conference_user->id)->orderBy('id','DESC')->paginate();
        return view('conference.en.panel.notification',compact('notifications'));
    }

    public function edit(Conference $conference){
        return view('conference.en.panel.edit_conference',compact('conference'));
    }

    public function changeNotificationSeen(Request $request){
        $id = $request->input('id');
        $notification = ConferenceNotification::where('_id',$id)->first();
        if($notification->seen == 1){
            $notification->update([
                'seen'=>0
            ]);
            return response()->json([
                'message'=>'success'
            ]);
        }else{
            $notification->update([
                'seen'=>1
            ]);
            return response()->json([
                'message'=>'fail'
            ]);
        }
    }

    public function update(Conference $conference,Request $request){
        App::setLocale('en');
        $request->validate([
            'lang' => 'required' ,
            'group_id' => 'required' ,
            'major_id' => 'required' ,
            'title' => 'required' ,
            'start_date' => 'required' ,
            'end_date' => 'required' ,
            'university' => 'required' ,
            'chief' => 'required' ,
            'conferenceSecretary' => 'required' ,
            'conferencePresidency' => 'required' ,
            'scientificSecretary' => 'required' ,
            'executiveSecretary' => 'required' ,
        ],[]);

        $conference_user = session()->get('conference_user_notice');
        $inputs = $request->all();

        $start_date = $inputs['start_date'];
        $start_date = strtotime($start_date);
        $year = date('Y', $start_date);

        $file = $request->file('poster');
        if($file != null) {
            $request->validate([
                'poster' => 'required|mimes:jpeg,jpg,png' ,
            ]);
            $upload_res = $this->uploadPoster($file,'update',$conference->dir);
            $upload_res = $upload_res['file'];
        }else{
            $upload_res = $conference->poster;
        }
        $letter = $request->file('letter');
        if($letter !=null){
            $request->validate([
                'letter' => 'required|mimes:pdf' ,
            ]);
            $letter->move( public_path(conference_assets_path.'/'.$conference->dir) , 'letter'.'.'.$letter->getClientOriginalExtension() );
        }
        try{
            $conference->update([
                'lang' => $inputs['lang'] ,
                'group_id' => $inputs['group_id'],
                'major_id' =>  $inputs['major_id'],
                'conference_user_id' => $conference_user->id ,
                'title' => json_encode(['l1'=>$inputs['title'], 'l2'=>'']) ,
                'conference_subjects' => json_encode(['l1'=>'', 'l2'=>'']) ,
                'description' => json_encode(['l1'=>'', 'l2'=>'']) ,
                'slug' => str_replace(' ', '-',$inputs['title']) ,
                'startDate' =>  strtotime( $inputs['start_date'] ),
                'endDate' =>  strtotime( $inputs['end_date'] ),
                'organizer' =>  $inputs['university'],
                'chief' =>  $inputs['chief'],
                'conferenceSecretary' =>  $inputs['conferenceSecretary'],
                'conferencePresidency' =>  $inputs['conferencePresidency'],
                'scientificSecretary' =>  $inputs['scientificSecretary'],
                'executiveSecretary' =>  $inputs['executiveSecretary'],
                'poster' => $upload_res,
                'active' => $conference->active ,
                'code' => '1234'
            ]);

            $university_slug = str_replace(' ','-',$inputs['university']);
            $code = $year.'-'.$inputs['group_id'].'-'.$inputs['major_id'].'-'.$university_slug;
            $conference->update([
                'code'=>$code
            ]);
            alert()->success("Conference has been successfully updated");
            return back();
        }catch (\Exception $exception) {
            alert()->error("Sorry, there is a problem to update conference", "warning");
            return back();
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

    public function changePasswordForm(){
        return view('conference/en/panel/change_password',compact(''));
    }

    public function changePassword(Request $request){
        App::setLocale('en');
        $request->validate([
            'captcha' => 'required|captcha',
            'old_password'=>'required' ,
            'password'=>'required|min:6' ,
            'password2'=>'required|min:6|same:password' ,
        ],[]);
        $data = $request->all();
        $user= session()->get('conference_user_notice');
        if($user->real_password == $data['old_password'] ) {
            if($data['password'] === $data['password2'] ){
                $user->update([
                    'password'=>md5($data['password']) ,
                    'real_password'=>$data['password']
                ]);
                alert()->success("Your password changed successfully","");
                return back();
            }else{
                alert()->error("Confirm password is not match" , "warning");
                return back();
            }
        }else{
            alert()->error("Your old password is wrong" , "warning");
            return back();
        }
    }

    public function getCities(Request $request){
        return Cities::where('countries_id',$request->input('country_id'))->get();
    }

    private function uploadPoster($file,$type="new",$dir="")
    {
        if ($type == "new") {
            $directory = $this->getDirName();
            if (!is_dir(conference_assets_path . '/' . $directory)) {
                mkdir(public_path(conference_assets_path . '/' . $directory), 0777, true);
            }
            $res = $file->move(public_path(conference_assets_path . '/' . $directory), 'poster' . '.' . $file->getClientOriginalExtension());
            if ($res) {
                return [
                    'msg' => true,
                    'dir' => $directory,
                    'file' => $directory . '/' . 'poster' . '.' . $file->getClientOriginalExtension()
                ];
            }
            return [
                'msg' => false,
            ];
        }elseif ($type=="update"){
            $assets = scandir(public_path(conference_assets_path.'/'.$dir));
            $assets = array_diff($assets,['.','..']);
            foreach ($assets as $asset){
                if(preg_match('/poster\..+/',$asset)){
                    unlink(public_path(conference_assets_path.'/'.$dir.'/'.$asset));
                }
            }
            $res = $file->move(public_path(conference_assets_path . '/' . $dir), 'poster' . '.' . $file->getClientOriginalExtension());
            if ($res) {
                return [
                    'msg' => true,
                    'dir' => $dir,
                    'file' => $dir . '/' . 'poster' . '.' . $file->getClientOriginalExtension()
                ];
            }
            return [
                'msg' => false,
            ];
        }
    }



    public function getDirName(){
        $time = Carbon::now()->getTimestamp();
        return $time;
    }

    /*
        public function articleUploadFile(Request $request){
            $validation = Validator::make($request->all() , [
                'file' => 'required|max:5120',
            ]);
            if($validation->passes()){
                $file = $request->file('file');
                $file_ext = $file->getClientOriginalExtension();
                $directory_info = session()->get('conference_user_directory_information');
                if($request->session()->has('conference_user_directory_information')){
                    $session = session()->get('conference_user_directory_information');
                    $directory = $session['group_id'].'/'.$session['major_id'].'/'.$session['conference_user'].'/'.$session['volume_id'];
                }else{
                    $directory = $this->getDirName($directory_info['group_id'],$directory_info['major_id'],$directory_info['conference_user'],$directory_info['volume_id']);
                }
                $file_type = $request->input('file_type');
                $upload_files = public_path().'/upload/conferences/articles/'.$directory;
                $file_name = "";
                if (!is_dir($upload_files)) {
                    mkdir(public_path('/upload/conferences/articles/'.$directory) , 0777, true);
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
}
