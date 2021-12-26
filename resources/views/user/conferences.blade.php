@extends('user/master')
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
        .title_font{font-size:17px !important;}
    </style>
@endsection
@section('content')
    <div class="container-fluid container-publication-conference">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h3 id="publication_count" class="text-muted">Showing {{count($conferences)}} conferences</h3>
                    <img src="/img/user/spr.png" height="30" width="280"/>
                    <form class="col-12 search-container text-center">
                        <input type="text" id="search-bar" placeholder="search for conference">
                        <a href="#"><img class="search-icon" src="/img/user/search-icon2.png"></a>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid wow slideInRight" data-wow-duration="1s">
            <div class="row text-muted english-alphabet">
                <div class="col"><a href="#" letter="A" onclick="getByLetter(this)">A</a></div>
                <div class="col"><a href="#" letter="B" onclick="getByLetter(this)">B</a></div>
                <div class="col"><a href="#" letter="C" onclick="getByLetter(this)">C</a></div>
                <div class="col"><a href="#" letter="D" onclick="getByLetter(this)">D</a></div>
                <div class="col"><a href="#" letter="E" onclick="getByLetter(this)">E</a></div>
                <div class="col"><a href="#" letter="F" onclick="getByLetter(this)">F</a></div>
                <div class="col"><a href="#" letter="G" onclick="getByLetter(this)">G</a></div>
                <div class="col"><a href="#" letter="H" onclick="getByLetter(this)">H</a></div>
                <div class="col"><a href="#" letter="I" onclick="getByLetter(this)">I</a></div>
                <div class="col"><a href="#" letter="J" onclick="getByLetter(this)">J</a></div>
                <div class="col"><a href="#" letter="K" onclick="getByLetter(this)">K</a></div>
                <div class="col"><a href="#" letter="L" onclick="getByLetter(this)">L</a></div>
                <div class="col"><a href="#" letter="M" onclick="getByLetter(this)">M</a></div>
                <div class="col"><a href="#" letter="N" onclick="getByLetter(this)">N</a></div>
                <div class="col"><a href="#" letter="O" onclick="getByLetter(this)">O</a></div>
                <div class="col"><a href="#" letter="P" onclick="getByLetter(this)">P</a></div>
                <div class="col"><a href="#" letter="Q" onclick="getByLetter(this)">Q</a></div>
                <div class="col"><a href="#" letter="R" onclick="getByLetter(this)">R</a></div>
                <div class="col"><a href="#" letter="S" onclick="getByLetter(this)">S</a></div>
                <div class="col"><a href="#" letter="T" onclick="getByLetter(this)">T</a></div>
                <div class="col"><a href="#" letter="U" onclick="getByLetter(this)">U</a></div>
                <div class="col"><a href="#" letter="V" onclick="getByLetter(this)">V</a></div>
                <div class="col"><a href="#" letter="W" onclick="getByLetter(this)">W</a></div>
                <div class="col"><a href="#" letter="X" onclick="getByLetter(this)">X</a></div>
                <div class="col"><a href="#" letter="Y" onclick="getByLetter(this)">Y</a></div>
                <div class="col"><a href="#" letter="Z" onclick="getByLetter(this)">Z</a></div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin-top: 60px">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-3 left-sidebar">
                <div class="left-sidebar-content">
                    <h6 class="text-muted"><i class="fa fa-long-arrow-right text-info pr-2"></i>Publication Type</h6>
                    <div class="field-selection" style="padding: 0 10px;">
                        <select class="mt-2 ml-2">
                            <option value="group">Journal</option>
                            <option value="technic">Conferences</option>
                            <option value="basic">Books</option>
                        </select>
                    </div>
                    <h6 class="text-muted"><i class="fa fa-long-arrow-right text-info pr-2"></i>Refine Publications by</h6>
                    <div class="field-selection">
                        <i style="margin: 10px;">Group</i><select id="group_select" class="mt-3 ml-2">
                            @foreach($groups_list as $gp)
                                @php($group_name = json_decode($gp->name))
                                <option value="{{$gp->id}}" {{ $group->id == $gp->id ? 'selected=selected' : ''}}>{{$group_name->en}}</option>
                            @endforeach
                        </select>
                    </div>
                    <p id="select_major">Now select your field<i class="fa fa-2x fa-arrow-down" style="margin:0 6px; vertical-align: middle; color:tomato;"></i></p>
                    <div class="field-selection">
                        <i style="margin: 15px;">Field</i><select id="major_select" class="mt-3 ml-2"></select>
                    </div>
                    <h6><i class="fa fa-long-arrow-right text-info pr-2"></i>Access Type</h6>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="dCheckbox" type="checkbox" class="custom-control-input">
                        <label for="dCheckbox" class="custom-control-label">open access</label>
                    </div>
                    <div class="custom-control custom-checkbox ml-4 mb-lg-5">
                        <input id="cCheckbox" type="checkbox" class="custom-control-input">
                        <label for="cCheckbox" class="custom-control-label">special issue</label>
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
                                <a href="{{route('conference.link',['id'=>$conference->id,'conference'=>$conference->slug] )}}">
                                <span class="section-text1">{{ $title->l1 }}</span>
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
                                $("#major_select").append('<option value="'+value._id+'">'+major_name.en+'</option>');
                            })
                        }
                    });

                    $.ajax({
                        'url' : '/pi/conference/group/' + group +'/major/' + -1 ,
                        'type' : 'post',
                        'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : -1},
                        'success' : function(data){
                            $(".first-letter").html("All");
                            $("#progressbar").hide("fast");
                            $("#loading_container").hide("fast");
                            $("#publication_count").html('Showing '+ data.length +' publications');
                            $(".journals").empty();
                            history.pushState('data to be passed', 'Title of the page', '/conference/group/'+group+'/major/'+ -1);
                            $("#group_id").val(group);
                            $("#major_id").val(-1);
                            $("#pagination").empty();
                            if(data.length > 0){
                                $.each(data , (key,val)=>{
                                    let title = JSON.parse(val.title);
                                    $("#journals_list").append('<li class="journals-section">\n' +
                                        '                                <a href="/conference/'+ val._id +'/'+ val.slug +' ">\n' +
                                        '                                <p class="section-text1 title_font alert alert-success">'+ title.l1 +'</p>\n' +
                                        '                                <p class="section-text1 title_font alert alert-info">'+ title.l2 +'</p>\n' +
                                        '                                </a>\n' +
                                        '                                <div class="section-text2">\n' +
                                        '                                    <span class="text-1 text-muted">journal</span>\n' +
                                        '                                    &diam;\n' +
                                        '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                        '                                </div>\n' +
                                        '                            </li>\n' +
                                        '                            <hr class="line">');
                                });
                            }else{
                                $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">No conference Found</li>');
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
                            $("#major_select").append('<option value="'+value._id+'">'+major_name.en+'</option>');
                        });
                        let major= $("#major_select option:first").val();
                        history.pushState('data to be passed', 'Title of the page', '/conference/group/'+group+'/major/'+major);
                        $("#group_id").val(group);
                        $("#major_id").val(major);
                    }
                });
                $.ajax({
                    'url' : '/pi/conference/group/' + group +'/major/' + -1 ,
                    'type' : 'post',
                    'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : -1},
                    'success' : function(data){
                        $(".first-letter").html("All");
                        $("#progressbar").hide("fast");
                        $("#loading_container").hide("fast");
                        $("#publication_count").html('Showing '+ data.length +' conferences');
                        $(".journals").empty();
                        history.pushState('data to be passed', 'Title of the page', '/conference/group/'+group+'/major/'+ -1);
                        $("#group_id").val(group);
                        $("#major_id").val(-1);
                        $("#pagination").empty();
                        if(data.length > 0){
                            $.each(data , (key,val)=>{
                                let title = JSON.parse(val.title);
                                $("#journals_list").append('<li class="journals-section">\n' +
                                    '                                <a href="/conference/'+ val._id + '/' + val.slug +' ">\n' +
                                    '                                <span class="section-text1">'+ title.l1 +'</span>\n' +
                                    '                                </a>\n' +
                                    '                                <div class="section-text2">\n' +
                                    '                                    <span class="text-1 text-muted">conference</span>\n' +
                                    '                                    &diam;\n' +
                                    '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                    '                                </div>\n' +
                                    '                            </li>\n' +
                                    '                            <hr class="line">');
                            });
                        }else{
                            $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">No conference Found</li>');
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
                    'url' : '/pi/conference/group/' + group +'/major/' + major ,
                    'type' : 'post',
                    'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : major},
                    'success' : function(data){
                        $(".first-letter").html("All");
                        $("#select_major").hide("fast");
                        $("#progressbar").hide("fast");
                        $("#loading_container").hide("fast");
                        $("#publication_count").html('Showing '+ data.length +' conferences');
                        $(".journals").empty();
                        history.pushState('data to be passed', 'Title of the page', '/conference/group/'+group+'/major/'+major);
                        $("#group_id").val(group);
                        $("#major_id").val(major);
                        $("#pagination").empty();
                        if(data.length > 0){
                            $.each(data , (key,val)=>{
                                let title = JSON.parse(val.title);
                                $("#journals_list").append('<li class="journals-section">\n' +
                                    '                                <a href="/conference/'+ val._id + '/' + val.slug +' ">\n' +
                                    '                                <span class="section-text1">'+ title.l1 +'</span>\n' +
                                    '                                </a>\n' +
                                    '                                <div class="section-text2">\n' +
                                    '                                    <span class="text-1 text-muted">conference</span>\n' +
                                    '                                    &diam;\n' +
                                    '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                    '                                </div>\n' +
                                    '                            </li>\n' +
                                    '                            <hr class="line">');
                            });
                        }else{
                            $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">No conference Found</li>');
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
                                    '                                <a href="/conference/'+ val._id + '/' + val.slug +' ">\n' +
                                    '                                <span class="section-text1">'+ title.l1 +'</span>\n' +
                                    '                                </a>\n' +
                                    '                                <div class="section-text2">\n' +
                                    '                                    <span class="text-1 text-muted">conference</span>\n' +
                                    '                                    &diam;\n' +
                                    '                                    <span class="text-2 text-muted">'+ val.place +'</span>\n' +
                                    '                                </div>\n' +
                                    '                            </li>\n' +
                                    '                            <hr class="line">');
                            });
                        }else{
                            $("#journals_list").append('<li class="alert alert-danger" style="text-align:center;">No conference Found</li>');
                        }
                    }
                }
            });
        }

    </script>
@endsection