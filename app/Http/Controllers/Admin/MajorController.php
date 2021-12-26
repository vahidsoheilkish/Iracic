<?php

namespace App\Http\Controllers\Admin;

use App\Major;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majors = Major::all();
        return view('admin/major/all',compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.major.create');
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
            'major_fa'=>'required',
            'major_en'=>'required',
            'group_id'=>'required',
        ]);
        $inputs = $request->all();
        $major = ['fa'=>$inputs['major_fa'] , 'en'=>$inputs['major_en']];
        Major::create([
            'group_id'=>$inputs['group_id'] ,
            'name'=>json_encode($major)
        ]);
        alert()->success("رشته ایجاد شد");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        return view('admin/major/edit',compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $major_id)
    {
        $request->validate([
            'major_fa'=>'required',
            'major_en'=>'required',
            'group_id'=>'required',
        ],[
            'major_fa.required'=>'عنوان فارسی وارد نشده است',
            'major_en.required'=>'عنوان انگلیسی وارد نشده است',
            'group_id.required'=>'عنوان انگلیسی وارد نشده است',
            'group_id.numeric'=>'باید کد گروه انتخاب شده باشد',
        ]);
        $inputs = $request->all();
        $group_name = [
            'fa'=>$inputs['major_fa'],
            'en'=>$inputs['major_en'],
        ];
        try{
            Major::find($major_id)->update(['group_id'=>$inputs['group_id'],'name'=>json_encode($group_name)]);
            alert()->success("ویرایش گروه با موفقیت انجام شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در ویرایش");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
    }
}
