<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries=Countries::latest()->paginate(5);
        return view('admin/zone/city',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $flag=$request->file('flag');
        $request->validate([
            'country'=>'required',
            'flag'=>'required|max:3120|mimes:jpeg,jpg,png'
        ],[]);
        $data=$request->all();
        try{
            $flag=$request->file('flag');
            Countries::create([
                'name'=>$data['country'],
                'flag'=>'/upload/flag/'.$data['country'].'.'.$flag->getClientOriginalExtension(),
            ]);
            if (!is_dir(public_path('upload/flag/'))) {
                mkdir(public_path('upload/flag/') , 0777, true);
            }
            $flag->move(public_path('upload/flag/'),$data['country'].'.'.$flag->getClientOriginalExtension());
            alert()->success("کشور " . $data['country']  . "  با موفقیت ثبت شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در ثبت کشور","");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function show(Countries $countries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function edit(Countries $countries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countries $countries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $country)
    {
        try{
            if(file_exists(public_path($country->flag))){
                unlink(public_path($country->flag));
            }
            $country->delete();
            alert()->success("کشور " . $country->name  . "  با موفقیت حذف شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در حذف کشور","");
            return back();
        }
    }
}
