<?php

namespace App\Http\Controllers\PublicationFa;

use App\Issue;
use App\Major;
use App\Publication;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class PublicationController extends Controller
{
    // publication user dashboard
    public function dashboard(){
        $publication_user = session()->get('publication_user');
        $publication = Publication::where('publication_user_id' , $publication_user->id)->first();

        if($publication){
            switch ($publication->lang){
                case 'en':
                    switch ($publication->publisher_order){
                        case 'week':
                            $period = Setting::where('key', 'weekly_en')->first();
                            break;
                        case 'biweek':
                            $period = Setting::where('key', 'biweekly_en')->first();
                        break;
                        case 'month':
                            $period = Setting::where('key', 'en_month')->first();
                        break;
                        case 'bimonth':
                            $period = Setting::where('key', 'bimonthly_en')->first();
                        break;
                        case 'season':
                            $period = Setting::where('key', 'en_season')->first();
                        break;
                        case 'biseason':
                            $period = Setting::where('key', 'en_half_year')->first();
                        break;
                        case 'triannual':
                            $period = Setting::where('key', 'triannual_en')->first();
                        break;
                        case 'annual':
                            $period = Setting::where('key', 'en_year')->first();
                        break;
                    }
                    $current_year = date("Y");
                break;
                case 'fa':
                    switch ($publication->publisher_order){
                        case 'week':
                            $period = Setting::where('key', 'weekly_fa')->first();
                        break;
                        case 'biweek':
                            $period = Setting::where('key', 'biweekly_fa')->first();
                        break;
                        case 'month':
                            $period = Setting::where('key', 'fa_month')->first();
                        break;
                        case 'bimonth':
                            $period = Setting::where('key', 'bimonthly_fa')->first();
                        break;
                        case 'season':
                            $period = Setting::where('key', 'fa_season')->first();
                        break;
                        case 'biseason':
                            $period = Setting::where('key', 'fa_half_year')->first();
                        break;
                        case 'triannual':
                            $period = Setting::where('key', 'triannual_fa')->first();
                        break;
                        case 'annual':
                            $period = Setting::where('key', 'fa_year')->first();
                        break;
                    }
                    $current_year = \Morilog\Jalali\Jalalian::now()->getYear();
                break;
            }
        }
        return view('publication/fa/dashboard/index' ,compact('publication_user','publication','period','current_year'));
    }

    // user publication logout
    public function logout(){
        session()->forget('publication_user');
        return redirect()->to( route('publication.index.fa')  );
    }


    // form of publication submit
    public function create(){
        return view('publication/fa/dashboard/create');
    }

    // publication submit just one publication and save in publication table (post method)
    public function store(Request $request){
        App::setLocale('fa');
        $request->validate([
            'title'=>'required',
            'subject'=>'required',

            'group_id'=>'required',
            'major_id'=>'required',
            'lang'=>'required',

            'country'=>'required',
            'publication_publisher'=>'required',
            'website'=>'required',

            'publisher_order'=>'required',
            'first_publish_year'=>'required',

            'access'=>'required',
            'type'=>'required',

            'poster' => 'required|mimes:jpg,png,jpeg',

            'address.*' => 'required',
            'tell.*' => 'required|numeric',
            'email.*' => 'required|email',
            'organizer.*' => 'required|mimes:jpg,png,jpeg',

            'job.*' => 'required',
            'fullname.*' => 'required',
        ],[]);
        try {
            $inputs = $request->all();
            $information = array();
            for ($i = 0; $i < count($inputs['email']); $i++) {
                $info = array(
                    'email' => $inputs['email'][$i],
                    'address' => $inputs['address'][$i],
                    'tell' => $inputs['tell'][$i],
                    'fax' => $inputs['fax'][$i],
                );
                array_push($information, $info);
            }
            $contacts = json_encode($information);


            $dirname = uniqid();
            $dir = "/upload/publications/assets" . "/" . $dirname;
            if (!is_dir(public_path($dir))) {
                mkdir(public_path($dir));
            }

            //upload poster
            $poster_pic = $request->file('poster');
            $poster_pic->move(public_path($dir), 'poster' . '.' . $poster_pic->getClientOriginalExtension());

            foreach ($inputs['job'] as $key => $name) {
                if (isset($inputs['organizer'][$key])) {
                    $inputs['organizer'][$key]->move(public_path($dir), $inputs['organizer'][$key]->getClientOriginalName());
                    sleep(1);
                    $organizers[] = ['job' => $inputs['job'][$key], 'name' => $inputs['fullname'][$key], 'image' => $inputs['organizer'][$key]->getClientOriginalName()];
                } else {
                    $organizers[] = ['job' => $inputs['job'][$key], 'name' => $inputs['fullname'][$key], 'image' => ''];
                }
            }
            $publication_user_id = session()->get('publication_user');
            $this_publication = Publication::create([
                'publication_user_id' => $publication_user_id->id,

                'title' => $inputs['title'] ,
                'subject' => $inputs['subject'] ,

                'group_id' => $inputs['group_id'] ,
                'major_id' => $inputs['major_id'] ,

                'lang' => $inputs['lang'] ,
                'country' => $inputs['country'] ,
                'publication_publisher' => $inputs['publication_publisher'] ,

                'ISBN' => $inputs['ISBN'] ,
                'printISSN' => $inputs['printISSN'] ,
                'onlineISSN' => $inputs['onlineISSN'] ,

                'website' => $inputs['website'] ,
                'DOI' => $inputs['DOI'] ,
                'publisher_order' => $inputs['publisher_order'] ,
                'first_publish_year' => $inputs['first_publish_year'] ,
                'type' => $inputs['type'] ,

                'contancts' => $contacts,
                'organizers' => $organizers,

                'dir' => $dir,

                'poster' => 'poster' . '.' . $poster_pic->getClientOriginalExtension(),

                'active' => 0,

                'viewCount'=>0
            ]);

//            $count = Publication::where(['group_id'=> $inputs['group_id'] , 'major_id'=>$inputs['major_id'] ])->count();
//            $count+=1;
//            switch ($inputs['lang']){
//                case 'en': $lang_code = 1; break;
//                case 'fa': $lang_code = 2; break;
//                case 'ar': $lang_code = 3; break;
//            }
//            $abbreviation ='';
//            $abbr = $inputs['title'];
//            $abbr = explode(' ',$abbr);
//            foreach ($abbr as $item){
//                $abbreviation.=$item[0];
//            }
//            $iracic_code = $inputs['group_id'].'-'.$inputs['major_id'].'-'.$count.'-'.$lang_code.'-'.$abbreviation;
//            $this_publication->update([ 'iracic_code'=>$iracic_code , 'dir'=>$this_publication->id]);
            alert()->success("نشریه با موفقیت ثبت شد","success")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        } catch (\Exception $e){
            alert()->error("شما قبلا نشریه خود را ثبت کرده اید","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        }
    }

    public function notifications(){
        $publication_user = session()->get('publication_user');
        $notifications = PublicationNotification::where('publication_user_id',$publication_user->id)->orderBy('id','DESC')->paginate();
        return view('publication.fa.dashboard.notification',compact('notifications'));
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

    // get all majors of a group
    public function majorsGroup($group_id){
        return Major::where('group_id', $group_id)->get();
    }

    // get all issue of a volume
    public function issuesVolume($volume_id){
        return Issue::where('volume_id' , $volume_id)->get();
    }

    public function changePasswordForm(){
        return view('publication/fa/dashboard/change_password');
    }

    public function changePassword(Request $request){
        App::setLocale('fa');
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
        return view('publication.fa.dashboard.tree',compact('publication'));
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

    protected function getDirName(){
        $time = Carbon::now()->getTimestamp();
        $time = $time . md5($time);
        return $time;
    }

}
