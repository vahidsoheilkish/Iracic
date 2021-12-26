<?php

namespace App\Http\Controllers\PublicationFa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
// publication user index
    public function index(){
        return view('publication.fa.index');
    }

    // publication login (post method)
    public function login(Request $request){
        App::setLocale('fa');
        $request->validate([
            'captcha' => 'required|captcha',
            'email' => 'required|email' ,
            'password' => 'required|min:6' ,
        ]);
        $inputs = $request->all();

        $publication_user = \App\PublicationUser::where( ['email'=>$inputs['email'] , 'password'=>md5($inputs['password']) ])->get();
        if( isset($publication_user[0]) ){
            session(['publication_user'=>$publication_user[0] ]);
            return redirect()->to(route('publication.dashboard.fa'));
        }else {
            alert()->error("Invalid email or password", "error");
            return back();
        }
    }

    // publication user register form page
    public function registerForm(){
        return view('publication.fa.register');
    }

    // publication register (post method)
    public function register(Request $request){
        App::setLocale('fa');
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
            alert()->success("User has been successfully register","success")->autoclose(3500);
            return redirect()->to(route('publication.index.fa'));
        }catch (\Exception $e){
            alert()->info("Sorry, there is a problem in register, please try again","error")->autoclose(3500);
            return redirect()->to(route('publication.index.fa'));
        }
    }
}
