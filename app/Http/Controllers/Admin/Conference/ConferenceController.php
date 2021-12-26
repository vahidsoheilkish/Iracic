<?php

namespace App\Http\Controllers\Admin\Conference;

use App\Conference;
use App\ConferenceUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conferences = Conference::orderBy('id','DESC')->paginate(15);
        return view('admin.conferences.all',compact('conferences'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ConferenceUser $user)
    {
        return view('admin.conferences.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $user)
    {
        $request->validate([
            'title' => 'required' ,
            'group_id' => 'required' ,
            'major_id' => 'required' ,
            'lang' => 'required' ,
            'subject' => 'required' ,
            'level' => 'required' ,
            'access' => 'required' ,
            'type' => 'required' ,
            'conference_publisher' => 'required' ,

            'organizer_name.*' => 'required' ,
            'organizer_pic.*' => 'required|mimes:jpeg,jpg,png',
        ],[]);
        $inputs = $request->all();
        $organizers = array();
        $directory = "/upload/conferences/assets/".$user;
        if(!is_dir(public_path($directory))){
            mkdir(public_path($directory) ,0777,true);
        }
        foreach ($inputs['organizer_name'] as $key=>$name){
            if(isset($inputs['organizer_pic'][$key])){
                $inputs['organizer_pic'][$key]->move(public_path($directory) , $inputs['organizer_pic'][$key]->getClientOriginalName());
                sleep(1);
                $organizers[] = ['name'=>$name , 'image'=>$inputs['organizer_pic'][$key]->getClientOriginalName()] ;
            }else{
                $organizers[] = ['name'=>$name , 'image'=>''] ;
            }
        }
        $organizers = json_encode($organizers);
        try{
            $conference = Conference::create([
                'conference_user_id' => $user ,

                'title' => $inputs['title'] ,
                'group_id' => $inputs['group_id'],
                'major_id' =>  $inputs['major_id'],
                'lang' => $inputs['lang'] ,
                'subject'=>$inputs['subject'],

                'level' => $inputs['level'] ,
                'access' => $inputs['access'] ,
                'type' => $inputs['type'] ,

                'conference_publisher' => $inputs['conference_publisher'] ,
                'ISBN' => $inputs['ISBN'] ,
                'printISSN' => $inputs['printISSN'] ,
                'onlineISSN' => $inputs['onlineISSN'] ,
                'DOI' => $inputs['DOI'] ,
                'organizers' => $organizers ,
                'active' => 0 ,

            ]);

            alert()->success("کنفرانس با موفقیت ثبت شد");
            return back();
        }catch (\Exception $exception){
            alert()->error("شما پیش از این کنفرانس خود را ثبت کرده اید" , "خطا");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function show(Conference $conference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function edit(Conference $conference)
    {
        return view('admin.conferences.edit',compact('conference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conference $conference)
    {
        $inputs = $request->all();
        $request->validate([
            'group_id' => 'required' ,
            'major_id' => 'required' ,
            'lang' => 'required' ,
            'title_1' => 'required' ,
            'title_2' => 'required' ,
            'level' => 'required' ,
            'university' => 'required' ,
            'country' => 'required' ,
//            'country' => 'required|nullable' ,
//            'city' => 'required|nullable' ,
//            'printISSN' => 'required|nullable' ,
//            'onlineISSN' => 'required|nullable' ,
//            'dependency' => 'required|nullable' ,
//            'DOI' => 'required|nullable' ,
//            'publication_type' => 'required' ,
//            'responsible' => 'required|nullable',
//            'redactor' => 'required|nullable',
//            'editor' => 'required|nullable',
//            'managerin' => 'required|nullable',
//            'managerexe' => 'required|nullable',
//            'responsible_pic' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
//            'redactor_pic' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
//            'editor_pic' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
//            'managerin_pic' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
//            'managerexe_pic' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
//            'tell' => 'required|nullable|numeric',
//            'fax' => 'required|nullable',
//            'website' => 'required|nullable',
//            'address' => 'required|nullable',
//            'poster' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
//            'owner_logo' => 'required|nullable|max:1024|mimes:png,jpeg,jpg',
        ],[
            'title_1.required' => 'عنوان به زبان اصلی وارد کنید' ,
            'title_2.required' => 'عنوان به زبان دوم وارد کنید' ,
            'publication_type.required' => 'نوع نشریه را انتخاب کنید' ,
            'first_publish_year.required' => 'اولین سال انتشار را وارد کنید' ,
        ]);

        $owner_logo = $request->file('owner_logo');
        try{
            if(isset($owner_logo)){
                $request->validate([
                    'owner_logo' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(conference_assets_path."/".$conference->dir."/owner_logo.*");
                $owner_logo->move(public_path(conference_assets_path."/".$conference->dir),'owner_logo'.".".$owner_logo->getClientOriginalExtension());
                $owner_logo_db='owner_logo'.".".$owner_logo->getClientOriginalExtension();
            }elseif ($conference->owner_logo == null){
                $owner_logo_db='';
            }else{
                $owner_logo_db=$conference->owner_logo;
            }
            $date = Carbon::now()->getTimestamp();
            $iracic_code=$inputs['group_id'].'-'.$inputs['major_id'].'-'.$inputs['university'].'-'.$date;
            $title = ['l1' => $inputs['title_1'] , 'l2'=>$inputs['title_2'] ] ;
            $conference->update([
                'group_id' => $inputs['group_id'] ,
                'major_id' => $inputs['major_id'] ,
                'lang' => $inputs['lang'] ,
                'title' => json_encode($title) ,
                'level' =>  $inputs['level'] ,
                'university' =>  $inputs['university'] ,
                'college'=>$inputs['college'],
                'country' =>  $this->checkField($inputs['country']) ,
                'ISBN' =>  $this->checkField($inputs['ISBN']) ,
                'printISSN' =>  $this->checkField($inputs['printISSN']) ,
                'onlineISSN' =>  $this->checkField($inputs['onlineISSN']) ,
                'owner_logo' =>  $owner_logo_db ,
                'code'=>$iracic_code ,
                'DOI' => $inputs['doi'] ,
                'send_article' => $inputs['send_article'] ,
                'access' => $inputs['access'] ,
                'active'=>$inputs['active']
            ]);
            alert()->success("کنفرانس با موفقیت ویرایش شد","ویرایش شد")->autoclose(3000);
            return back();
        }catch (\Exception $e){
            echo $e->getMessage();
            return;
            alert()->error("خطا در عملیات ویرایش","اخطار");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Conference  $conference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conference $conference)
    {
        //
    }

    // active deactive conference => post
    public function active($id){
        $record =  Conference::where('_id',$id)->first();
        if($record->active == "0"){
            Conference::where('_id',$id)->update(['active'=>'1']);
            return response()->json(['message'=>'success' , 'target'=>'success']);
        }else{
            Conference::where('_id',$id)->update(['active'=>'0']);
            return response()->json(['message'=>'success' , 'target'=>'danger']);
        }
    }
}
