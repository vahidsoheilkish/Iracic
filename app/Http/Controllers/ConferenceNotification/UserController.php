<?php

namespace App\Http\Controllers\ConferenceNotification;

use App\Cities;
use App\Conference;
use App\ConferenceUser;
use App\ConferenceVolume;
use App\Countries;
use App\Group;
use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function index(){
        $conferences = ConferenceVolume::latest()->take(5)->with('conference')->get();
        $countries = Countries::all();
        $cities =  Cities::all();
        return view('conference/en/index',compact('conferences','countries','cities'));
    }

    public function gate(){
        return view('conference/en/gate');
    }

    public function registerForm(){
        return view('conference.en.register');
    }

    public function login(Request $request){
        App::setLocale("en");
        $request->validate([
            'captcha' => 'required|captcha',
            'email' => 'required|email' ,
            'password' => 'required|min:6' ,
        ]);
        $inputs = $request->all();

        $conference_user = ConferenceUser::where( ['email'=>$inputs['email'] , 'password'=>md5($inputs['password']) ])->first();
        if( isset($conference_user) ){
            session(['conference_user_notice'=>$conference_user]);
            return redirect()->to(route('conference.notice.dashboard'));
        }
        alert()->error('Wrong email or password','warning');
        return redirect()->to(route('conference.notice.gate'));
    }

    public function userRegister(Request $request){
        App::setLocale('en');
        try {
            $request->validate([
                'captcha' => 'required|captcha',
                'name' => 'required',
                'family' => 'required',
                'password' => 'required:min:6',
                'password_confirmation' => 'required|min:6:|same:password',
                'email' => 'required|email',
                'codemeli' => 'required|digits:10',
            ], []);
            $inputs = $request->all();
            ConferenceUser::create([
                'name' => $inputs['name'],
                'lastname' => $inputs['name'],
                'password' => md5($inputs['password']),
                'codemeli' => $inputs['codemeli'],
                'real_password' => $inputs['password'],
                'email' => $inputs['email'],
                'tell' => $inputs['tell'],
            ]);
            alert()->success('Account of conference has been successfully register', '')->autoclose(4000);
            return redirect()->to(route('conference.notice.gate'));
        }catch (\Exception $e){
            alert()->error("This email is already registered","warning");
            return redirect()->to(route('conference.notice.gate'));
        }
    }

    // get conferences of a major used ajax => post
    public function getConferences(Group $group,Major $major){
        $conferences = Conference::with('conference_user')->where(['group_id' => $group->id , 'major_id'=>$major->id ])->get();
        sleep(1);
        return $conferences;
    }

    public function singleConference(Conference $conference,ConferenceVolume $conference_volume){
        $conference = $conference::where('_id',$conference->_id)->with('volumes')->first();
        return view('conference/en/detail' , compact('conference','conference_volume'));
    }

    public function searchConference(Request $request){
        $inputs = $request->all();
        switch ($inputs['type']){
            case 'title':
                sleep(1);
                return Conference::with('volumes')->where('title', $inputs['phrase'])->orWhere('title','like','%'.$inputs['phrase'].'%')->get();
            break;
            case 'organizer':
                sleep(1);
                return ConferenceVolume::where('organizer', $inputs['phrase'])->orWhere('organizers','like','%'.$inputs['phrase'].'%')->get();
            break;
            case 'code':
                sleep(1);
                return ConferenceVolume::where('code', $inputs['phrase'])->orWhere('_id','like','%'.$inputs['phrase'].'%')->get();
            break;

            case 'year':
                sleep(1);
                if(isset($inputs['phrase'])){
                    return ConferenceVolume::with('conference_notice.conference_user')->whereIn('year',$inputs['phrase'])->where(['volume_type'=>'notice'])->get();
                }else{
                    return ConferenceVolume::with('conference_notice.conference_user')->where(['volume_type'=>'notice','year'=>[2018,2019] ])->take(3)->get();
                }
            break;
        }
    }
}
