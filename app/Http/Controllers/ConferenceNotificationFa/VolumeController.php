<?php

namespace App\Http\Controllers\ConferenceNotificationFa;

use App\Cities;
use App\Conference;
use App\ConferenceVolume;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function create(Conference $conference)
    {
        $cities = Cities::where('countries_id', $conference->country)->get();
        return view('conference.fa.panel.new_volume',compact('conference','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Conference $conference)
    {
        $request->validate([
            'city' => 'required',
            'place' => 'required',
            'website' => 'required',

            'poster' => 'required|mimes:jpg,png,jpeg',

            'address.*' => 'required',
            'tell.*' => 'required|numeric',
            'email.*' => 'required|email',
            'organizer.*' => 'required',

            'description' => 'required',

            'job.*' => 'required',
            'fullname.*' => 'required',

            'start_date' => 'required',
            'end_date' => 'required',
            'sendAbstractDate' => 'required',
            'sendArticleDate' => 'required',
            'declareRefereeDate' => 'required',
            'deadTime' => 'required',
        ], []);
        try {
            $inputs = $request->all();

            $information = array();
            for ($i = 0; $i < count($inputs['email']); $i++) {
                $info = array(
                    'email' => $inputs['email'][$i],
                    'address' => $inputs['address'][$i],
                    'tell' => $inputs['tell'][$i],
                    'fax' => $inputs['fax'][$i],
                );
                array_push($information, $info);
            }
            $contacts = json_encode($information);

            $dirname = uniqid();
            $dir = $conference->dir . "/" . $dirname;
            if (!is_dir(public_path($dir))) {
                mkdir(public_path($dir));
            }

            //upload poster
            $poster_pic = $request->file('poster');
            $poster_pic->move(public_path($dir), 'poster' . '.' . $poster_pic->getClientOriginalExtension());

            foreach ($inputs['job'] as $key => $name) {
                if (isset($inputs['organizer'][$key])) {
                    $inputs['organizer'][$key]->move(public_path($dir), $inputs['organizer'][$key]->getClientOriginalName());
                    sleep(1);
                    $organizers[] = ['job' => $inputs['job'][$key], 'name' => $inputs['fullname'][$key], 'image' => $inputs['organizer'][$key]->getClientOriginalName()];
                } else {
                    $organizers[] = ['job' => $inputs['job'][$key], 'name' => $inputs['fullname'][$key], 'image' => ''];
                }
            }
            ConferenceVolume::create([
                'conference_id' => $conference->id ,

                'city' => $inputs['city'],
                'place' => $inputs['place'],
                'website' => $inputs['website'],

                'contancts' => $contacts,
                'organizers' => $organizers,

                'description' => $inputs['description'],

                'start_date' => $inputs['start_date'],
                'end_date' => $inputs['end_date'],

                'sendAbstractDate' => $inputs['sendAbstractDate'],
                'sendArticleDate' => $inputs['sendArticleDate'],
                'declareRefereeDate' => $inputs['declareRefereeDate'],
                'deadTime' => $inputs['deadTime'],

                'dir' => $dir,
                'poster'=> 'poster' . '.' . $poster_pic->getClientOriginalExtension(),
            ]);
            alert()->success("دوره کنفرانس با موفقیت ثبت شد");
            return redirect()->to(route('conference.notice.dashboard.fa'));
        }catch (\Exception $e){
            alert()->warning("خطا در ثبت دوره","اخطار");
            return redirect()->to(route('conference.notice.dashboard.fa'));
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
