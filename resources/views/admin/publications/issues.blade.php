@extends('admin.master')
@section('styles')
    <style>
        #tbl_issues th,td{  text-align: center;  }
        #tbl_issues td{  font-size: 14px; }
        #tbl_issues th{  font-size: 14px; }
        .icon_plus{color:#ff394f;}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .volumes_row{display: none;}
        .red{color:#ff394f}
        .green{color: #0ac282}
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline; position: relative; bottom:3px;}
        .btn_a:hover{cursor: pointer}
        .remove_icon{position: relative; left:3px;}
        .setting_text{text-align: left;}
        .issue_remove{color:#ff394f}
        .issue_remove:hover{color:darkorange; transition: .3s}
        .add_article_icon{color: rgba(27, 152, 9, 0.98);}
        .add_article_icon:hover{color: #c8c100; transition: .3s;}
        .issue_edit_icon{vertical-align:2px}
        .issue_edit_icon:hover{}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        .active_publication{font-size:12px; font-family: Arial; font-weight: bolder; vertical-align: 8px; }
        .active_publication:hover{cursor: pointer; color:#222 !important; background: #f1c40f !important; }
        #article_view{vertical-align: 3px; color:#007bff; }
        #article_view:hover{cursor: pointer; color:#646464; transition: .3s }
        .article_image{width:150px; border-radius:10px;margin:10px;}
        .article_file_container{margin:8px auto; background-color: #f1f1f1; border-radius:10px; padding:10px; }
        #special_issue_description{display:none;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h2 class="alert alert-primary tac">شماره های {{ $volume->id }}</h2>
                        <div class="col-sm-11">
                            <table id="tbl_issues" class="table table-bordered table-responsive">
                                <tr>
                                    <th style="width:60px;"></th>
                                    <th>#</th>
                                    <th>کد دوره volume</th>
                                    <th>شماره</th>
                                    <th>صفحه</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($issues as $issue)
                                    @php( $loop_index = $loop->index + 1 )
                                    @php( $pages_number = explode('-',$issue->pages_number) )
                                    <tr>
                                        <td><span class="fa fa-plus icon_plus green" onclick="displayVolumes(this , {{$loop_index}})"></span></td>
                                        <td>{{$issue->id}}</td>
                                        <td>{{$issue->volume_id}}</td>
                                        <td>{{$issue->duration}}</td>
                                        <td>{{$issue->pages_number}}</td>
                                        <td>
                                            <div style="display: inline-flex">
                                                {{--<form action="{{ route('admin.publication.issue.remove',['issue'=>$issue->id]) }}" method="post" class="issue_delete_form">--}}
                                                    {{--<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>--}}
                                                    {{--<button type="submit" class="btn_a">--}}
                                                        {{--<span class="fa fa-2x fa-remove issue_remove"></span>--}}
                                                    {{--</button>--}}
                                                {{--</form>--}}
                                                <a class="issue_edit" href="{{ route('admin.publication.edit' , ['issue'=>$issue->id]) }}" data-volume="{{$issue->volume->id}}" data-lang="{{$issue->volume->publication->lang}}" data-publish-order="{{$issue->volume->publication->publisher_order}}" data-id="{{$issue->id}}" data-duration="{{$issue->duration}}" data-page-from="{{trim($pages_number[0])}}" data-page-to="{{trim($pages_number[1])}}" data-toggle="modal" data-target="#issue_edit">
                                                    <span class="fa fa-2x fa-edit edit_icon setting_icon issue_edit_icon" style="margin:0 4px;"></span>
                                                </a>
                                                <a class="add_article" href="{{ route('publication.article.admin.create' , ['group'=>$group->id,'major'=>$major->id,'publication'=>$publication ,'volume'=> $issue->volume_id , 'issue'=>$issue->id]) }}">
                                                    <span class="fa fa-2x fa-book edit_icon setting_icon add_article_icon" style="margin:0 4px;"></span>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @if( $issue->articles()->exists() )
                                            <tr colspan="8" class="volumes_row volume_row_{{$loop_index}}" style="background-color:#cce5ff">
                                                <th colspan="1">#</th>
                                                <th colspan="2">عنوان مقاله</th>
                                                <th>DOI</th>
                                                <th>IOI</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            @foreach($issue->articles as $article)
                                                <tr colspan="8" class="volumes_row volume_row_{{$loop_index}}" style="background-color: #e9e9e9">
                                                    <td colspan="1">{{$article->id}}</td>
                                                    <td colspan="2">{{ $article->title }}</td>
                                                    <td>{{ $article->DOI }}</td>
                                                    <td>{{ $article->IOI }}</td>
                                                    <td>
                                                        <span id="article_view" data-toggle="modal" data-target="#articleInfo" article-id="{{$article->id}}" onclick="getArticle(this)" class="fa fa-2x fa-eye setting_icon"></span>
                                                        <a href="{{ route('publication.article.edit',['article'=>$article->id]) }}">
                                                            <span class="fa fa-2x fa-edit issue_edit_icon setting_icon"></span>
                                                        </a>
                                                        <form action="{{ route('publication.article.remove',['article'=>$article->id]) }}" method="post" class="form_remove" style="display: inline-flex;">
                                                            @csrf
                                                            <button class="btn_a" type="submit">
                                                                <span class="fa fa-2x fa-remove issue_remove setting_icon"></span>
                                                            </button>
                                                        </form>
                                                        @if($article->active == 0)
                                                            <span class="label label-danger active_publication"  publication-id="{{$publication->id}}" article-id="{{$article->id}}" onclick="changeActive(this)">Inactive</span>
                                                        @else
                                                            <span class="label label-success active_publication" publication-id="{{$publication->id}}"  article-id="{{$article->id}}" onclick="changeActive(this)">active</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr colspan="8" class="volumes_row volume_row_{{$loop_index}}">
                                                <td class="red alert-danger" colspan="8">مقاله ای برای این شماره وجود ندارد</td>
                                            </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>


    <!-- The Create Issue Modal -->
    <div class="modal fade" id="issue_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h5 class="modal-title tar" id="exampleModalLabel">ویرایش شماره</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.publication.issue.update') }}" method="post" id="issue_update_form">
                    <div id="err_container" class="alert alert-danger" style="direction: rtl;text-align: right; display:none;">
                        <ul id="err_list" style="list-style: disc;">
                        </ul>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="_token" value="{{csrf_token()}}" />
                        <div class="modal-body rtl">
                            <div class="form-group tar">
                                <input type="hidden" class="form-control" name="volume_id" id="volume_id">
                                <input type="hidden" class="form-control" name="issue_id" id="issue_id">
                                <span type="text" id="publication_name"></span>
                            </div><hr/>
                            <div class="form-group tar">
                                <label for="duration" style="margin:10px;">شماره انتشار</label>
                                <select name="duration" id="duration" class="form-control">
                                </select>
                            </div>
                            <div class="form-group tar">
                                <label for="pages_number_from" style="margin:10px;">شماره صفحه - شروع</label>
                                <input type="text" name="pages_number_from" id="pages_number_from" class="form-control"/>
                            </div>
                            <div class="form-group tar">
                                <label for="pages_number_to" style="margin:10px;">شماره صفحه - پایان</label>
                                <input type="text" name="pages_number_to" id="pages_number_to" class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="special_issue">شماره ویژه</label>
                                <input type="checkbox" name="special_issue" id="special_issue" class="checkbox" value="1" style="vertical-align:-4px; margin:0 3px;" />
                            </div>
                            <div class="form-group" id="special_issue_description">
                                <label for="special_description">توضیحات شماره ویژه</label>
                                <input type="text" id="special_description" name="special_description" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer rtl">
                        <button type="submit" class="btn btn-sm btn-warning">ثبت شماره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Article Information -->
    <div class="modal fade" id="articleInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1000px">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:15px;  direction:ltr;">
                        <h3 id="article_title"></h3>
                        <div class="row">
                            <div class="col-sm-4 tac">
                                <span class="label label-primary" style="margin:4px;">DOI: </span>
                                <span id="article_DOI"></span>
                            </div>
                            <div class="col-sm-4 tac">
                                <span class="label label-primary" style="margin:4px;">IOI: </span>
                                <span id="article_IOI"></span>
                            </div>
                            <div class="col-sm-4 tac">
                                <span class="label label-primary" style="margin:4px;">ID: </span>
                                <span id="article_id"></span>
                            </div>
                        </div>
                        <hr/>
                        <div class="row" style="margin:24px;">
                            <div class="col-sm-12 tal">
                                <span class="label label-primary" style="margin:4px;">Highlight: </span>
                                <span id="article_highlight"></span>
                            </div>
                        </div><hr/>
                        <div class="row">
                            <div class="col-sm-12 tal">
                                <span class="label label-primary" style="margin:4px;">Abstract: </span>
                                <span id="article_abstract"></span>
                            </div>
                        </div><hr/>
                        <div class="row" style="margin:30px;">
                            <div class="col-sm-12">
                                <table class="table table-responsive table-borderless" id="article_authors_tbl" >
                                </table>
                            </div>
                        </div>
                        <h2>Structs</h2>
                        <div class="" id="article_structs">

                        </div><hr/>
                        <div class="row" style="margin:20px 0;">
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Page Count: </span>
                                <span id="article_pageCount"></span>
                            </div>
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Page: </span>
                                <span id="article_page"></span>
                            </div>
                        </div><hr/>
                        <div class="row" style="margin:20px 0;">
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Publication Link: </span>
                                <span id="article_publication_link" style="font-size:12px;"></span>
                            </div>
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Keywords: </span>
                                <span id="article_keyword"></span>
                            </div>
                        </div><hr/>
                        <div id="article_resources" class="col-sm-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $("#special_issue").click(function(){
                let special_issue = $(this);
                if(special_issue.prop('checked') == 1 ){
                    $("#special_issue_description").css('display','block');
                }else{
                    $("#special_issue_description").css('display','none');
                    $("#special_description").val('');
                }
            });

            $("#special_issue").prop("checked" , false);
            $("#special_description").val('');

            $(".issue_delete_form").submit(function(e){
                let form = this;
                e.preventDefault();
                swal({
                    title: "جهت حذف عبارت delete را وارد کنید",
                    text: "آیا نسبت به حذف شماره (issue) نشریه اطمینان دارید ؟",
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
                            swal("جهت حذف باید عبارت delete را وارد کنید");
                            return false;
                        }else{
                            swal("عبارت delete وارد نشده است!");
                            return false;
                        }
                    });
            });

            $(".issue_edit").click(function(){
                let id = $(this).attr('data-id');
                let volume_id = $(this).attr('data-volume');
                let duration_data = $(this).attr('data-duration');
                let data_page_from = $(this).attr('data-page-from');
                let data_page_to = $(this).attr('data-page-to');
                let publish_order = $(this).attr('data-publish-order');
                let lang = $(this).attr('data-lang');
                $("#issue_id").val(id);
                $("#pages_number_from").val(data_page_from);
                $("#pages_number_to").val(data_page_to);
                $("#volume_id").val(volume_id);
                let duration = $("#duration");
                $("#duration").empty();
                duration.append('<option value="'+duration_data+'" selected>'+duration_data+'</option>');
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
                                duration.append('<option value="هفته1">هفته1</option>');
                                duration.append('<option value="هفته2">هفته2</option>');
                                duration.append('<option value="هفته3">هفته3</option>');
                                duration.append('<option value="هفته4">هفته4</option>');
                                duration.append('<option value="هفته5">هفته5</option>');
                                duration.append('<option value="هفته6">هفته6</option>');
                                duration.append('<option value="هفته7">هفته7</option>');
                                duration.append('<option value="هفته8">هفته8</option>');
                                duration.append('<option value="هفته9">هفته9</option>');
                                duration.append('<option value="هفته10">هفته10</option>');
                                duration.append('<option value="هفته11">هفته11</option>');
                                duration.append('<option value="هفته12">هفته12</option>');
                                duration.append('<option value="هفته13">هفته13</option>');
                                duration.append('<option value="هفته14">هفته14</option>');
                                duration.append('<option value="هفته15">هفته15</option>');
                                duration.append('<option value="هفته16">هفته16</option>');
                                duration.append('<option value="هفته17">هفته17</option>');
                                duration.append('<option value="هفته18">هفته18</option>');
                                duration.append('<option value="هفته19">هفته19</option>');
                                duration.append('<option value="هفته20">هفته20</option>');
                                duration.append('<option value="هفته21">هفته21</option>');
                                duration.append('<option value="هفته22">هفته22</option>');
                                duration.append('<option value="هفته23">هفته23</option>');
                                duration.append('<option value="هفته24">هفته24</option>');
                                duration.append('<option value="هفته25">هفته25</option>');
                                duration.append('<option value="هفته26">هفته26</option>');
                                duration.append('<option value="هفته27">هفته27</option>');
                                duration.append('<option value="هفته28">هفته28</option>');
                                duration.append('<option value="هفته29">هفته29</option>');
                                duration.append('<option value="هفته30">هفته30</option>');
                                duration.append('<option value="هفته31">هفته31</option>');
                                duration.append('<option value="هفته32">هفته32</option>');
                                duration.append('<option value="هفته33">هفته33</option>');
                                duration.append('<option value="هفته34">هفته34</option>');
                                duration.append('<option value="هفته35">هفته35</option>');
                                duration.append('<option value="هفته36">هفته36</option>');
                                duration.append('<option value="هفته37">هفته37</option>');
                                duration.append('<option value="هفته38">هفته38</option>');
                                duration.append('<option value="هفته39">هفته39</option>');
                                duration.append('<option value="هفته40">هفته40</option>');
                                duration.append('<option value="هفته41">هفته41</option>');
                                duration.append('<option value="هفته42">هفته42</option>');
                                duration.append('<option value="هفته43">هفته43</option>');
                                duration.append('<option value="هفته44">هفته44</option>');
                                duration.append('<option value="هفته45">هفته45</option>');
                                duration.append('<option value="هفته46">هفته46</option>');
                                duration.append('<option value="هفته47">هفته47</option>');
                                duration.append('<option value="هفته48">هفته48</option>');
                                duration.append('<option value="هفته49">هفته49</option>');
                                duration.append('<option value="هفته50">هفته50</option>');
                                duration.append('<option value="هفته51">هفته51</option>');
                                duration.append('<option value="هفته52">هفته52</option>');
                                break;
                            case 'biweek':
                                duration.append('<option value="دوهفته1">دوهفته1</option>');
                                duration.append('<option value="دوهفته2">دوهفته2</option>');
                                duration.append('<option value="دوهفته3">دوهفته3</option>');
                                duration.append('<option value="دوهفته4">دوهفته4</option>');
                                duration.append('<option value="دوهفته5">دوهفته5</option>');
                                duration.append('<option value="دوهفته6">دوهفته6</option>');
                                duration.append('<option value="دوهفته7">دوهفته7</option>');
                                duration.append('<option value="دوهفته8">دوهفته8</option>');
                                duration.append('<option value="دوهفته9">دوهفته9</option>');
                                duration.append('<option value="دوهفته10">دوهفته10</option>');
                                duration.append('<option value="دوهفته11">دوهفته11</option>');
                                duration.append('<option value="دوهفته12">دوهفته12</option>');
                                duration.append('<option value="دوهفته13">دوهفته13</option>');
                                duration.append('<option value="دوهفته14">دوهفته14</option>');
                                duration.append('<option value="دوهفته15">دوهفته15</option>');
                                duration.append('<option value="دوهفته16">دوهفته16</option>');
                                duration.append('<option value="دوهفته17">دوهفته17</option>');
                                duration.append('<option value="دوهفته18">دوهفته18</option>');
                                duration.append('<option value="دوهفته19">دوهفته19</option>');
                                duration.append('<option value="دوهفته20">دوهفته20</option>');
                                duration.append('<option value="دوهفته21">دوهفته21</option>');
                                duration.append('<option value="دوهفته22">دوهفته22</option>');
                                duration.append('<option value="دوهفته23">دوهفته23</option>');
                                duration.append('<option value="دوهفته24">دوهفته24</option>');
                                duration.append('<option value="دوهفته25">دوهفته25</option>');
                                duration.append('<option value="دوهفته26">دوهفته26</option>');
                                break;
                            case 'month':
                                duration.append('<option value="فروردین">فروردین</option>');
                                duration.append('<option value="اردیبهشت">اردیبهشت</option>');
                                duration.append('<option value="خرداد">خرداد</option>');
                                duration.append('<option value="تیر">تیر</option>');
                                duration.append('<option value="مرداد">مرداد</option>');
                                duration.append('<option value="شهریور">شهریور</option>');
                                duration.append('<option value="مهر">مهر</option>');
                                duration.append('<option value="آبان">آبان</option>');
                                duration.append('<option value="آذر">آذر</option>');
                                duration.append('<option value="دی">دی</option>');
                                duration.append('<option value="بهمن">بهمن</option>');
                                duration.append('<option value="اسفند">اسفند</option>');
                                break;
                            case 'bimonth':
                                duration.append('<option value="فروردین,اردیبهشت">فروردین,اردیبهشت</option>');
                                duration.append('<option value="خرداد,تیر">خرداد,تیر</option>');
                                duration.append('<option value="مرداد,شهریور">مرداد,شهریور</option>');
                                duration.append('<option value="مهر,آبان">مهر,آبان</option>');
                                duration.append('<option value="آذر,دی">آذر,دی</option>');
                                duration.append('<option value="بهمن,اسفند">بهمن,اسفند</option>');
                                break;
                            case 'season':
                                duration.append('<option value="بهار">بهار</option>');
                                duration.append('<option value="تابستان">تابستان</option>');
                                duration.append('<option value="پاییز">پاییز</option>');
                                duration.append('<option value="زمستان">زمستان</option>');
                                break;
                            case 'biseason':
                                duration.append('<option value="بهار-تابستان">بهار-تابستان</option>');
                                duration.append('<option value="پاییز-زمستان">پاییز-زمستان</option>');
                                break;
                            case 'triannual':
                                duration.append('<option value="فروردین-تیر">فروردین-تیر</option>');
                                duration.append('<option value="مرداد-آبان">مرداد-آبان</option>');
                                duration.append('<option value="آذر-اسفند">آذر-اسفند</option>');
                                break;
                            case 'annual':
                                duration.append('<option value="سال جاری">سال جاری</option>');
                                break;
                        }
                        break;
                }
            });

            $("#issue_update_form").submit(function(e){
                e.preventDefault();
                let _csrf = $("#_token").val();
                let volume_id = $("#volume_id").val();
                let issue_id = $("#issue_id").val();
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
                    url: '{{ route("admin.publication.issue.update") }}' ,
                    method: "POST",
                    dataType: 'json',
                    data :  {'_token' : _csrf , volume_id, 'issue_id':issue_id, 'duration' : duration , 'pages_number_from':pages_number_from, 'pages_number_to':pages_number_to ,special_issue , special_description} ,
                    success : function(data){
                        if(data.message=="duplicate"){
                            swal("", "این شماره تکراری میباشد", "error");
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }
                        if(data.message=="fail"){
                            $("#err_list").empty();
                            document.documentElement.scrollTop = 0;
                            $("#err_container").show("fast");
                            for (let key in data.err) {
                                if (data.err.hasOwnProperty(key)) {
                                    $("#err_list").append('<li>'+data.err[key]+'</li>');
                                }
                            }
                        }
                        if(data.message=="success"){
                            swal("ویرایش شد", "شماره با موفقیت ویرایش شد", "success");
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }
                    }
                })
            });
        });

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

        $(".form_remove").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف مقاله اطمینان دارید ؟",
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
                        swal("جهت حذف باید عبارت delete را وارد کنید");
                        return false;
                    }else{
                        swal("عبارت delete وارد نشده است!");
                        return false;
                    }
                });
        });

        function changeActive(event){
            swal({
                title: "توجه",
                text: "آیا نسبت به فعال/غیرفعال کردن مقاله اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willUpdate) => {
                    if (willUpdate) {
                        $("#tbl_issues").css('display','none');
                        $("#progressbar").css('display','block');
                        $.ajax({
                            'url' : '/admin/publication/article/edit/active/' + $(event).attr('publication-id')  + '/' + $(event).attr('article-id') ,
                            'type' : 'POST' ,
                            'data' : {'_token' : '{{ csrf_token() }}'} ,
                            'dataType' : 'json' ,
                            'success' : function(data){
                                switch(data.message){
                                    case 'success_active' :
                                        $(event).removeClass('label-danger');
                                        $(event).addClass('label-success');
                                        $(event).html("Active");
                                    break;
                                    case 'success_deactive' :
                                        $(event).removeClass('label-success');
                                        $(event).addClass('label-danger');
                                        $(event).html("Inactive");
                                    break;
                                    case 'fail':
                                        swal({
                                            title: "خطا",
                                            text: "هنوز نشریه فعال نشده است، ابتدا نشریه را فعال کنید",
                                            icon: "warning",
                                        });
                                    break;
                                }
                                $("#tbl_issues").css('display','inline-table');
                                $("#progressbar").css('display','none');
                            }

                        });
                    } else {
                        return false;
                    }
                });
        }

        function getArticle(event){
            $("#article_resources").empty();
            $("#article_authors_tbl").empty();
            $("#article_structs").empty();
            let article_id = $(event).attr("article-id");
            $.ajax({
                url : '/admin/publication/get/article/' + article_id ,
                type : 'post' ,
                data : { '_token':'{{csrf_token()}}'  } ,
                success(data){
                    let authors = JSON.parse(data.authors_info);
                    let resources = JSON.parse(data.resource);
                    let structures = JSON.parse(data.struct);
                    $("#article_id").html(data.id);
                    $("#article_IOI").html(data.IOI);
                    $("#article_DOI").html(data.DOI);
                    $("#article_highlight").html(data.highlight);
                    $("#article_authors_tbl").append(' <tr>\n' +
                        '                                        <th class="tac">Name</th>\n' +
                        '                                        <th class="tac">Email</th>\n' +
                        '                                        <th class="tac">Rate</th>\n' +
                        '                                        <th class="tac">Dependency</th>\n' +
                        '                                    </tr>');
                    $.each(authors, function(key,val){
                        $("#article_authors_tbl").append('<tr>' +
                                '<td>'+ val.name +'</td>' +
                                '<td>'+ val.email +'</td>' +
                                '<td>'+ val.rate +'</td>' +
                                '<td>'+ val.dependency +'</td>' +
                            '</tr>');
                    });
                    $.each(structures , function(key,val){
                        $("#article_structs").append('' +
                            '<div style="height:2px; background-color:#ff0000; margin:14px;"></div>' +
                                '<ul style="margin-left: 20px;">' +
                                    '<li>'+ val.str +'</li>' +
                                '</ul>'
                        );
                        if(val.substr){
                            for(let i=0; i<val.substr.length; i++) {
                                $("#article_structs").append('' +
                                    '<ul style="list-style: disc;margin-left:55px;">' +
                                        '<li style="color:#222">' + val.substr[i] + ' </li>' +
                                    '</ul>' +
                                    '');
                            }
                        }
                    });
                    $("#article_abstract").html(data.abstract);
                    $("#article_pageCount").html(data.pageCount);
                    $("#article_page").html(data.page);
                    $("#article_keyword").html(data.keywords);
                    $("#article_resources").empty();
                    $.each(resources, function(key,val){
                        $("#article_resources").append('' +
                            ' <span style="color:#4dc0b5; margin:4px;">['+ parseInt(key+1) +']</span>'+ val +'<hr/>');
                    });
                }
            });
        }
    </script>
@endsection