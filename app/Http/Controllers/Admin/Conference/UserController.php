<?php

namespace App\Http\Controllers\Admin\Conference;

use App\ConferenceNotification;
use App\ConferenceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conference_users = ConferenceUser::orderBy('id','DESC')->paginate(15);
        return view('admin.conferences.conference_users.all',compact('conference_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.conferences.conference_users.new');
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
            'captcha' => 'required|captcha',
            'name' => 'required',
            'family' => 'required',
            'password' => 'required:min:6',
            'password_confirmation' => 'required|min:6:|same:password',
            'email' => 'required|email',
            'codemeli' => 'required|digits:10',
        ],[]);
        $inputs = $request->all();
        \App\ConferenceUser::create([
            'name' => $inputs['name'] ,
            'lastname' => $inputs['name'] ,
            'password' => md5($inputs['password']) ,
            'codemeli' => $inputs['codemeli'] ,
            'real_password' => $inputs['password'] ,
            'email' => $inputs['email'] ,
            'tell' => $inputs['tell'] ,
        ]);
        alert()->success('کاربر جدید ثبت شد','')->autoclose(4000);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConferenceUser  $conferenceUser
     * @return \Illuminate\Http\Response
     */
    public function show(ConferenceUser $conferenceUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConferenceUser  $conferenceUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ConferenceUser $conferenceUser)
    {
        return view('admin.conferences.conference_users.edit',compact('conferenceUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConferenceUser  $conferenceUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConferenceUser $conferenceUser)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'tell' => 'required',
            'codemeli' => 'required',
        ],[]);
        $conferenceUser->update($request->all());
        alert()->success("کاربر کنفرانس با موفقیت ویرایش شد","ویرایش شد")->autoclose(3000);
        return redirect( route('admin.conference.users') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConferenceUser  $conferenceUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConferenceUser $conferenceUser)
    {
        //
    }

    // send notification to conference user => post
    public function sendNotification(Request $request){
        $request->validate([
            'conference_user_id' => 'required|numeric',
            'message' => 'required',
        ],[
            'conference_user_id.required' => 'کاربر تعیین نشده است',
            'message.required' => 'متن پیام وارد نشده است'
        ]);
        $inputs = $request->all();
        try {
            ConferenceNotification::create([
                'conference_user_id'=> $inputs['conference_user_id'],
                'message' => $inputs['message']
            ]);
            alert()->success("پیام با موفقیت ارسال شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در ارسال پیام" . $e->getMessage());
            return back();
        }
    }
}
