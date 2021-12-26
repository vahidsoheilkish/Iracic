<?php

namespace App\Http\Controllers\Admin;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();
        return view('admin/group/all',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.group.create');
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
            'group_fa'=>'required',
            'group_en'=>'required',
        ]);
        $inputs = $request->all();
        $group = ['fa'=>$inputs['group_fa'] , 'en'=>$inputs['group_en']];
        Group::create([
            'name'=>json_encode($group)
        ]);
        alert()->success("گروه ایجاد شد");
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        return view('admin/group/edit',compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $group_id)
    {
        $request->validate([
            'group_fa'=>'required',
            'group_en'=>'required',
        ],[
            'group_fa.required'=>'عنوان فارسی وارد نشده است',
            'group_en.required'=>'عنوان انگلیسی وارد نشده است',
        ]);
        $inputs = $request->all();
        $group_name = [
            'fa'=>$inputs['group_fa'],
            'en'=>$inputs['group_en'],
        ];
        try{
            Group::find($group_id)->update(['name'=>json_encode($group_name)]);
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
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {

    }
}
