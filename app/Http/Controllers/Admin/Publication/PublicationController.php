<?php

namespace App\Http\Controllers\Admin\Publication;

use App\Group;
use App\Major;
use App\Publication;
use App\Volume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = Publication::orderBy('id','DESC')->paginate(15);
        return view('admin.publications.all',compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user)
    {
        return view('admin.publications.publication_users.new_publication',compact('user'));

    }

    public function add(){
        return view('admin.publications.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {
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
                'publication_user_id' => $inputs['publication_user_id'],

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
            ]);
            alert()->success("نشریه با موفقیت ثبت شد","success")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        } catch (\Exception $e){
            alert()->error("شما قبلا نشریه خود را ثبت کرده اید","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $publication)
    {
        return view('admin.publications.edit',compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        // here we are
        $inputs = $request->all();
        $request->validate([
            'group_id' => 'required' ,
            'major_id' => 'required' ,
            'lang' => 'required' ,
            'title_1' => 'required' ,
            'title_2' => 'required|nullable' ,
            'publish_order' => 'required' ,
            'access' => 'required|nullable' ,
            'first_publish_year' => 'required' ,
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
        $title = ['t1' => $inputs['title_1'] , 't2'=>$inputs['title_2'] ] ;
        $title = json_encode($title);
        $poster = $request->file('poster');
        $owner_logo = $request->file('owner_logo');
        $responsible_pic = $request->file("responsible_pic");
        $redactor_pic = $request->file("redactor_pic");
        $editor_pic = $request->file("editor_pic");
        $managerin_pic = $request->file("managerin_pic");
        $managerexe_pic = $request->file("managerexe_pic");
        try{
            if(isset($poster)){
                $request->validate([
                    'poster' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/poster.*");
                $poster->move(public_path(publication_assets_path."/".$publication->dir),'poster'.".".$poster->getClientOriginalExtension());
                $poster_db='poster'.".".$poster->getClientOriginalExtension();
            }elseif ($publication->poster == null){
                $poster_db='';
            }else{
                $poster_db=$publication->poster;
            }
            if(isset($owner_logo)){
                $request->validate([
                    'owner_logo' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/owner_logo.*");
                $owner_logo->move(public_path(publication_assets_path."/".$publication->dir),'owner_logo'.".".$owner_logo->getClientOriginalExtension());
                $owner_logo_db='owner_logo'.".".$owner_logo->getClientOriginalExtension();
            }elseif ($publication->owner_logo == null){
                $owner_logo_db='';
            }else{
                $owner_logo_db=$publication->owner_logo;
            }
            if(isset($responsible_pic) || isset($inputs['responsible']) ){
                $request->validate([
                    'responsible' => 'required|nullable',
                    'responsible_pic' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/responsible.*");
                $responsible_pic->move(public_path(publication_assets_path."/".$publication->dir),'responsible'.".".$responsible_pic->getClientOriginalExtension());
                $responsible_db = json_encode(['name'=>$inputs['responsible'] , 'pic'=>'responsible'.'.'.$responsible_pic->getClientOriginalExtension() ]);
            }elseif ($publication->responsible == null){
                $responsible_db='';
            }else{
                $responsible_db=$publication->responsible;
            }
            if(isset($redactor_pic)|| isset($inputs['redactor'])){
                $request->validate([
                    'redactor' => 'required|nullable',
                    'redactor_pic' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/redactor.*");
                $redactor_pic->move(public_path(publication_assets_path."/".$publication->dir),'redactor'.".".$redactor_pic->getClientOriginalExtension());
                $redactor_db = json_encode(['name'=>$inputs['redactor'] , 'pic'=>'redactor'.'.'.$redactor_pic->getClientOriginalExtension() ]);
            }elseif ($publication->redactor_db == null){
                $redactor_db='';
            }else{
                $redactor_db=$publication->redactor;
            }
            if(isset($editor_pic)|| isset($inputs['editor'])){
                $request->validate([
                    'editor' => 'required|nullable',
                    'editor_pic' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/editor.*");
                $editor_pic->move(public_path(publication_assets_path."/".$publication->dir),'editor'.".".$editor_pic->getClientOriginalExtension());
                $editor_db = json_encode(['name'=>$inputs['editor'] , 'pic'=>'editor'.'.'.$editor_pic->getClientOriginalExtension() ]);
            }elseif ($publication->redactor_db == null){
                $editor_db='';
            }else{
                $editor_db=$publication->editor;
            }
            if(isset($managerin_pic)|| isset($inputs['managerin'])){
                $request->validate([
                    'managerin' => 'required|nullable',
                    'managerin_pic' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/managerin.*");
                $managerin_pic->move(public_path(publication_assets_path."/".$publication->dir),'managerin'.".".$managerin_pic->getClientOriginalExtension());
                $managerin_db = json_encode(['name'=>$inputs['managerin'] , 'pic'=>'managerin'.'.'.$managerin_pic->getClientOriginalExtension() ]);
            }elseif ($publication->manager_in == null){
                $managerin_db='';
            }else{
                $managerin_db=$publication->manager_in;
            }
            if(isset($managerexe_pic)|| isset($inputs['managerexe'])){
                $request->validate([
                    'managerexe' => 'required|nullable',
                    'managerexe_pic' => 'required|max:1024|mimes:png,jpeg,jpg',
                ]);
                $this->delete_similar_name(publication_assets_path."/".$publication->dir."/managerexe.*");
                $managerexe_pic->move(public_path(publication_assets_path."/".$publication->dir),'managerexe'.".".$managerexe_pic->getClientOriginalExtension());
                $managerexe_db = json_encode(['name'=>$inputs['managerexe'] , 'pic'=>'managerexe'.'.'.$managerexe_pic->getClientOriginalExtension() ]);
            }elseif ($publication->manager_exe == null){
                $managerexe_db='';
            }else{
                $managerexe_db=$publication->manager_exe;
            }
        }catch (\Exception $e){
            alert()->error("خطا در عملیات ویرایش","اخطار");
            return back();
        }

        $publication->update([
            'group_id' => $inputs['group_id'] ,
            'major_id' => $inputs['major_id'] ,
            'lang' => $inputs['lang'] ,
            'publication_type' => $inputs['publication_type'] ,
            'publish_order' => $inputs['publish_order'] ,
            'access' => $inputs['access'] ,
            'first_publish_year' => $inputs['first_publish_year'] ,
            'title' => $title ,
            'country' =>  $this->checkField($inputs['country']) ,
            'city' =>  $this->checkField($inputs['city']) ,
            'printISSN' =>  $this->checkField($inputs['printISSN']) ,
            'onlineISSN' =>  $this->checkField($inputs['onlineISSN']) ,
            'dependency' =>  $this->checkField($inputs['dependency']) ,
            'DOI' =>  $this->checkField($inputs['DOI']) ,
            'tell' =>  $this->checkField($inputs['tell']) ,
            'fax' =>  $this->checkField($inputs['fax']) ,
            'website' =>  $this->checkField($inputs['website']) ,
            'publication_publisher' =>  $this->checkField($inputs['publication_publisher']) ,
            'address' =>  $this->checkField($inputs['address']) ,
            'poster' =>  $poster_db ,
            'owner_logo' =>  $owner_logo_db ,
            'responsible' => $responsible_db ,
            'redactor' => $redactor_db ,
            'editor' => $editor_db,
            'manager_in' => $managerin_db ,
            'manager_exe' => $managerexe_db ,
            'active' => $inputs['active'] ,
        ]);
        alert()->success("نشریه با موفقیت ویرایش شد","ویرایش شد")->autoclose(3000);
        return redirect( route('admin.publications') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }

    // active and deactive a publication
    public function active($id){
        $publication = Publication::where('_id', $id)->first();
        if($publication-> active =="0"){
            $publication->update(['active'=>"1"]);
            return response()->json([
                'message'=>'success',
                'target'=>'success',
            ]);
        }else{
            $publication->update(['active'=>"0"]);
            return response()->json([
                'message'=>'success',
                'target'=>'fail',
            ]);
        }
    }

    // page of publication with volumes with issue all in view page
    public function publicationVolumeIssues(Group $group,Major $major,Publication $publication,Volume $volume){
        $issues = $volume->issues;
        return view('admin.publications.issues',compact('group','major','publication','volume','issues'));
    }
}
