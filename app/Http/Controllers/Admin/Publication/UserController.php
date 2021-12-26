<?php

namespace App\Http\Controllers\Admin\Publication;

use App\Major;
use App\PublicationNotification;
use App\PublicationUser;
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
        $publication_users = PublicationUser::orderBy('id','DESC')->paginate(15);
        return view('admin.publications.publication_users.all',compact('publication_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publications.publication_users.new');
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
            'password' => 'required:min:6',
            'password_confirmation' => 'required|min:6:|same:password',
            'website' => 'required|a_domain',
            'email' => 'required|email',
            'ISSN' => 'required|numeric',
        ],[]);
        try{
            $inputs = $request->all();
            \App\PublicationUser::create([
                'name' => $inputs['name'] ,
                'password' => md5($inputs['password']) ,
                'email' => $inputs['email'] ,
                'website' => $inputs['website'] ,
                'ISSN' => $inputs['ISSN'] ,
                'real_password' => $inputs['password'] ,
            ]);
            alert()->success("کاربر نشریه با موفقیت ثبت شد","")->autoclose(3500);
            return back();
        }catch (\Exception $e){
            alert()->info("کاربر نشریه با این ایمیل قبلا ثبت شده است","خطا")->autoclose(3500);
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PublicationUser  $publicationUser
     * @return \Illuminate\Http\Response
     */
    public function show(PublicationUser $publicationUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PublicationUser  $publicationUser
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicationUser $publicationUser)
    {
        return view('admin.publications.publication_users.edit',compact('publicationUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PublicationUser  $publicationUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicationUser $publicationUser)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'ISSN' => 'required|numeric',
        ],[]);
        $publicationUser->update($request->all());
        alert()->success("کاربر نشریه با موفقیت ویرایش شد","ویرایش شد")->autoclose(3000);
        return redirect( route('admin.publication.users') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PublicationUser  $publicationUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicationUser $publicationUser)
    {
        //
    }

    // send notification to conference user => post
    public function sendNotification(Request $request){
        $request->validate([
            'publication_user_id' => 'required',
            'message' => 'required',
        ],[
            'publication_user_id.required' => 'کاربر تعیین نشده است',
            'message.required' => 'متن پیام وارد نشده است'
        ]);
        $inputs = $request->all();
        try {
            PublicationNotification::create([
                'publication_user_id'=> $inputs['publication_user_id'],
                'message' => $inputs['message']
            ]);
            alert()->success("پیام با موفقیت ارسال شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در ارسال پیام" . $e->getMessage());
            return back();
        }
    }


    public function majorsGroup(Request $request){
        return Major::where('group_id', $request->input('id'))->get();
    }
}



/*
// upload publication article file => post
public function articleUploadFile(Request $request){
    $validation = Validator::make($request->all() , [
        'file' => 'required|max:5120',
    ]);
    if($validation->passes()){
        $file = $request->file('file');
        $file_ext = $file->getClientOriginalExtension();
        $directory_info = session()->get('pub_admin_dirInfo');
        if($request->session()->has('pub_admin_dir')){
            $session = session()->get('pub_admin_dir');
            $directory = $session['group_id'].'/'.$session['major_id'].'/'.$session['publisher_id'].'/'.$session['volume_id'].'/'.$session['issue_id'];
        }else{
            $directory = $this->getDirName($directory_info['group_id'],$directory_info['major_id'],$directory_info['publisher_id'],$directory_info['volume_id'],$directory_info['issue_id']);
        }
        $file_type = 'file';
        $upload_files = public_path().'/upload/publications/articles/'.$directory;
        $file_name = "";
        if (!is_dir($upload_files)) {
            mkdir(public_path('upload/publications/articles/'.$directory) , 0777, true);
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



// upload file of article in update step => post
public function articleUploadFileUpdate(Request $request){
    $validation = Validator::make($request->all() , [
        'file' => 'required',
    ]);
    if($validation->passes()){
        $file = $request->file('file');
        $file_ext = $file->getClientOriginalExtension();
        $directory = $request->input('dir');
        $file_type = $request->input('file_type');
        $upload_files = public_path().'/upload/publications/articles/'.$directory;
        $file_name = "";
        if (!is_dir($upload_files)) {
            mkdir(public_path('upload/publications/articles/'.$directory) , 0777, true);
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






/*
// set a session to make unique directory of an articles => post
public function setDirSession(Request $request){
    $inputs = $request->all();
    session(
        ['pub_admin_dirInfo'=>
            [
                'publisher_id' => $inputs['publisher_id'],
                'group_id' => $inputs['group_id'],
                'major_id' => $inputs['major_id'],
                'volume_id' => $inputs['volume_id'],
                'issue_id' => $inputs['issue_id'],
            ]
        ]);
    return response()->json([
        'message'=>'success'
    ]);
}
*/
