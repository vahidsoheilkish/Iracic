<?php

namespace App\Http\Controllers\PublicationFa;

use App\Publication;
use App\Volume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class VolumeController extends Controller
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
        //  store new volume (post method)
        App::setLocale('fa');
        $request->validate([
            'publication_id' => 'required',
            'year' => 'required|numeric',
        ],[
            'publication_id.required' => 'Please first submit your journal'
        ]);
        $inputs = $request->all();
        $vol = Volume::where(['publication_id'=>$inputs['publication_id'],'year'=>$inputs['year']])->first();
        if(!empty($vol)){
            alert()->error("This volume submitted before");
            return back();
        }
        $publisher_user = session()->get('publication_user');
        $publication = Publication::where('publication_user_id',$publisher_user->id)->first() ;
        if(empty($publication) ){
            alert()->error("Please first submit your journal","warning")->autoclose(3500);
            return redirect()->to( route('publication.dashboard.fa')  );
        }
        if($this->checkPublicationActive($publication->id)){
            try{
                Volume::create([
                    'publication_id' => $inputs['publication_id'] ,
                    'year' => $inputs['year'] ,
                ]);
                alert()->success("دوره با موفقیت ثبت شد","done")->autoclose(3500);
                return redirect()->to( route('publication.dashboard.fa')  );
            }catch (\Illuminate\Database\QueryException $e){
                alert()->error("دوره در این سال قبلا ثبت شده است","error")->autoclose(3500);
                return redirect()->to( route('publication.dashboard.fa')  );
            }
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
