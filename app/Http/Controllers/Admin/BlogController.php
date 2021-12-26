<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('admin.blog.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.blog.create');
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
            'title' => 'required' ,
            'body' => 'required' ,
            'imgUrl' => 'required|mimes:jpeg,bmp,png,jpg' ,
        ],[]);
        $inputs = $request->all();
        try{
            $post = Post::create([
                'title' => $inputs['title'] ,
                'body' => $inputs['body'] ,
                'imgUrl' => 'no-img'
            ]);
            $post->categories()->attach( $request->input('tags') );
            if (!is_dir('upload/post/'.$post->id)) {
                mkdir(public_path('upload/post/'.$post->id) , 0777, true);
            }
            $filename=$request->file('imgUrl')->getClientOriginalName();
            $request->file('imgUrl')->move('upload/post/'.$post->id , $request->file('imgUrl')->getClientOriginalName());
            $post->update(['imgUrl'=>$post->id.'/'.$filename]);
            alert()->success("پست با موفقیت ایجاد شد");
            return redirect()->to(route('admin.blog'));
        }catch (\Exception $exception){
            alert()->error("خطا در ایجاد پست");
            return redirect()->to(route('admin.blog'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required' ,
            'body' => 'required' ,
        ],[]);
        try{
            $post->update($request->all());
            alert()->success("ویرایش پست با موفقیت انجام شد","");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در ویرایش","");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $path = explode('/' , $post->imgUrl);
        try{
            if( $this->delete_directory(public_path('upload/post/'.$path[0])) ){
                $post->delete();
                alert()->success("حذف پست با موفقیت انجام شد","");
                return back();
            }
        }catch (\Exception $e){
            alert()->error("خطا در حذف" . $e->getMessage(),"");
            return back();
        }
    }
}
