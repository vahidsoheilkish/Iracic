<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'city'=>'required',
            'countries_id'=>'required'
        ],[]);
        $data=$request->all();
        try{
            Cities::create([
                'countries_id'=>$data['countries_id'],
                'name'=>$data['city']
            ]);
            alert()->success("شهر " . $data['city']  . "  با موفقیت ثبت شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در ثبت شهر","");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function show(Cities $cities)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function edit(Cities $cities)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cities $cities)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cities $city)
    {
        try{
            $city->delete();
            alert()->success("شهر " . $city->name  . "  با موفقیت حذف شد");
            return back();
        }catch (\Exception $e){
            alert()->error("خطا در حذف شهر","");
            return back();
        }
    }
}
