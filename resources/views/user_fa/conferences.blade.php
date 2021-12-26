@extends('user_fa/master')
@section('styles')
    <style>
        #publications_tbl{}
        #publications_tbl tr,td{text-align:left}
        #publications_tbl td:nth-child(2){width:6%; text-align:center}
        #publication_count{margin:30px; font-weight:normal; text-align:center}
        #pagination{text-align:center; margin:auto;}
        #major_helper{display:none;text-align:right;width:100%;font-size:14px;position: relative; animation-name: top_bottom; animation-duration:.5s; animation-iteration-count: infinite; }
        @keyframes top_bottom { from{bottom:0} to{bottom:-10px;} }
        @-webkit-keyframes slide-top {
            0% {-webkit-transform: translateY(0);transform: translateY(0);}
            100% {-webkit-transform: translateY(20px);transform: translateY(20);} }
        @keyframes slide-top {
            0% {-webkit-transform: translateY(0);transform: translateY(0);}
            100% {-webkit-transform: translateY(20px);transform: translateY(20px);} }
        #select_major{display:none; font-size:13px; padding:0 6px; text-align: right;position: relative;top:6px; animation-name: slide-top; animation-duration: 1s; animation-iteration-count: infinite;}
    </style>
@endsection
@section('content')
    <div class="container-fluid container-publication-conference">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3 id="publication_count" class="text-muted">{{count($conferences)}} کنفرانس پیدا شد</h3>
                    <img src="/img/user/spr.png" height="30" width="280"/>
                    <form class="col-12 search-container text-center" style="margin:0 auto;">
                        <input type="text" id="search-bar" placeholder="search for conference">
                        <a href="#"><img class="search-icon" src="/img/user/search-icon2.png"></a>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid wow slideInRight" data-wow-duration="1s">
            <div class="row text-muted english-alphabet" style="margin:auto;">
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="الف">الف</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ب">ب</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="پ">پ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ت">ت</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ث">ث</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ج">ج</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="چ">چ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ح">ح</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="خ">خ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="د">د</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ذ">ذ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ر">ر</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ز">ز</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ژ">ژ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="س">س</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ش">ش</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ص">ص</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ض">ض</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ط">ط</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ظ">ظ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ع">ع</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="غ">غ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ف">ف</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ق">ق</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ک">ک</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="گ">گ</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ل">ل</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="م">م</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ن">ن</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="و">و</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ه">ه</a></div>
                <div class="col" style="padding:0;"><a href="#" onclick="getByLetter(this)" letter="ی">ی</a></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 60px">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-3 left-sidebar">
                <div class="left-sidebar-content">
                    <h6 class="text-muted">نوع انتشار<i class="fa fa-long-arrow-left text-info pr-2"></i></h6>
                    <div class="field-selection" style="padding: 0 10px;">
                        <select class="mt-2 ml-2">
                            <option value="group">مجلات</option>
                            <option value="technic">کنفرانس ها</option>
                            <option value="basic">کتب</option>
                        </select>
                    </div>
                    <h6 class="text-muted">فیلتر براساس<i class="fa fa-long-arrow-left text-info pr-2"></i></h6>
                    <div class="field-selection">
                        <i style="margin: 10px;">گروه</i><select id="group_select" class="mt-3 ml-2">
                            @foreach($groups_list as $gp)
                                @php($group_name = json_decode($gp->name))
                                <option value="{{$gp->id}}" {{ $group->id == $gp->id ? 'selected=selected' : ''}}>{{$group_name->fa}}</option>
                            @endforeach
                        </select>
                    </div>
                    <p id="select_major">رشته را انتخاب کنید<i class="fa fa-2x fa-arrow-down" style="margin:0 6px; vertical-align: middle; color:tomato;"></i></p>
                    <div class="field-selection" style="display: flex;">
                        <i style="margin: 15px; vertical-align: middle; padding-top:7px;">رشته</i><select id="major_select" class="mt-3 ml-2"></select>
                    </div>
                    <h6>انواع دسترسی<i class="fa fa-long-arrow-left text-info pr-2"></i></h6>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="dCheckbox" type="checkbox" class="custom-control-input">
                        <label for="dCheckbox" class="custom-control-label">دانلود رایگان</label>
                    </div>
                    <div class="custom-control custom-checkbox ml-4 mb-lg-5">
                        <input id="cCheckbox" type="checkbox" class="custom-control-input">
                        <label for="cCheckbox" class="custom-control-label">شماره ویژه</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9 right-sidebar">
                <div class="right-sidebar-content">
                    <p class="first-letter">All</p>
                    <ul id="journals_list" class="journals">
                        @foreach($conferences as $conference)
                            @php($title = json_decode($conference->title) )
                            <li class="journals-section">
                                <a href="{{route('user.fa.conference.page',['id'=>$conference->id,'conference'=>$conference->slug] )}}">
                                <span class="section-text1">{{ $title->l2 }}</span>
                                </a>
                                <div class="section-text2">
                                    <span class="text-1 text-muted">conference</span>
                                    &diam;
                                    <span class="text-2 text-muted">{{ $conference->place }}</span>
                                </div>
                            </li>
                            <hr class="line">
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="group_id" value="{{$group->id}}">
    <input type="hidden" id="major_id" value="{{$major != null ? $major->id : ''}}">
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#major_select").empty();
            $("#group_select > option").each(function() {
                if ( $(this).attr("selected") == "selected" ) {
                    let group = this.value;
                    $("#loading_container").show("fast");
                    $.ajax({
                        'url' : '/group/' + group ,
                        'type' : 'post',
                        'data' : {'_token' : '{{ csrf_token() }}', 'group' : group},
                        'success' : function(data){
                            $("#loading_container").hide("fast");
                            $("#major_select").append('<option value="-1">All Field</option>');
                            $.each(data,(key,value)=>{
                                let major_name = JSON.parse(value.name);
                                $("#major_select").append('<option value="'+value.id+'">'+major_name.fa+'</option>');
                            })
                        }
                    });

                    $.ajax({
                        'url' : '/fa/pi/conference/group/' + group +'/major/' + -1 ,
                        'type' : 'post',
                        'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : -1},
                        'success' : function(data){
                            $(".first-letter").html("All");
                            $("#progressbar").hide("fast");
                            $("#loading_container").hide("fast");
                            $("#publication_count").html(data.length +' کنفرانس یافت شده است ');
                            $(".journals").empty();
                            history.pushState('data to be passed', 'Title of the page', '/fa/conference/group/'+group+'/major/'+ -1);
                            $("#group_id").val(group);
                            $("#major_id").val(-1);
                            $("#pagination").empty();
                            if(data.length > 0){
                                $.each(data , (key,val)=>{
                                    let title = JSON.parse(val.title);
                                    $("#journals_list").append('<li class="journals-section">\n' +
                                        '                                <a href="/fa/conference/'+ val._id + "/" +val.slug +' ">\n' +
                                        '                                <span class="section-text1">'+ title.l2 +'</span>\n' +
                                        '                                </a>\n' +
                                        '                                <div class="section-text2">\n' +
                                        '                                    <span class="text-1 text-muted">کنفرانس</span>\n' +
                                        '                                    &diam;\n' +
                                        '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                        '                                </div>\n' +
                                        '                            </li>\n' +
                                        '                            <hr class="line">');
                                });
                            }else{
                                $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">کنفرانسی یافت نشد</li>');
                            }
                        }
                    });
                }
            });

            $("#group_select").change(function(){
                $("#progressbar").show("fast");
                $("#major_select").empty();
                let group = this.value;
                $.ajax({
                    'url' : '/group/' + group ,
                    'type' : 'post',
                    'data' : {'_token' : '{{ csrf_token() }}', 'group' : group},
                    'success' : function(data){
                        $(".first-letter").html("All");
                        $("#select_major").show("fast");
                        $("#major_helper").show("fast");
                        $("#progressbar").hide("fast");
                        $("#major_select").append('<option value="-1">All Field</option></option>');
                        $.each(data,(key,value)=>{
                            let major_name = JSON.parse(value.name);
                            $("#major_select").append('<option value="'+value._id+'">'+major_name.fa+'</option>');
                        });
                        let major= $("#major_select option:first").val();
                        history.pushState('data to be passed', 'Title of the page', '/fa/conference/group/'+group+'/major/'+major);
                        $("#group_id").val(group);
                        $("#major_id").val(major);
                    }
                });
                $.ajax({
                    'url' : '/fa/pi/conference/group/' + group +'/major/' + -1 ,
                    'type' : 'post',
                    'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : -1},
                    'success' : function(data){
                        $(".first-letter").html("All");
                        $("#progressbar").hide("fast");
                        $("#loading_container").hide("fast");
                        $("#publication_count").html(data.length +' یافت شده است');
                        $(".journals").empty();
                        history.pushState('data to be passed', 'Title of the page', '/fa/conference/group/'+group+'/major/'+ -1);
                        $("#group_id").val(group);
                        $("#major_id").val(-1);
                        $("#pagination").empty();
                        if(data.length > 0){
                            $.each(data , (key,val)=>{
                                let title = JSON.parse(val.title);
                                $("#journals_list").append('<li class="journals-section">\n' +
                                    '                                <a href="/fa/conference/'+ val._id + "/" +val.slug +' ">\n' +
                                    '                                <span class="section-text1">'+ title.l2 +'</span>\n' +
                                    '                                </a>\n' +
                                    '                                <div class="section-text2">\n' +
                                    '                                    <span class="text-1 text-muted">کنفرانس</span>\n' +
                                    '                                    &diam;\n' +
                                    '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                    '                                </div>\n' +
                                    '                            </li>\n' +
                                    '                            <hr class="line">');
                            });
                        }else{
                            $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">کنفرانسی یافت نشد</li>');
                        }
                    }
                });
            });

            $("#major_select").change(function(){
                $("#progressbar").show("fast");
                $("#major_helper").hide("fast");
                $("#loading_container").show("fast");
                let group_id = $("#group_select");
                let major_id = $("#major_select");
                let group = group_id.val();
                let major = major_id.val();
                $.ajax({
                    'url' : '/fa/pi/conference/group/' + group +'/major/' + major ,
                    'type' : 'post',
                    'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : major},
                    'success' : function(data){
                        $(".first-letter").html("All");
                        $("#select_major").hide("fast");
                        $("#progressbar").hide("fast");
                        $("#loading_container").hide("fast");
                        $("#publication_count").html(data.length +' یافت شده است');
                        $(".journals").empty();
                        history.pushState('data to be passed', 'Title of the page', '/fa/conference/group/'+group+'/major/'+major);
                        $("#group_id").val(group);
                        $("#major_id").val(major);
                        $("#pagination").empty();
                        if(data.length > 0){
                            $.each(data , (key,val)=>{
                                let title = JSON.parse(val.title);
                                $("#journals_list").append('<li class="journals-section">\n' +
                                    '                                <a href="/fa/conference/'+ val._id + "/" +val.slug +' ">\n' +
                                    '                                <span class="section-text1">'+ title.l2 +'</span>\n' +
                                    '                                </a>\n' +
                                    '                                <div class="section-text2">\n' +
                                    '                                    <span class="text-1 text-muted">کنفرانس</span>\n' +
                                    '                                    &diam;\n' +
                                    '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                    '                                </div>\n' +
                                    '                            </li>\n' +
                                    '                            <hr class="line">');
                            });
                        }else{
                            $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">کنفرانسی یافت نشد</li>');
                        }
                    }
                });
            });
        });

        function getByLetter(e){
            $("#progressbar").show("fast");
            let group = $("#group_id").val();
            let major = $("#major_id").val();
            let letter = $(e).attr("letter");
            $(".col a").removeClass("f-letter");
            $.ajax({
                url : '/conference/alphabetic/'+letter,
                type: 'post',
                dataType : 'json',
                data: {group , major, '_token':'{{ csrf_token() }}' } ,
                success : function(result){
                    $("#progressbar").hide("fast");
                    $(e).addClass("f-letter");
                    if(result.message="success"){
                        $("#journals_list").empty();
                        $(".first-letter").html(letter);
                        console.log(result.conferences.length);
                        if(result.conferences.length > 0){
                            $.each(result.conferences , (key,val)=>{
                                let title = JSON.parse(val.title);
                                $("#journals_list").append('<li class="journals-section">\n' +
                                    '                                <a href="/fa/conference/'+ val._id + "/" + val.slug +' ">\n' +
                                    '                                <span class="section-text1">'+ title.l2 +'</span>\n' +
                                    '                                </a>\n' +
                                    '                                <div class="section-text2">\n' +
                                    '                                    <span class="text-1 text-muted">کنفرانس</span>\n' +
                                    '                                    &diam;\n' +
                                    '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                    '                                </div>\n' +
                                    '                            </li>\n' +
                                    '                            <hr class="line">');
                            });
                        }else{
                            $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">کنفرانسی یافت نشد</li>');
                        }
                    }
                }
            });
        }

    </script>
@endsection