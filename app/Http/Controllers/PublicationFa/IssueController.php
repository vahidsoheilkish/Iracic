<?php

namespace App\Http\Controllers\PublicationFa;

use App\Issue;
use App\Publication;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        try {
            $find = Issue::where(['volume_id' => $inputs['volume_id'], 'duration' => $inputs['duration']])->first();
            if (!empty($find)) {
                alert()->error("مشخصات این شماره قبلا ثبت شده است");
                return back();
            }
        }catch (\Exception $e){
            alert()->error("لطفا ابتدا دوره خود را ثبت کنید","خطا")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        }
        if( isset($inputs['special_issue']) && isset($inputs['special_description']) ){
            $request->validate([
                'publisher_id'=>'required' ,
                'volume_id'=>'required' ,
                'duration'=>'required' ,
                'pages_number_from'=>'required|numeric' ,
                'pages_number_to'=>'required|numeric' ,
                'special_issue'=>'required|numeric' ,
                'special_description'=>'required' ,
            ],[
                'special_description.required' => 'توضیحات شماره را تایپ کنید',
            ]);
        }else{
            $request->validate([
                'publisher_id'=>'required' ,
                'volume_id'=>'required' ,
                'duration'=>'required' ,
                'pages_number_from'=>'required|numeric' ,
                'pages_number_to'=>'required|numeric'
            ],[
            ]);
        }

        $publisher_user = session()->get('publication_user');
        $publication = Publication::where('publication_user_id',$publisher_user->id)->first() ;
        if(empty($publication ) ){
            alert()->error("لطفا ابتدا نشریه خود را ثبت کنید","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        }
        if($this->checkPublicationActive($publication->id)){
            if(!$publisher_user){
                return redirect()->to( route('publication.dashboard.fa')  );
            }
            if( isset($inputs['special_issue']) && isset($inputs['special_description']) ) {
                try{
                    Issue::create([
                        'volume_id' => $inputs['volume_id'] ,
                        'duration' => $inputs['duration'] ,
                        'pages_number' => $inputs['pages_number_from'].'-'.$inputs['pages_number_to'],
                        'special' => $inputs['special_issue'],
                        'description' => $inputs['special_description'],
                    ]);
                }catch (\Exception $e){
                    alert()->error("شماره قبلا ثبت شده است","warning")->autoclose(3500);
                    return redirect()->to( route('publication.dashboard.fa')  );
                }
            }else{
                try{
                    Issue::create([
                        'volume_id' => $inputs['volume_id'] ,
                        'duration' => $inputs['duration'] ,
                        'pages_number' => $inputs['pages_number_from'].'-'.$inputs['pages_number_to'],
                    ]);
                }catch (\Exception $e){
                    alert()->error("شماره قبلا ثبت شده است","warning")->autoclose(3500);
                    return redirect()->to( route('publication.dashboard.fa')  );
                }
            }
            alert()->success("شماره با موفقیت ثبت شد","done")->autoclose(3500);
            return redirect(route('publication.dashboard.fa'));
        }else{
            return redirect()->to( route('publication.dashboard.fa')  );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
