@extends('admin.master')
@section('styles')
    <style>
        #all_publications_tbl th,td{  text-align: center;  }
        #all_publications_tbl td{  font-size: 14px; }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer}
        .form_remove{vertical-align: middle; display: inline;}
        .form_remove:hover{}
        .active_publication{font-size:12px; font-family: Arial; font-weight: bolder; }
        .active_publication:hover{cursor: pointer; color:#222 !important; background: #f1c40f !important; }
        .remove_icon{position: relative; left:3px;}
        .edit_icon{line-height: 17px;}
        .submenu_option{background-color: #fff; box-shadow:0px 0px 5px #222222; padding:4px; list-style: none; position:absolute; display: none; border-radius: 4px; margin-right: -33px !important;min-width: 160px;}
        .submenu_option li {cursor:pointer; color:#222222; padding:4px 5px;text-align: right; font-size:13px;}
        .submenu_option li:hover { text-align: right; background-color: #993365; color:#fff;}
        .submenu_option a { text-decoration: none; color:#222;}
        .setting_icon{vertical-align: middle; margin:3px; min-width:20px; float:right;}
        .setting_text{text-align: left;}
        #btn_setting{font-size:12px; line-height: normal;}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        #publication_title{ padding:5px; color:#ff0f30; text-align: right; direction: rtl; font-weight:bolder }
        #publication_header{ padding:5px;  text-align: right; direction: rtl;  font-size:13px;}
        .icon_plus{color:#ff394f;}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .volumes_row{display: none;}
        .red{color:#ff394f}
        .green{color: #0ac282}
        .volume_remove{color:#ff394f}
        .volume_remove:hover{color:darkorange; transition: .3s}
        .volume_edit{vertical-align: -9px;}
        .volume_edit:hover{color:darkcyan; transition: .3s}
        .add_issue{color:forestgreen; vertical-align: middle;  margin: 0 4px;}
        .add_issue:hover{cursor: pointer; color: #c4b400; transition: .3s}
        #special_issue_description{display:none;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <div class="col-sm-4 tar">
                            <h2>???????? ????????????</h2>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 tal">
                            <a href="{{ route('admin.add.publication') }}" target="_blank" class="btn btn-sm btn-success">?????????? ????????
                                <span class="fa fa-plus"></span>
                            </a>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="all_publications_tbl" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>????????</th>
                                    <th>????????</th>
                                    <th>??????????</th>
                                    <th>??????????</th>
                                    <th>PrintISSN</th>
                                    <th>OnlineISSN</th>
                                    <th>?????????????? ??????????</th>
                                    <th>DOI</th>
                                    <th style="color:tomato;">??????????????</th>
                                </tr>
                                @foreach($publications as $publication)
                                    <tr>
                                        @php( $loop_index = $loop->index + 1 )
                                        <td><span class="fa fa-plus icon_plus green" onclick="displayVolumes(this , {{$loop_index}})"></span></td>
                                        <td style="font-weight: bolder;"><a href="{{ route('admin.publication.volume', ['publication'=>$publication])}}">{{ $publication->id }}</a></td>
                                        <td>{{ $publication->group_id }}</td>
                                        <td>{{ $publication->major_id }}</td>
                                        <td>{{ $publication->publication_user->name }}</td>
                                        <td>
                                            {{ $publication->title }} <br/>
                                        </td>
                                        <td>{{ $publication->printISSN }}</td>
                                        <td>{{ $publication->onlineISSN }}</td>
                                        <td>{{ $publication->dependency }}</td>
                                        <td>{{ $publication->DOI }}</td>
                                        <td class="options">
                                            <button id="btn_setting" class="btn btn-sm btn_purple" onclick="openSetting(this)">??????????????
                                                <span class="fa fa-caret-down" style="vertical-align: middle;"></span>
                                            </button>
                                            <ul class="submenu_option close">
                                                <li data-toggle="modal" data-target="#createVolume" publication-title="{{$publication->title}}" publication-id="{{$publication->_id}}" onclick="openVolumeModal(this)"><span class="fa fa-book setting_icon"></span><span class="setting_text">???????? ???????? (Volume)</span></li>
                                                <li data-toggle="modal" data-target="#sendNotification" publication-title="{{$publication->title}}" publication-id="{{$publication->publication_user->_id}}" onclick="openNotificationModal(this)"><span class="fa fa-sticky-note setting_icon"></span><span class="setting_text">?????????? Notification</span></li>

                                                <li>
                                                    <a href="{{ route('admin.publication.edit' , ['publication'=>$publication]) }}" id="publication_edit">
                                                        <span class="fa fa-edit edit_icon setting_icon"></span>
                                                        <span class="setting_text">???????????? ??????????</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                        @if(  $publication->volumes()->exists()  )
                                            <tr colspan="12" class="volumes_row volume_row_{{$loop_index}}" style="background-color: #c48b9f;">
                                                <td colspan="2">#</td>
                                                <td colspan="2">?????????? ??????????</td>
                                                <td colspan="2">??????</td>
                                                <td colspan="3" style="font-weight: bolder">??????????????</td>
                                            </tr>
                                            @foreach($publication->volumes as $volume)
                                                <tr class="volumes_row volume_row_{{$loop_index}}" style="background-color: #ffeeff">
                                                    <td colspan="2"><a href="{{ route('admin.publication.volume.issues' , ['group'=>$publication->group_id,'major'=>$publication->major_id,'publication'=> $publication ,'volume'=>$volume->id]) }}" style="color: #993365;font-weight: bolder;">{{ $volume->id }}</a></td>
                                                    <td colspan="2">{{ $volume->publication_id }}</td>
                                                    <td colspan="2">{{ $volume->year }}</td>
                                                    <td colspan="3">
                                                        <div style="display: inline-flex">
                                                            <a data-toggle="modal" data-target="#updateVolume" class="volume_update" publication-id="{{$volume->publication_id}}" volume-year="{{$volume->year}}" volume-id="{{$volume->id}}" href="#" style="margin:0 4px;">
                                                                <span class="fa fa-2x fa-edit volume_edit"></span>
                                                            </a>
                                                            <a data-toggle="modal" data-target="#createIssue" class="publication_issue" publication-lang="{{$publication->lang}}" publication-order="{{$publication->publisher_order}}" publication-title="{{$publication->title}}" publication-id="{{$volume->id}}"><span class="fa fa-2x fa-plus add_issue"></span></a>
                                                            <span class="setting_text" style="font-size:12px; font-weight:bolder; margin:6px;">"?????????? ???????? ?????????? ???????? (Issue)"</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @else
                                                <tr colspan="12" class="volumes_row volume_row_{{$loop_index}}">
                                                    <td colspan="10" class="red">???????? ???? ???????? ?????? ?????????? ???????? ??????????</td>
                                                </tr>
                                        @endif
                                @endforeach
                            </table>
                        </div>
                        <div class="tac" style="margin:30px auto;">
                            {!! $publications->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>

    <!-- modals -->
    <!-- The Create Volume Modal -->
    <div class="modal fade" id="createVolume" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h4 class="modal-title tar" id="exampleModalLabel">?????? ???????? ????????</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="display: inline-block; direction: rtl; padding:10px;">
                    <span id="publication_header">?????????? ?????????? : </span><span id="publication_title"></span>
                </div>
                <form action="{{ route('admin.publication.volume.store') }}" method="post">
                    @csrf
                    <input type="hidden" id="publication_id" name="publication_id" value=""/>
                    <div class="modal-body rtl">
                        <div class="form-group tac form-inline">
                            <label for="year" style="margin:10px;">?????? ????????????</label>
                            <input name="year" id="year" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer rtl">
                        <button type="submit" class="btn btn-sm btn-primary">?????? ????????</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- The Update Volume Modal -->
    <div class="modal fade" id="updateVolume" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h4 class="modal-title tar" id="exampleModalLabel">?????? ???????? ????????</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="hidden" id="publication_update" name="publication_id" value=""/>
                <input type="hidden" id="volume_input_id" name="volume_input_id" value=""/>
                <input type="hidden" id="_csrf" name="_csrf" value="{{ csrf_token() }}"/>
                <ul id="" class="err_list alert alert-danger" style="direction: rtl; display: none;">
                </ul>
                <div class="modal-body rtl">
                    <div class="form-group tac form-inline">
                        <label for="volume_year" style="margin:10px;">?????? ????????????</label>
                        <input type="text" name="year" id="volume_year" class="form-control"/>
                    </div>
                </div>
                <div class="modal-footer rtl">
                    <button type="button" id="volume_update" class="btn btn-sm btn-success">???????????? ????????</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Create Issue Modal -->
    <div class="modal fade" id="createIssue" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h5 class="modal-title tar" id="exampleModalLabel">?????? ?????????? ????????</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.publication.volume.issue.store') }}" method="post" id="issue_store_form">
                    <div id="err_container" class="alert alert-danger" style="direction: rtl;text-align: right; display:none;">
                        <ul class="err_list">
                        </ul>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="modal-body rtl">
                            <div class="form-group tar">
                                <input type="hidden" class="form-control" name="volume_id" id="volume_id">
                                <span type="text" id="publication_name"></span>
                            </div><hr/>
                            <div class="form-group tar">
                                <label for="duration" style="margin:10px;">?????? ????????????</label>
                                <select type="text" name="duration" id="duration" class="form-control">

                                </select>
                            </div>

                            <div class="form-group tar">
                                <label for="pages_number_from" style="margin:10px;">?????????? ???????? - ????????</label>
                                <input type="text" name="pages_number_from" id="pages_number_from" class="form-control"/>
                            </div>
                            <div class="form-group tar">
                                <label for="pages_number_to" style="margin:10px;">?????????? ???????? - ??????????</label>
                                <input type="text" name="pages_number_to" id="pages_number_to" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="special_issue">?????????? ????????</label>
                                <input type="checkbox" name="special_issue" id="special_issue" class="checkbox" value="1" style="vertical-align:-4px; margin:0 3px;" />
                            </div>
                            <div class="form-group" id="special_issue_description">
                                <label for="special_description">?????????????? ?????????? ????????</label>
                                <input type="text" id="special_description" name="special_description" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer rtl">
                        <button type="submit" class="btn btn-sm btn-warning">?????? ??????????</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Conference send notification -->
    <div class="modal fade" id="sendNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h4 class="modal-title tar" id="exampleModalLabel">?????????? ????????</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body rtl">
                    @if(isset($publication))
                        <form action="{{ route('admin.publication.send.notification' , ['conferenceUser'=>$publication->publication_user->id]) }}" method="post">
                            @csrf
                            <input type="hidden" id="publication_id_notification" name="publication_user_id"/>
                            <div class="form-group">
                                <label for="message">?????? ????????</label>
                                <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="modal-footer rtl">
                                <button type="submit" class="btn btn-sm btn-success">?????????? ????????</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('message' ,{
            contentsLangDirection: 'rtl'
        });
        $(document).ready(function(){
            $("#special_issue").click(function(){
                let special_issue = $(this);
                if(special_issue.prop('checked') == 1 ){
                    $("#special_issue_description").css('display','block');
                }else{
                    $("#special_issue_description").css('display','none');
                }
            });

            $("#special_issue").prop("checked" , false);
            $("#special_description").val('');

            $(".submenu_option li").mouseenter(function(){
                $(this).find('a,span').each(function(){
                   $(this).css('color','#fff');
                });
            });
            $(".submenu_option li").mouseleave(function(){
                $(this).find('a,span').each(function(){
                    $(this).css('color','#222');
                });
            });

            $(".volume_update").click(function(){
                let id = $(this).attr('publication-id');
                let volume = $(this).attr('volume-id');
                let year = $(this).attr('volume-year');
                $("#publication_update").val(id);
                $("#volume_year").val(year);
                $("#volume_input_id").val(volume);
            });

            $("#volume_update").click(function(){
                let id = $("#publication_update").val();
                let year = $("#volume_year").val();
                let volume = $("#volume_input_id").val();
                if(year == ""){
                    swal("?????? ???????? ???????? ??????");
                    return false;
                }
                let _csrf = $("#_csrf").val();
                $.ajax({
                    'url' : '/admin/publication/volume/update/'+id ,
                    'method' : 'post',
                    'data' : {'_token': _csrf , 'year' : year , 'id' : id , volume } ,
                    'dataType' : 'json' ,
                    'success' : function(data){
                        if(data.message=='success'){
                            swal("???????????? ????", "?????? ???????? ???? "+data.year+" ?????????? ??????", "success");
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }else if(data.message=="fail"){
                            swal("?????? ???????? ???????? ???? ?????????? ?????? ???????????? ?????????? ??????");
                        }else if(data.message =="error"){
                            $(".err_list").empty();
                            $(".err_list").show("fast");
                            for (let key in data.err) {
                                if (data.err.hasOwnProperty(key)) {
                                    $(".err_list").append('<li>'+data.err[key]+'</li>');
                                }
                            }
                        }else if(data.message == "duplicate"){
                            swal("?????? ???????? ???????????? ????????????");
                        }
                    }
                });

            });


            $(".publication_issue").click(function(){
                let id = $(this).attr('publication-id');
                let title = $(this).attr('publication-title');
                let lang = $(this).attr('publication-lang');
                let publish_order = $(this).attr('publication-order');
                let duration = $("#duration");
                $("#volume_id").val(id);
                $("#publication_name").html("?????? ?????????? ???????? ???????? ?????????? " + "<br/>" + title + "<br/>" + " ?? ?????????? ???????? " + id);
                duration.empty();
                switch (lang){
                    case 'en':
                        switch(publish_order){
                            case 'week':
                                duration.append('<option value="Week1">Week1</option>');
                                duration.append('<option value="Week2">Week2</option>');
                                duration.append('<option value="Week3">Week3</option>');
                                duration.append('<option value="Week4">Week4</option>');
                                duration.append('<option value="Week5">Week5</option>');
                                duration.append('<option value="Week6">Week6</option>');
                                duration.append('<option value="Week7">Week7</option>');
                                duration.append('<option value="Week8">Week8</option>');
                                duration.append('<option value="Week9">Week9</option>');
                                duration.append('<option value="Week10">Week10</option>');
                                duration.append('<option value="Week11">Week11</option>');
                                duration.append('<option value="Week12">Week12</option>');
                                duration.append('<option value="Week13">Week13</option>');
                                duration.append('<option value="Week14">Week14</option>');
                                duration.append('<option value="Week15">Week15</option>');
                                duration.append('<option value="Week16">Week16</option>');
                                duration.append('<option value="Week17">Week17</option>');
                                duration.append('<option value="Week18">Week18</option>');
                                duration.append('<option value="Week19">Week19</option>');
                                duration.append('<option value="Week20">Week20</option>');
                                duration.append('<option value="Week21">Week21</option>');
                                duration.append('<option value="Week22">Week22</option>');
                                duration.append('<option value="Week23">Week23</option>');
                                duration.append('<option value="Week24">Week24</option>');
                                duration.append('<option value="Week25">Week25</option>');
                                duration.append('<option value="Week26">Week26</option>');
                                duration.append('<option value="Week27">Week27</option>');
                                duration.append('<option value="Week28">Week28</option>');
                                duration.append('<option value="Week29">Week29</option>');
                                duration.append('<option value="Week30">Week30</option>');
                                duration.append('<option value="Week31">Week31</option>');
                                duration.append('<option value="Week32">Week32</option>');
                                duration.append('<option value="Week33">Week33</option>');
                                duration.append('<option value="Week34">Week34</option>');
                                duration.append('<option value="Week35">Week35</option>');
                                duration.append('<option value="Week36">Week36</option>');
                                duration.append('<option value="Week37">Week37</option>');
                                duration.append('<option value="Week38">Week38</option>');
                                duration.append('<option value="Week39">Week39</option>');
                                duration.append('<option value="Week40">Week40</option>');
                                duration.append('<option value="Week41">Week41</option>');
                                duration.append('<option value="Week42">Week42</option>');
                                duration.append('<option value="Week43">Week43</option>');
                                duration.append('<option value="Week44">Week44</option>');
                                duration.append('<option value="Week45">Week45</option>');
                                duration.append('<option value="Week46">Week46</option>');
                                duration.append('<option value="Week47">Week47</option>');
                                duration.append('<option value="Week48">Week48</option>');
                                duration.append('<option value="Week49">Week49</option>');
                                duration.append('<option value="Week50">Week50</option>');
                                duration.append('<option value="Week51">Week51</option>');
                                duration.append('<option value="Week52">Week52</option>');
                            break;
                            case 'biweek':
                                duration.append('<option value="Biweek1">Biweek1</option>');
                                duration.append('<option value="Biweek2">Biweek2</option>');
                                duration.append('<option value="Biweek3">Biweek3</option>');
                                duration.append('<option value="Biweek4">Biweek4</option>');
                                duration.append('<option value="Biweek5">Biweek5</option>');
                                duration.append('<option value="Biweek6">Biweek6</option>');
                                duration.append('<option value="Biweek7">Biweek7</option>');
                                duration.append('<option value="Biweek8">Biweek8</option>');
                                duration.append('<option value="Biweek9">Biweek9</option>');
                                duration.append('<option value="Biweek10">Biweek10</option>');
                                duration.append('<option value="Biweek11">Biweek11</option>');
                                duration.append('<option value="Biweek12">Biweek12</option>');
                                duration.append('<option value="Biweek13">Biweek13</option>');
                                duration.append('<option value="Biweek14">Biweek14</option>');
                                duration.append('<option value="Biweek15">Biweek15</option>');
                                duration.append('<option value="Biweek16">Biweek16</option>');
                                duration.append('<option value="Biweek17">Biweek17</option>');
                                duration.append('<option value="Biweek18">Biweek18</option>');
                                duration.append('<option value="Biweek19">Biweek19</option>');
                                duration.append('<option value="Biweek20">Biweek20</option>');
                                duration.append('<option value="Biweek21">Biweek21</option>');
                                duration.append('<option value="Biweek22">Biweek22</option>');
                                duration.append('<option value="Biweek23">Biweek23</option>');
                                duration.append('<option value="Biweek24">Biweek24</option>');
                                duration.append('<option value="Biweek25">Biweek25</option>');
                                duration.append('<option value="Biweek26">Biweek26</option>');
                            break;
                            case 'month':
                                duration.append('<option value="January">January</option>');
                                duration.append('<option value="February">February</option>');
                                duration.append('<option value="March">March</option>');
                                duration.append('<option value="April">April</option>');
                                duration.append('<option value="May">May</option>');
                                duration.append('<option value="June">June</option>');
                                duration.append('<option value="July">July</option>');
                                duration.append('<option value="August">August</option>');
                                duration.append('<option value="September">September</option>');
                                duration.append('<option value="October">October</option>');
                                duration.append('<option value="November">November</option>');
                                duration.append('<option value="December">December</option>');
                            break;
                            case 'bimonth':
                                duration.append('<option value="January,February">January,February</option>');
                                duration.append('<option value="March,April">March,April</option>');
                                duration.append('<option value="May,June">May,June</option>');
                                duration.append('<option value="July,August">July,August</option>');
                                duration.append('<option value="September,October">September,October</option>');
                                duration.append('<option value="November,December">November,December</option>');

                            break;
                            case 'season':
                                duration.append('<option value="winter">winter</option>');
                                duration.append('<option value="spring">spring</option>');
                                duration.append('<option value="summer">summer</option>');
                                duration.append('<option value="autumn">autumn</option>');
                            break;
                            case 'biseason':
                                duration.append('<option value="winter-spring">Winter Spring</option>');
                                duration.append('<option value="summer-autumn">Summer Autumn</option>');
                            break;
                            case 'triannual':
                                duration.append('<option value="January-April">January-April</option>');
                                duration.append('<option value="May-August">May-August</option>');
                                duration.append('<option value="September-December">September-December</option>');
                            break;
                            case 'annual':
                                duration.append('<option value="Current year">Current year</option>');
                            break;
                        }
                    break;
                    case 'fa':
                        switch(publish_order){
                            case 'week':
                                duration.append('<option value="????????1">????????1</option>');
                                duration.append('<option value="????????2">????????2</option>');
                                duration.append('<option value="????????3">????????3</option>');
                                duration.append('<option value="????????4">????????4</option>');
                                duration.append('<option value="????????5">????????5</option>');
                                duration.append('<option value="????????6">????????6</option>');
                                duration.append('<option value="????????7">????????7</option>');
                                duration.append('<option value="????????8">????????8</option>');
                                duration.append('<option value="????????9">????????9</option>');
                                duration.append('<option value="????????10">????????10</option>');
                                duration.append('<option value="????????11">????????11</option>');
                                duration.append('<option value="????????12">????????12</option>');
                                duration.append('<option value="????????13">????????13</option>');
                                duration.append('<option value="????????14">????????14</option>');
                                duration.append('<option value="????????15">????????15</option>');
                                duration.append('<option value="????????16">????????16</option>');
                                duration.append('<option value="????????17">????????17</option>');
                                duration.append('<option value="????????18">????????18</option>');
                                duration.append('<option value="????????19">????????19</option>');
                                duration.append('<option value="????????20">????????20</option>');
                                duration.append('<option value="????????21">????????21</option>');
                                duration.append('<option value="????????22">????????22</option>');
                                duration.append('<option value="????????23">????????23</option>');
                                duration.append('<option value="????????24">????????24</option>');
                                duration.append('<option value="????????25">????????25</option>');
                                duration.append('<option value="????????26">????????26</option>');
                                duration.append('<option value="????????27">????????27</option>');
                                duration.append('<option value="????????28">????????28</option>');
                                duration.append('<option value="????????29">????????29</option>');
                                duration.append('<option value="????????30">????????30</option>');
                                duration.append('<option value="????????31">????????31</option>');
                                duration.append('<option value="????????32">????????32</option>');
                                duration.append('<option value="????????33">????????33</option>');
                                duration.append('<option value="????????34">????????34</option>');
                                duration.append('<option value="????????35">????????35</option>');
                                duration.append('<option value="????????36">????????36</option>');
                                duration.append('<option value="????????37">????????37</option>');
                                duration.append('<option value="????????38">????????38</option>');
                                duration.append('<option value="????????39">????????39</option>');
                                duration.append('<option value="????????40">????????40</option>');
                                duration.append('<option value="????????41">????????41</option>');
                                duration.append('<option value="????????42">????????42</option>');
                                duration.append('<option value="????????43">????????43</option>');
                                duration.append('<option value="????????44">????????44</option>');
                                duration.append('<option value="????????45">????????45</option>');
                                duration.append('<option value="????????46">????????46</option>');
                                duration.append('<option value="????????47">????????47</option>');
                                duration.append('<option value="????????48">????????48</option>');
                                duration.append('<option value="????????49">????????49</option>');
                                duration.append('<option value="????????50">????????50</option>');
                                duration.append('<option value="????????51">????????51</option>');
                                duration.append('<option value="????????52">????????52</option>');
                            break;
                            case 'biweek':
                                duration.append('<option value="????????????1">????????????1</option>');
                                duration.append('<option value="????????????2">????????????2</option>');
                                duration.append('<option value="????????????3">????????????3</option>');
                                duration.append('<option value="????????????4">????????????4</option>');
                                duration.append('<option value="????????????5">????????????5</option>');
                                duration.append('<option value="????????????6">????????????6</option>');
                                duration.append('<option value="????????????7">????????????7</option>');
                                duration.append('<option value="????????????8">????????????8</option>');
                                duration.append('<option value="????????????9">????????????9</option>');
                                duration.append('<option value="????????????10">????????????10</option>');
                                duration.append('<option value="????????????11">????????????11</option>');
                                duration.append('<option value="????????????12">????????????12</option>');
                                duration.append('<option value="????????????13">????????????13</option>');
                                duration.append('<option value="????????????14">????????????14</option>');
                                duration.append('<option value="????????????15">????????????15</option>');
                                duration.append('<option value="????????????16">????????????16</option>');
                                duration.append('<option value="????????????17">????????????17</option>');
                                duration.append('<option value="????????????18">????????????18</option>');
                                duration.append('<option value="????????????19">????????????19</option>');
                                duration.append('<option value="????????????20">????????????20</option>');
                                duration.append('<option value="????????????21">????????????21</option>');
                                duration.append('<option value="????????????22">????????????22</option>');
                                duration.append('<option value="????????????23">????????????23</option>');
                                duration.append('<option value="????????????24">????????????24</option>');
                                duration.append('<option value="????????????25">????????????25</option>');
                                duration.append('<option value="????????????26">????????????26</option>');
                            break;
                            case 'month':
                                duration.append('<option value="??????????????">??????????????</option>');
                                duration.append('<option value="????????????????">????????????????</option>');
                                duration.append('<option value="??????????">??????????</option>');
                                duration.append('<option value="??????">??????</option>');
                                duration.append('<option value="??????????">??????????</option>');
                                duration.append('<option value="????????????">????????????</option>');
                                duration.append('<option value="??????">??????</option>');
                                duration.append('<option value="????????">????????</option>');
                                duration.append('<option value="??????">??????</option>');
                                duration.append('<option value="????">????</option>');
                                duration.append('<option value="????????">????????</option>');
                                duration.append('<option value="??????????">??????????</option>');
                            break;
                            case 'bimonth':
                                duration.append('<option value="??????????????,????????????????">??????????????,????????????????</option>');
                                duration.append('<option value="??????????,??????">??????????,??????</option>');
                                duration.append('<option value="??????????,????????????">??????????,????????????</option>');
                                duration.append('<option value="??????,????????">??????,????????</option>');
                                duration.append('<option value="??????,????">??????,????</option>');
                                duration.append('<option value="????????,??????????">????????,??????????</option>');
                            break;
                            case 'season':
                                duration.append('<option value="????????">????????</option>');
                                duration.append('<option value="??????????????">??????????????</option>');
                                duration.append('<option value="??????????">??????????</option>');
                                duration.append('<option value="????????????">????????????</option>');
                            break;
                            case 'biseason':
                                duration.append('<option value="????????-??????????????">????????-??????????????</option>');
                                duration.append('<option value="??????????-????????????">??????????-????????????</option>');
                            break;
                            case 'triannual':
                                duration.append('<option value="??????????????-??????">??????????????-??????</option>');
                                duration.append('<option value="??????????-????????">??????????-????????</option>');
                                duration.append('<option value="??????-??????????">??????-??????????</option>');
                            break;
                            case 'annual':
                                duration.append('<option value="?????? ????????">?????? ????????</option>');
                            break;
                        }
                    break;
                }
            });

            $("#issue_store_form").submit(function(e){
                e.preventDefault();
                let _csrf = $("#_csrf").val();
                let volume_id = $("#volume_id").val();
                let duration = $("#duration").val();
                let pages_number_from = $("#pages_number_from").val();
                let pages_number_to = $("#pages_number_to").val();
                let special = $("#special_issue");
                let special_description = $("#special_description").val();
                let special_issue;
                if(special.prop("checked") == true){
                    special_issue = 1;
                }else{
                    special_issue = 0;
                }
                $.ajax({
                    url: '{{ route("admin.publication.volume.issue.store") }}' ,
                    method: "POST",
                    dataType: 'json',
                    data :  {'_token' : _csrf , 'volume_id':volume_id, 'duration' : duration , special_issue , special_description, 'pages_number_from':pages_number_from, 'pages_number_to':pages_number_to} ,
                    success : function(data){
                        if(data.message =="duplicate"){
                            swal("", "?????? ?????????? ???????????? ????????????", "error");
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }
                        if(data.message=="fail"){
                            $(".err_list").empty();
                            document.documentElement.scrollTop = 0;
                            $("#err_container").show("fast");
                            for (let key in data.err) {
                                if (data.err.hasOwnProperty(key)) {
                                    $(".err_list").append('<li>'+data.err[key]+'</li>');
                                }
                            }
                        }else if(data.message=="success"){
                            swal("", "?????????? ???? ???????????? ?????? ????", "success");
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }

                    }
                })
            });
        });

        function openNotificationModal(e){
            let id = $(e).attr('publication-id');
            let title = $(e).attr('publication-title');
            title = JSON.parse(title);
            $("#publication_id_notification").val(id);
            $("#publication_title").html(title.t1 + "<br/>" + title.t2);
        }

        function displayVolumes(e , id){
            if ( $(e).hasClass('fa-plus') ){
                $(".volume_row_"+id).show("fast");
                $(e).removeClass("fa-plus");
                $(e).removeClass("green");
                $(e).addClass("fa-minus");
                $(e).addClass("red");
            }else{
                $(".volume_row_"+id).hide("fast");
                $(e).removeClass("fa-minus");
                $(e).removeClass("red");
                $(e).addClass("fa-plus");
                $(e).addClass("green");
            }
        }

        function openVolumeModal(e){
            let id = $(e).attr('publication-id');
            let title = $(e).attr('publication-title');
            title = JSON.parse(title);
            $("#publication_id").val(id);
            $("#publication_title").html(title.t1 + "<br/>" + title.t2);

        }

        function openSetting(e){
            let parent = $(e).parent();
//            closeSettings();
            let ul = parent.children("ul");
            if(ul.hasClass('close')){
                ul.slideDown("fast");
                ul.removeClass("close");
                ul.addClass("open");
            } else if(ul.hasClass('open')){
                ul.slideUp("fast");
                ul.removeClass("open");
                ul.addClass("close");
            }
        }
        function closeSettings(){
            $('.submenu_option').each(function () {
                $(this).addClass('close');
                $(this).removeClass('open');
                $(this).fadeOut(200);
            });
        }
        $(".options").mouseleave(function(){
            closeSettings();
        });
        $(".submenu_option").mouseleave(function(){
            closeSettings();
        });

        $(".volume_delete_form").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "?????? ?????? ?????????? delete ???? ???????? ????????",
                text: "?????? ???????? ???? ?????? ???????? (volume) ?????????? ?????????????? ?????????? ??",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: "input",
                html: true
            })
                .then((value) => {
                    if(value=="delete"){
                        form.submit();
                    }else if(value==""){
                        swal("?????? ?????? ???????? ?????????? delete ???? ???????? ????????");
                        return false;
                    }else{
                        swal("?????????? delete ???????? ???????? ??????!");
                        return false;
                    }
                });
        });

        $("#active_select").change(function(){
            alert(this);
        })

    </script>
@endsection