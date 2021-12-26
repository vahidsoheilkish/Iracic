<?php

namespace App\Http\Controllers\Admin;

use App\Submenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubmenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.submenu_create');
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
            'menu_id' => 'required',
            'name_fa' => 'required',
            'name_en' => 'required',
            'link' => 'required',
        ]);
        $data=$request->all();
        if( $request->file('img')  ) {
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            $menu = Submenu::create([
                'menu_id'=>$data['menu_id'],
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            $img = $request->file('img');
            $img->move(public_path('upload/submenu/') , $menu->id.'.'.$img->getClientOriginalExtension());
            $menu->update(['img'=>$menu->id.'.'.$img->getClientOriginalExtension()]);
            alert()->success("زیر منو ایجاد شد","");
            return back();
        }else{
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            Submenu::create([
                'menu_id'=>$data['menu_id'],
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            alert()->success("زیر منو ایجاد شد","");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function show(Submenu $submenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function edit(Submenu $submenu)
    {
        return view('admin.menu.submenu_edit',compact('submenu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submenu $submenu)
    {
        $request->validate([
            'menu_id'=> 'required' ,
            'name_fa' => 'required',
            'name_en' => 'required',
            'link' => 'required',
        ]);
        $data=$request->all();
        if( $request->file('img')  ) {
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            $submenu->update([
                'menu_id'=>$data['menu_id'],
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            $img = $request->file('img');
            unlink(public_path('upload/submenu/'.$submenu->img));
            $img->move(public_path('upload/submenu/') , $submenu->id.'.'.$img->getClientOriginalExtension());
            $submenu->update(['img'=>$submenu->id.'.'.$img->getClientOriginalExtension()]);
            alert()->success("زیرمنو آپدیت شد","");
            return back();
        }else{
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            $submenu->update([
                'menu_id'=>$data['menu_id'],
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            alert()->success("زیرمنو آپدیت شد","");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Submenu  $submenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Submenu $submenu)
    {
        try{
            if($submenu->img) {
                unlink(public_path("/upload/submenu/" . $submenu->img));
            }
            $submenu->delete();
            alert()->success("منو، زیرمنو حذف شد","");
            return back();
        }catch (\Exception $e){
            alert()->error("مشکل در حذف" , "خطا");
            return back();
        }
    }

    public function display(Request $request){
        $data = $request->all();
        $submenu = Submenu::where('_id',$data['submenu_id'])->first();
        if($submenu->display == 0 ){
            $submenu->update(['display'=>1]);
            return response()->json([
                'msg'=>'success',
                'display'=>1
            ]);
        }else{
            $submenu->update(['display'=>0]);
            return response()->json([
                'msg'=>'success',
                'display'=>0
            ]);
        }
    }
}
