@extends('user.master')
@section('styles')
    <style>
        #select_major{display:none; font-size:13px; padding:0 6px; text-align: right;position: relative;top:6px; animation-name: slide-top; animation-duration: 1s; animation-iteration-count: infinite;}
        @-webkit-keyframes slide-top {
            0% {-webkit-transform: translateY(0);transform: translateY(0);}
            100% {-webkit-transform: translateY(10px);transform: translateY(10);} }
        @keyframes slide-top {
            0% {-webkit-transform: translateY(0);transform: translateY(0);}
            100% {-webkit-transform: translateY(10px);transform: translateY(10px);} }
        .search_icons:hover{cursor: pointer;}
    </style>
@endsection
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <form class="search-form">
                    <div class="search-field-container">
                        <input type="text" id="title_search_input" class="search-field" placeholder="Conference Title"/>
                    </div>
                    <a href="#"><i onclick="search_conference('title')" class="fa fa-search pl-4 text-secondary"></i></a>
                </form>
                <form class="search-form">
                    <div class="search-field-container">
                        <input type="text" id="organizer_search_input"  class="search-field" placeholder="Organizer" />
                    </div>
                    <a href="#"><i onclick="search_conference('organizer')" class="fa fa-search pl-4 pt-3 text-secondary"></i></a>
                </form>
                <form class="search-form">
                    <div class="search-field-container">
                        <input type="text" id="code_search_input"  class="search-field" placeholder="Conference code" />
                    </div>
                    <a href="#"><i onclick="search_conference('code')" class="fa fa-search pl-4 pt-3 text-secondary"></i></a>
                </form>
                <hr>
                <div class="years">
                    <p>Year of the conference</p>
                    <div class="custom-control custom-checkbox mr-4">
                        <input onchange="searchByYear(2019)" value="2019" id="aCheckbox" type="checkbox" class="custom-control-input year_search">
                        <label for="aCheckbox" class="custom-control-label">2019</label><span class="pull-right">200</span>
                    </div>
                    <div class="custom-control custom-checkbox mr-4">
                        <input onchange="searchByYear(2018)" value="2018" id="fCheckbox" type="checkbox" class="custom-control-input year_search">
                        <label for="fCheckbox" class="custom-control-label">2018</label><span class="pull-right">200</span>
                    </div>
                    <div class="custom-control custom-checkbox mr-4">
                        <input onchange="searchByYear(2017)" value="2017" id="gCheckbox" type="checkbox" class="custom-control-input year_search">
                        <label for="gCheckbox" class="custom-control-label">2017</label><span class="pull-right">200</span>
                    </div>
                    <div class="custom-control custom-checkbox mr-4">
                        <input onchange="searchByYear(2016)" value="2016" id="hCheckbox" type="checkbox" class="custom-control-input year_search">
                        <label for="hCheckbox" class="custom-control-label">2016</label><span class="pull-right">200</span>
                    </div>
                    <div class="custom-control custom-checkbox mr-4">
                        <input onchange="searchByYear(2015)" value="2015" id="iCheckbox" type="checkbox" class="custom-control-input year_search">
                        <label for="iCheckbox" class="custom-control-label">2015</label><span class="pull-right">200</span>
                    </div>
                    <a class="badge badge-secondary text-white" data-toggle="modal" data-target="#myModal"> more</a>
                    <div class="modal" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header btns-Bpurple">
                                    <h4 class="modal-title">سال انتشار</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox72" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox72">1391</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox73" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox73">1390</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox74" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox74">1389</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox75" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox75">1388</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox76" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox76">1387</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox77" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox77">1386</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox78" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox78">1385</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox79" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox79">1384</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox80" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox80">1383</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox81" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox81">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox82" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox82">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox83" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox83">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox84" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox84">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox85" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox85">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox86" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox86">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox87" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox87">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox88" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox88">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox89" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox89">1382</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox90" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox90">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox91" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox91">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox92" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox92">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox93" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox93">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox94" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox94">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox95" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox95">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox96" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox96">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox97" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox97">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox98" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox98">1382</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox99" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox99">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox100" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox100">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox101" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox101">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox102" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox102">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox103" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox103">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox104" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox104">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox105" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox105">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox106" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox106">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox107" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox107">1382</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="countries">
                    <p class="mt-3">Countries</p>
                    @if(!empty($countries))
                        @foreach($countries as $country)
                            <div class="custom-control custom-checkbox ml-4">
                                <input id="{{$country->_id}}" type="checkbox" class="custom-control-input">
                                <label for="{{$country->_id}}" class="custom-control-label">{{ $country->name }}</label><span class="pull-right">500</span>
                            </div>
                        @endforeach
                    @endif
                    <hr>
                    <p class="mt-3">Cities</p>
                    @if(!empty($cities))
                        @foreach($cities as $city)
                            <div class="custom-control custom-checkbox ml-4">
                                <input id="{{$city->_id}}" type="checkbox" class="custom-control-input">
                                <label for="{{$city->_id}}" class="custom-control-label">{{ $city->name  }}</label><span class="pull-right">200</span>
                            </div>
                        @endforeach
                    @endif
                    <hr>
                    <p>Group</p>
                    <div class="form-group">
                        <select class="custom-select" id="group_id">
                            @foreach($groups_list as $group)
                                @php($group_name = json_decode($group->name) )
                                <option value="{{$group->id}}">{{ $group_name->en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <p>Field</p>
                    <div class="form-group">
                        <select class="custom-select" id="major_id">
                        </select>
                    </div>
                </div>
            </div>
            <div id="conferences_container" class="col-12 col-md-6">
                    @foreach($conferences as $conference)
                        <div class="row conference-notice shadow">
                            <div class="col-12 col-lg-2 notice-poster">
                                <img src="{{$conference->conference->dir}}/{{$conference->dir}}/{{$conference->poster}}">
                            </div>
                            <div class="col-12 col-lg-10 pl-4">
                                <p class="conference-notice-text"><a href="#">{{$conference->title}}</a></p>
                                <p class="conference-notice-text"><i class="fa fa-circle"></i>{{ $conference->place }}</p>
                                @php($start = strtotime($conference->start_date['date']) )
                                @php($city = \App\Cities::where('_id',$conference->city)->first() )
                                <p class="conference-notice-text"><i class="fa fa-circle"></i>{{  date('Y-m-d',$start)  }}</p>
                                <p class="conference-notice-text"><i class="fa fa-circle"></i>{{ $conference->conference->country }}، {{ $city->name }}</p>
                                <P class="conference-notice-text"><i class="fa fa-circle"></i>Dedicated code: {{ $conference->_id }}</P>
                            </div>
                            <div>
                                <p class="description">
                                    {{$conference->description}}
                                </p>
                                <div class="subject">
                                    <a href="{{ route('conference.notice.single.page' , ['conference'=>$conference->conference_id,'conference_volume'=>$conference->id]) }}" class="btn rounded-0 pull-right">Read More</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            <div class="col-12 col-md-3">
                <h6 class="title">advertisement</h6>
                <div class="text-center">
                    <div class="mt-1">
                        <img src="img/ad/images.jpg" height="70" width="230">
                    </div>
                    <div class="mt-3">
                        <img src="img/ad/21_ADD.jpg"  height="70" width="230">
                    </div>
                    <div class="mt-3">
                        <img src="img/ad/884b7c4e-9ff4-4932-99aa-00503f64bb48.jpg"  height="70" width="230">
                    </div>
                </div>
                <h6 class="title mt-3">Most Visited Conferences</h6>
                <div class="favorite shadow p-2">
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                    <span>Iran, Tehran University, 13 June 1398</span>
                    <br>
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                    <span>Iran, Tehran University, 13 June 1398</span>
                    <br>
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                    <span>Iran, Tehran University, 13 June 1398</span>
                    <br>
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                    <span>Iran, Tehran University, 13 June 1398</span>
                    <br>
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                    <span>Iran, Tehran University, 13 June 1398</span>
                    <br>
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                    <span>Iran, Tehran University, 13 June 1398</span>
                    <br>
                    <a href="#" class="Congress-title">Second Interactive Information Retrieval Conference</a>
                    <br>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            let group = $("#group_id").val();
            $.ajax({
                'url' : '/group/' + group ,
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'group' : group},
                'success' : function(data){
                    $("#select_major").show("fast");
                    $("#progressbar").hide("fast");
                    $.each(data,(key,value)=>{
                        let major_name = JSON.parse(value.name);
                        $("#major_id").append('<option value="'+value._id+'">'+major_name.en+'</option>');
                    });
                    let major= $("#major_select option:first").val();
                    $("#group_id").val(group);
                    $("#major_id").val(major);
                }
            });


            let years = document.getElementsByName("years_chk[]");
            for(k=0;k< years.length;k++)
            {
                if(years[k].checked ){
                    years[k].checked=false;
                }
            }
        });
        $("#group_id").change(function(){
            $("#progressbar").show("fast");
            $("#major_id").empty();
            let group = this.value;
            $.ajax({
                'url' : '/group/' + group ,
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'group' : group},
                'success' : function(data){
                    $("#select_major").show("fast");
                    $("#progressbar").hide("fast");
                    $.each(data,(key,value)=>{
                        let major_name = JSON.parse(value.name);
                        $("#major_id").append('<option value="'+value._id+'">'+major_name.en+'</option>');
                    });
                    let major= $("#major_select option:first").val();
                    $("#group_id").val(group);
                    $("#major_id").val(major);
                }
            });
        });

        $("#major_id").change(function(){
            $("#progressbar").show("fast");
            $("#major_helper").hide("fast");
            let group_id = $("#group_id");
            let major_id = $("#major_id");
            let group = group_id.val();
            let major = major_id.val();
            $.ajax({
                'url' : '/conferences/get/group/' + group +'/major/' + major ,
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : major},
                'success' : function(data){
                    $("html, body").animate({ scrollTop: 900 }, 600);
                    $("#select_major").hide("fast");
                    $("#progressbar").hide("fast");
                    if(data.length > 0){
                        $("#conferences_container").empty();
                        for(i=0; i<data.length; i++){
                            $("#conferences_container").append('<div class="row conference-notice">\n' +
                                '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                '                            <img src="/img/user/conference/poster1.jpg">\n' +
                                '                        </div>\n' +
                                '                        <div class="col-12 col-lg-10 pl-4 pt-2">\n' +
                                '                            <p class="conference-notice-text">'+data[i].title+'</p>\n' +
                                '                            <p class="conference-notice-text text-danger">-'+data[i].organizer+'</p>\n' +
                                '                            <p class="conference-notice-text">-'+data[i].startDate+'</p>\n' +
                                '                            <p class="conference-notice-text">-'+data[i].country+', '+data[i].city+'</p>\n' +
                                '                            <P class="conference-notice-text">-Organizer: '+data[i].ISSN+'</P>\n' +
                                '                            <p class="description">\n' +
                                '                                -'+data[i].description+'\n' +
                                '                            <div class="conference-notice-text sub_tags">' +
                                '                            </div><br/>'+
                                '                            </p>\n' +
                                '                            <a href="/conference/single/'+data[i].id+'" class="btn btn-info text-dark r-more">Read More</a>\n' +
                                '                        </div>\n' +
                                '                    </div>');
                            let conference_sub = data[i].conference_subjects.split(',');
                            for(j=0; j<conference_sub.length ;j++){
                                $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                            }
                        }
                    }else{
                        swal("", "Nothing found", "error");
                    }
                }
            });
        });

        function search_conference(search_type){
            switch(search_type){
                case 'title':
                    let title = $("#title_search_input").val();
                    if(title === ""){
                        swal("", "Please enter title", "error");
                    }else{
                        $("#progressbar").show("fast");
                        $.ajax({
                            'url' : '{{ route("conference.notice.search") }}',
                            'type' : 'post',
                            'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'title' , 'phrase' : title } ,
                            'success' : function(data){
                                $("#conferences_container").empty();
                                if(data.length > 0){
                                    for(i=0; i<data.length; i++){
                                        $("#conferences_container").append('<div class="row conference-notice shadow">\n' +
                                            '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                            '                            <img src="'+data[i].dir+'/'+data[i].volumes[i].dir+'/'+data[i].volumes[i].poster+'">\n' +
                                            '                        </div>\n' +
                                            '                        <div class="col-12 col-lg-10 pl-4">\n' +
                                            '                            <p class="conference-notice-text"><a href="#">'+data[i].title+'</a></p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].place +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].start_date['date'] +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].country +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>Dedicated code:'+ data[i]._id +' </p>\n' +
                                            '                        </div>\n' +
                                            '                        <div>\n' +
                                            '                            <p class="description">\n' +
                                            '                                '+data[i].volumes[i].description+'\n' +
                                            '                            </p>\n' +
                                            '                            <div class="subject">\n' +
                                            '                                <a href="/conferences/single/'+data[i]._id+'/'+data[i].volumes[i]._id+'" class="btn rounded-0 pull-right">Read More</a>\n' +
                                            '                            </div>\n' +
                                            '                        </div>\n' +
                                            '                    </div>');
                                        let conference_sub = data[i].subject.split(',');
                                        for(j=0; j<conference_sub.length ;j++){
                                            $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                                        }
                                    }
                                }else{
                                    swal("", "Nothing found", "error");
                                }
                            }
                        })
                    }
                break;
                case 'organizer':
                    let organizer = $("#organizer_search_input").val();
                    if(organizer === ""){
                        swal("", "Please enter organizer", "error");
                    }else{
                        $.ajax({
                            'url' : '{{ route("conference.notice.search") }}',
                            'type' : 'post',
                            'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'organizer' , 'phrase' : organizer } ,
                            'success' : function(data){
                                $("#conferences_container").empty();
                                if(data.length > 0){
                                    for(i=0; i<data.length; i++){
                                        $("#conferences_container").append('<div class="row conference-notice shadow">\n' +
                                            '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                            '                            <img src="'+data[i].dir+'/'+data[i].volumes[i].dir+'/'+data[i].volumes[i].poster+'">\n' +
                                            '                        </div>\n' +
                                            '                        <div class="col-12 col-lg-10 pl-4">\n' +
                                            '                            <p class="conference-notice-text"><a href="#">'+data[i].title+'</a></p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].place +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].start_date['date'] +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].country +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>Dedicated code:'+ data[i]._id +' </p>\n' +
                                            '                        </div>\n' +
                                            '                        <div>\n' +
                                            '                            <p class="description">\n' +
                                            '                                '+data[i].volumes[i].description+'\n' +
                                            '                            </p>\n' +
                                            '                            <div class="subject">\n' +
                                            '                                <a href="/conferences/single/'+data[i]._id+'/'+data[i].volumes[i]._id+'" class="btn rounded-0 pull-right">Read More</a>\n' +
                                            '                            </div>\n' +
                                            '                        </div>\n' +
                                            '                    </div>');
                                        let conference_sub = data[i].conference_subjects.split(',');
                                        for(j=0; j<conference_sub.length ;j++){
                                            $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                                        }
                                    }
                                }else{
                                    swal("", "Nothing found", "error");
                                }
                            }
                        })
                    }
                break;
                case 'code':
                    let code = $("#code_search_input").val();
                    if(code === ""){
                        swal("", "Please enter code", "error");
                    }else{
                        $.ajax({
                            'url' : '{{ route("conference.notice.search") }}',
                            'type' : 'post',
                            'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'code' , 'phrase' : code } ,
                            'success' : function(data){
                                $("#conferences_container").empty();
                                if(data.length > 0){
                                    for(i=0; i<data.length; i++){
                                        $("#conferences_container").append('<div class="row conference-notice shadow">\n' +
                                            '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                            '                            <img src="'+data[i].dir+'/'+data[i].volumes[i].dir+'/'+data[i].volumes[i].poster+'">\n' +
                                            '                        </div>\n' +
                                            '                        <div class="col-12 col-lg-10 pl-4">\n' +
                                            '                            <p class="conference-notice-text"><a href="#">'+data[i].title+'</a></p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].place +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].start_date['date'] +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].country +'</p>\n' +
                                            '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>Dedicated code:'+ data[i]._id +' </p>\n' +
                                            '                        </div>\n' +
                                            '                        <div>\n' +
                                            '                            <p class="description">\n' +
                                            '                                '+data[i].volumes[i].description+'\n' +
                                            '                            </p>\n' +
                                            '                            <div class="subject">\n' +
                                            '                                <a href="/conferences/single/'+data[i]._id+'/'+data[i].volumes[i]._id+'" class="btn rounded-0 pull-right">Read More</a>\n' +
                                            '                            </div>\n' +
                                            '                        </div>\n' +
                                            '                    </div>');
                                        let conference_sub = data[i].conference_subjects.split(',');
                                        for(j=0; j<conference_sub.length ;j++){
                                            $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                                        }
                                    }
                                }else{
                                    swal("", "Nothing found", "error");
                                }
                            }
                        })
                    }
                break;
            }
            $("#progressbar").hide("fast");
        }


        function searchByYear(year){
            let check = document.getElementsByClassName("year_search");
            let search =[];
            for(i=0 ; i<check.length; i++){
                if(check[i].checked == true){
                    search.push($(check[i]).attr('value'));
                }
            }
            $.ajax({
                'url' : '{{ route("conference.notice.search") }}',
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'year' , 'phrase' : search } ,
                'success': function(data){
                    $("#conferences_container").empty();
                    if(data.length > 0){
                        for(i=0; i<data.length; i++){
                            $("#conferences_container").append('<div class="row conference-notice shadow">\n' +
                                '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                '                            <img src="'+data[i].dir+'/'+data[i].volumes[i].dir+'/'+data[i].volumes[i].poster+'">\n' +
                                '                        </div>\n' +
                                '                        <div class="col-12 col-lg-10 pl-4">\n' +
                                '                            <p class="conference-notice-text"><a href="#">'+data[i].title+'</a></p>\n' +
                                '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].place +'</p>\n' +
                                '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].volumes[i].start_date['date'] +'</p>\n' +
                                '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>'+ data[i].country +'</p>\n' +
                                '                            <p class="conference-notice-text"><i class="fa fa-circle"></i>Dedicated code:'+ data[i]._id +' </p>\n' +
                                '                        </div>\n' +
                                '                        <div>\n' +
                                '                            <p class="description">\n' +
                                '                                '+data[i].volumes[i].description+'\n' +
                                '                            </p>\n' +
                                '                            <div class="subject">\n' +
                                '                                <a href="/conferences/single/'+data[i]._id+'/'+data[i].volumes[i]._id+'" class="btn rounded-0 pull-right">Read More</a>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>');
                            let conference_sub = data[i].conference_subjects.split(',');
                            for(j=0; j<conference_sub.length ;j++){
                                $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                            }
                        }
                    }else{
                        swal("", "Nothing found", "error");
                    }
                    $("#progressbar").hide("fast");
                }
            });
        }
    </script>
@endsection