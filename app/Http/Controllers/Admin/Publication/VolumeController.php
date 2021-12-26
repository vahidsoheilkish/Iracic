<?php

namespace App\Http\Controllers\Admin\Publication;

use App\Publication;
use App\Volume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VolumeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Publication $publication)
    {
        return view('admin.publications.volumes',compact('publication'));
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
        $inputs = $request->all();
        $vol = Volume::where(['publication_id'=>$inputs['publication_id'],'year'=>$inputs['year']])->first();
        if(!empty($vol)){
            alert()->error("این دوره قبلا ثبت شده است");
            return back();
        }
        $publication = Publication::find($inputs['publication_id']);
        if( $inputs['year'] < $publication->first_publish_year ){
            alert()->error("سال دوره کمتر از اولین سال انتشار نشریه است");
            return back();
        }
        $request->validate([
            'publication_id' => 'required',
            'year' => 'required|numeric',
        ],[
            'publication_id.required' => 'لطفا ابتدا نشریه خود را ثبت و پس از تایید شدن دوره را ثبت نمایید.'
        ]);
        try{
            Volume::create([
                'publication_id' => $inputs['publication_id'] ,
                'year' => $inputs['year'] ,
            ]);
            alert()->success("دوره با موفقیت ثبت شد","ثبت شد")->autoclose(3500);
            return redirect()->back();
        }catch (\Illuminate\Database\QueryException $e){
            alert()->error("این دوره در سال انتخابی قبلا ایجاد شده است","خطا")->autoclose(3500);
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function show(Volume $volume)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function edit(Volume $volume)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputs = $request->all();
        $volume = Volume::where('_id',$inputs['volume'])->first();
        $find=Volume::where(['publication_id'=>$inputs['id'],'year'=>$inputs['year']])->get();
        if(count($find) > 0){
            return response()->json([
                'message'=>'duplicate'
            ]);
        }
        $publication_id = $volume->publication->first_publish_year;
        if($inputs['year'] < $publication_id){
            return response()->json([
                'message'=>'fail',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'id'=>'required',
            'year'=>'required|numeric',
        ]);

        if ($validator->fails()){
            $errors = $validator->errors();
            return response()->json(['message'=>'error' , 'err'=>$errors]);
        }else{
            if($volume->update(['year'=>$request->input('year')])){
                return response()->json([
                    'message'=>'success',
                    'year'=> $request->input('year')
                ]);
            }else{
                return response()->json([
                    'message'=>'fail'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Volume  $volume
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volume $volume)
    {
        //
    }
}
