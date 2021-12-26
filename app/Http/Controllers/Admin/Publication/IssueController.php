<?php

namespace App\Http\Controllers\Admin\Publication;

use App\Issue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
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
        $find=Issue::where(['volume_id'=>$inputs['volume_id'],'duration'=>$inputs['duration']])->first();
        if(!empty($find)){
            return response()->json([
                'message'=>'duplicate'
            ]);
        }
        if( isset($inputs['special_issue']) && isset($inputs['special_description']) ) {
            $validator = Validator::make($request->all(), [
                'volume_id' => 'required',
                'duration' => 'required',
                'pages_number_from' => 'required|numeric',
                'pages_number_to' => 'required|numeric',
                'special_issue'=>'required' ,
                'special_description'=>'required' ,
            ], [
                'special_issue'=>'required|numeric' ,
                'special_description'=>'required' ,
            ]);

            if ($validator->fails()){
                $errors = $validator->errors();
                return response()->json(['message'=>'fail' , 'err'=>$errors]);
            }
            else{
                $inputs = $request->all();
                Issue::create([
                    'volume_id' => $inputs['volume_id'] ,
                    'duration' => $inputs['duration'] ,
                    'pages_number' => $inputs['pages_number_from'].'-'.$inputs['pages_number_to'],
                    'special' => $inputs['special_issue'] ,
                    'description' => $inputs['special_description'] ,
                ]);
                return response()->json(['message'=>'success']);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'volume_id' => 'required',
                'duration' => 'required',
                'pages_number_from' => 'required|numeric',
                'pages_number_to' => 'required|numeric',
            ]);

            if ($validator->fails()){
                $errors = $validator->errors();
                return response()->json(['message'=>'fail' , 'err'=>$errors]);
            }
            else{
                $inputs = $request->all();
                Issue::create([
                    'volume_id' => $inputs['volume_id'] ,
                    'duration' => $inputs['duration'] ,
                    'pages_number' => $inputs['pages_number_from'].'-'.$inputs['pages_number_to'],
                ]);
                return response()->json(['message'=>'success']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputs = $request->all();
        $find=Issue::where(['volume_id'=>$inputs['volume_id'],'duration'=>$inputs['duration']])->get();
        if(count($find) > 1){
            return response()->json([
                'message'=>'duplicate'
            ]);
        }
        if( isset($inputs['special_issue']) && isset($inputs['special_description']) ) {
            $validator = Validator::make($request->all(), [
                'issue_id' => 'required',
                'duration' => 'required',
                'pages_number_from' => 'required|numeric',
                'pages_number_to' => 'required|numeric',
                'special_issue'=>'required|numeric' ,
                'special_description'=>'required' ,
            ], [
                'special_issue'=>'required|numeric' ,
                'special_description'=>'required' ,
            ]);
            if ($validator->fails()){
                $errors = $validator->errors();
                return response()->json(['message'=>'fail' , 'err'=>$errors]);
            }
            else{
                Issue::find($inputs['issue_id'])->update([
                    'duration' => $inputs['duration'],
                    'pages_number' => $inputs['pages_number_from'].'-'.$inputs['pages_number_to'],
                    'special' => $inputs['special_issue'],
                    'description' => $inputs['special_description'],
                ]);
                return response()->json(['message'=>'success']);
            }
        }else{
            $validator = Validator::make($request->all(), [
                'issue_id' => 'required',
                'duration' => 'required',
                'pages_number_from' => 'required|numeric',
                'pages_number_to' => 'required|numeric',
            ]);
            if ($validator->fails()){
                $errors = $validator->errors();
                return response()->json(['message'=>'fail' , 'err'=>$errors]);
            }
            else{
                Issue::find($inputs['issue_id'])->update([
                    'duration' => $inputs['duration'],
                    'pages_number' => $inputs['pages_number_from'].'-'.$inputs['pages_number_to'],
                    'special' => 0 ,
                    'description' => ''
                ]);
                return response()->json(['message'=>'success']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
