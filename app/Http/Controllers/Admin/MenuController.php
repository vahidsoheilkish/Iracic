<?php

namespace App\Http\Controllers\Admin;

use App\Menu;
use App\Submenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::with('submenus')->get();
        return view('admin.menu.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
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
            'name_fa' => 'required',
            'name_en' => 'required',
            'link' => 'required',
        ]);
        $data=$request->all();
        if( $request->file('img')  ) {
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            $menu = Manu::create([
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            $img = $request->file('img');
            $img->move(public_path('upload/menu/') , $menu->id.'.'.$img->getClientOriginalExtension());
            $menu->update(['img'=>$menu->id.'.'.$img->getClientOriginalExtension()]);
            alert()->success("منو ایجاد شد","");
            return back();
        }else{
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            Menu::create([
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            alert()->success("منو ایجاد شد","");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menu.menu_edit',compact('menu'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name_fa' => 'required',
            'name_en' => 'required',
            'link' => 'required',
        ]);
        $data=$request->all();
        if( $request->file('img')  ) {
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            $menu->update([
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            $img = $request->file('img');
            unlink(public_path('upload/menu/'.$menu->img));
            $img->move(public_path('upload/menu/') , $menu->id.'.'.$img->getClientOriginalExtension());
            $menu->update(['img'=>$menu->id.'.'.$img->getClientOriginalExtension()]);
            alert()->success("منو ویرایش شد","");
            return back();
        }else{
            $name = json_encode( ['fa'=>$data['name_fa'],'en'=>$data['name_en']] );
            $menu->update([
                'name'=>$name,
                'link'=>$data['link'],
                'display'=>0
            ]);
            alert()->success("منو آپدیت شد","");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        try {
            if($menu->img) {
                unlink(public_path("/upload/menu/" . $menu->img));
            }
            $menu->delete();
            $submenus = Submenu::where('menu_id', $menu->id)->get();
            foreach ($submenus as $submenu) {
                if($submenu->img){
                    unlink(public_path("/upload/submenu/" . $submenu->img));
                }
                $submenu->delete();
            }
            alert()->success("منو، زیرمنو حذف شد","");
            return back();
        }catch (\Exception $e){
            alert()->error("مشکل در حذف" , "خطا");
            return back();
        }
    }


    public function display(Request $request){
        $data = $request->all();
        $menu = Menu::where('_id',$data['menu_id'])->first();
        if($menu->display == 0 ){
            $menu->update(['display'=>1]);
            return response()->json([
                'msg'=>'success',
                'display'=>1
            ]);
        }else{
            $menu->update(['display'=>0]);
            return response()->json([
                'msg'=>'success',
                'display'=>0
            ]);
        }
    }
}
