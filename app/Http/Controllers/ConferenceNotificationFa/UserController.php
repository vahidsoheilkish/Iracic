<?php

namespace App\Http\Controllers\ConferenceNotificationFa;

use Illuminate\Http\Request;
use App\Cities;
use App\Conference;
use App\ConferenceUser;
use App\ConferenceVolume;
use App\Countries;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $conferences = Conference::latest()->take(3)->get();
        $countries = Countries::all();
        $cities =  Cities::all();
        return view('conference/fa/index',compact('conferences','countries','cities'));
    }

    public function gate(){
        return view('conference/fa/gate');
    }

    public function login(Request $request){
        App::setLocale("fa");
        $request->validate([
            'captcha' => 'required|captcha',
            'email' => 'required|email' ,
            'password' => 'required|min:6' ,
        ]);
        $inputs = $request->all();

        $conference_user = ConferenceUser::where( ['email'=>$inputs['email'] , 'password'=>md5($inputs['password']) ])->first();
        if( isset($conference_user) ){
            session(['conference_user_notice'=>$conference_user ]);
            return redirect()->to(route('conference.notice.dashboard.fa'));
        }
        alert()->error('Wrong email or password','خطا');
        return redirect()->to(route('conference.notice.gate.fa'));
    }

    public function registerForm(){
        return view('conference.fa.register');
    }

    public function userRegister(Request $request){
        App::setLocale('fa');
        $request->validate([
            'captcha' => 'required|captcha',
            'name' => 'required',
            'family' => 'required',
            'password' => 'required:min:6',
            'password_confirmation' => 'required|min:6:|same:password',
            'email' => 'required|email',
            'codemeli' => 'required|digits:10',
        ],[]);
        $inputs = $request->all();
        ConferenceUser::create([
            'name' => $inputs['name'] ,
            'lastname' => $inputs['name'] ,
            'password' => md5($inputs['password']) ,
            'codemeli' => $inputs['codemeli'] ,
            'real_password' => $inputs['password'] ,
            'email' => $inputs['email'] ,
            'tell' => $inputs['tell'] ,
        ]);
        alert()->success('Account of conference has been successfully register','')->autoclose(4000);
        return redirect()->to(route('conference.notice.gate.fa'));
    }

    // get conferences of a major used ajax => post
    public function getConferences(Group $group,Major $major){
        $conferences = Conference::with('conference_user')->where(['group_id' => $group->id , 'major_id'=>$major->id ])->get();
        sleep(1);
        return $conferences;
    }

    public function singleConference(Conference $conference){
        return view('conference/fa/detail' , compact('conference'));
    }

    public function searchConference(Request $request){
        $inputs = $request->all();
        switch ($inputs['type']){
            case 'title':
                sleep(1);
                return Conference::where('title', $inputs['phrase'])->orWhere('title','like','%'.$inputs['phrase'].'%')->get();
            break;
            case 'organizer':
                sleep(1);
                return Conference::where('organizer', $inputs['phrase'])->orWhere('organizer','like','%'.$inputs['phrase'].'%')->get();
            break;
            case 'code':
                sleep(1);
                return Conference::where('_id', $inputs['phrase'])->orWhere('_id','like','%'.$inputs['phrase'].'%')->get();
            break;

            case 'year':
                sleep(1);
                return response()->json(['hi']);
            break;
        }
    }
}
