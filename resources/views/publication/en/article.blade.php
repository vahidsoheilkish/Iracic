@extends('publication.en.dashboard.master')
@section('styles')
    <style>
        #article_form1 label{font-weight: 400;margin:2px;}
        #authors input {margin:8px;float:left;font-size:12px;direction:rtl;}
        #authors label {font-size:12px;text-align: center;margin:16px 0;float: left;clear: left;}
        .remove_author:nth-child(even){background-color: #f1f1f1;position: relative;left:3%;padding:4px;box-shadow:0 0 2px #222;border-radius:5px;}
        .remove_author:hover{cursor: pointer;box-shadow:0 0 4px #ff394f;transition: 0.3s;}
        #steps_article_submit{text-align:center;margin:20px 5px 0 0;}
        #submit_steps {list-style:none;font-size:19px; border:1px solid #ccc; padding:0 !important;background-color: #f2dede;}
        #steps_article_submit li{padding:12px; border-bottom:2px solid tomato;}
        .star{color:#ff0000; margin:4px; vertical-align: -1px;}
        #article_submit2{display: none; text-align: left;  padding:30px; margin:20px auto !important;}
        #article_submit3{display: none; text-align: left; padding:30px; margin:20px auto !important;}
        #tbl_upload{ text-align: center }
        @-webkit-keyframes scale-up-bottom {
            0% {-webkit-transform: scale(0.5);transform: scale(0.5);-webkit-transform-origin: 50% 100%;transform-origin: 50% 100%;}
            100% {-webkit-transform: scale(1);transform: scale(1);-webkit-transform-origin: 50% 100%;transform-origin: 50% 100%;} }
        @keyframes scale-up-bottom {
            0% {-webkit-transform: scale(0.5);transform: scale(0.5);-webkit-transform-origin: 50% 100%;transform-origin: 50% 100%;}
            100% {-webkit-transform: scale(1);transform: scale(1);-webkit-transform-origin: 50% 100%;transform-origin: 50% 100%;}
        }
        @-webkit-keyframes slide-top {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-30px);
                transform: translateY(-30px);
            }
        }
        @keyframes slide-top {
            0% {
                -webkit-transform: translateY(0);
                transform: translateY(0);
            }
            100% {
                -webkit-transform: translateY(-30px);
                transform: translateY(-30px);
            }
        }
        @keyframes scale_animation {
            from{right:0}
            to{right:10px;}
        }
        .lang_label{ padding: 5px; position: relative;}
        .authors_form{direction:rtl;}
        .one_author{direction:ltr; width:50%; float:right; border-bottom:2px solid #ccc;border-left:1px solid tomato;padding:15px;}
        .author_list{background-color: #2e6da4;color:#fff;border-radius: 4px;font-size:14px;padding:5px;min-width:50px;position: relative;bottom:18px;right:5px;}
        .breadcrumb-pagination {width:100%;border-bottom:1px solid #E1E6EB;text-align:center;margin-top:70px;float:left;color:#B3B7C1;}
        .breadcrumb-pagination div {width: 25%;display:inline-block;}
        .breadcrumb-pagination div span {margin:0 auto;display:block;border-radius:100%;width:36px;padding:6px 0 0 0;font-size:20px;}
        .completed span {background-color:none;color:#95db89;border:2px solid #95db89;}
        .activate span {background-color:#00abc9;color:#fff;}
        .breadcrumb-pagination div p {text-align:center;line-height:0;margin:30px auto 25px;}
        .activate p {border-bottom:2px solid #00abc9;padding-bottom:27px;margin-bottom:0 !important;color: #3c4043;font-weight:700;}
        .completed p {color:#bsb7c1;}
        .completed span::before {content: '\2713'}
        .btn-purple{color: #fff;background-color: #993366;;border-color: #993366;}
        .btn-purple:hover{border:none;color:yellow;box-shadow:0 0 10px #f1f1f1;transition: .4s;}
        .add_struct{vertical-align: -9px; color:#092c18; padding:6px; background-color:#dddddd; border-radius:6px; }
        .add_struct:hover{transition:.3s; color:orangered; cursor: pointer;}
        .add_struct{position: absolute;right: 5%;top: -55px;}
        .structs_form{border-bottom: 1px solid tomato;}
        .substrs{direction:ltr;background: #e3e3e3;border-radius: 10px;}
        .step_wrapper{background-color: #f1f1f1;}
        .step_wrapper:hover{cursor: pointer;}
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="breadcrumb-pagination">
                <div id="step1" class="step_wrapper">
                    <span class="steps">1</span>
                    <p class="completed">Form</p>
                </div>
                <div id="step2" class="step_wrapper">
                    <span class="steps">2</span>
                    <p>Form</p>
                </div>
                <div id="step3" class="step_wrapper">
                    <span class="steps">3</span>
                    <p>Form</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: left; padding:30px; margin:20px 10px auto !important; border-radius:10px; box-shadow:0 0 5px #588bff">
                <h3 class="tal" style="color:#1ba12e;">Submit new article</h3>
                <hr/>
                @include('message.errors')
                <div id="err_container" class="alert alert-danger" style="direction: rtl;text-align: right; display:none;">
                    <ul class="err_list">
                    </ul>
                </div>
                <form action="{{ route('publication.article.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="article_form1" novalidate>
                    <div id="article_submit1" class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-xs-12">
                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                        <input type="hidden" id="group_id" name="group_id" value="{{$publication->group_id}}"/>
                        <input type="hidden" id="major_id" name="major_id" value="{{$publication->major_id}}"/>
                        <input type="hidden" id="publisher_id" name="publisher_id" value="{{ session()->get('publication_user')->id }}"/>
                        <div class="form-group">
                            <label for="volume_id" style="margin:6px;"><span class="star">*</span>Select group</label>
                            <select name="volume_id" id="volume_id" class="form-control" required>
                                <option></option>
                                @foreach($publication->volumes as $volume)
                                    <option value="{{$volume->id}}"> year {{ $volume->year }}  </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="issue_id" style="margin:6px;"><span class="star">*</span>Select major</label>
                            <select name="issue_id" id="issue_id" class="form-control" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="type" style="margin:6px;"><span class="star">*</span>Article type</label>
                            <select type="text" name="type" id="type" class="form-control">
                                <option value="abstract">abstract</option>
                                <option value="fulltext">full text</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title" style="margin:6px;"><span class="star">*</span>Article title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{old('title')}}" required/>
                        </div>
                        <div class="form-group">
                            <label for="abstract" style="margin:6px;"><span class="star">*</span>Abstract</label>
                            <textarea name="abstract" id="abstract" rows="4" class="form-control" placeholder="">{{ old('abstract') }}</textarea>
                        </div>
                        <div class="form-group" id="authors">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 tal" style="margin-bottom: 20px;">
                                <button onclick="addAuthor()" type="button" id="add_author_btn" class="btn btn-warning btn-sm tal" style=""><i class="fa fa-plus" style="vertical-align:-2px; margin:0 4px;"></i>نویسنده جدید</button>
                                <p class="tar" style="float:right; background-color: #a42e2e; color:#fff; border-radius: 4px; font-size:16px; padding:10px; min-width:50px;">مشخصات نویسندگان مقاله</p>
                            </div><hr/>
                            <div class="authors_form" id="authors_form_1">
                                <div class="one_author">
                                    <span class="lang_label tar author_list" >
                                    Author 1
                                    </span>
                                    <div class="row" style="margin:auto">
                                        <div class="col-sm-5">
                                            <label for="author_name_1"><span class="star">*</span>Author name</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="author_name[]" id="author_name_1" class="form-control" value="" required />
                                        </div>
                                    </div>
                                    <div class="row" style="margin:auto">
                                        <div class="col-sm-5">
                                            <label for="author_email_1"><span class="star">*</span>Author email</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="author_email[]" id="author_email_1" class="form-control ltr" value="" required />
                                        </div>
                                    </div>
                                    <div class="row" style="margin:auto">
                                        <div class="col-sm-5">
                                            <label for="author_rate_1"><span class="star">*</span>Education</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="author_rate[]" id="author_rate_1" class="form-control" value="" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <label for="author_dependency_1"><span class="star">*</span>Organizational affiliation</label>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" name="author_dependency[]" id="author_dependency_1" class="form-control" value="" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><hr/>
                        <div class="form-group tal" style="margin:40px 0;clear: right;position:relative; padding:10px; top:20px; border-top:1px solid #ffc107;">
                            <input type="button" id="btn_form1" value="Next Step" class="btn btn-success" style="width:30%;"/>
                        </div>
                    </div>
                    <div id="article_submit2" class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-xs-12" style="text-align: left;">
                        <div class="form-group" style="">
                            <label for="keywords" style="margin:6px;"><span class="star">*</span>Keywords</label>
                            <input type="text" name="keywords" id="keywords" class="form-control" placeholder="" required value="{{ old('keywords') }}" />
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="accepted_date" style="margin:6px;"><span class="star">*</span>Accepted date</label>
                                <input type="text" name="accepted_date" id="accepted_date" class="form-control" placeholder="Accepted date" required readonly value="{{ old('accepted_date') }}"/>
                            </div>
                            <div class="col-sm-6">
                                <label for="receieved_date" style="margin:6px;"><span class="star">*</span>Receieved date</label>
                                <input type="text" name="receieved_date" id="receieved_date" class="form-control" placeholder="Receieved date" required readonly value="{{ old('receieved_date') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="highlight" style="margin:6px;"><span class="star">*</span>Highlight</label>
                            <input type="text" name="highlight" id="highlight" class="form-control" placeholder="" required value="{{ old('highlight') }}"/>
                        </div>
                        <div class="row form-group rtl">
                            <div class="col-sm-4">
                                <label for="page_count" style="margin:6px;"><span class="star">*</span>Number of pages</label>
                                <input type="text" name="page_count" id="page_count" class="form-control-sm" placeholder="" required value="{{ old('page_count') }}"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="page_from" style="margin:6px;"><span class="star">*</span>Start page</label>
                                <input type="number" min="1" max="1000" name="page_from" id="page_from" class="form-control-sm label-success" placeholder="" required value="{{ old('page_from') }}"/>
                            </div>
                            <div class="col-sm-4">
                                <label for="page_to" style="margin:6px;"><span class="star">*</span>End page</label>
                                <input type="number" min="1" max="1000" name="page_to" id="page_to"  class="form-control-sm label-warning" placeholder="" required value="{{ old('page_to') }}"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="DOI" style="margin:6px;"><span class="star">*</span>DOI</label>
                            <input type="text" name="DOI" id="DOI" class="form-control" placeholder="" required value="{{ old('DOI') }}"/>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <label for="press" class="bg bg-warning" style="padding:4px; border-radius:2px;">Registration in the press</label>
                            </div>
                            <div class="col-sm-2">
                                <label for="press_yes">Yes</label>
                                <input type="radio" class="radio" name="press" id="press_yes" value="1" style="vertical-align: middle;"/>
                            </div>
                            <div class="col-sm-2">
                                <label for="press_no">No</label>
                                <input type="radio" class="radio" name="press" id="press_no" value="0" checked style="vertical-align: middle;"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price" id="price" value="{{old('price')}}" style="vertical-align: middle;"/>
                        </div>
                        <div class="form-group tal" style="margin:40px 0;">
                            <input type="button" id="btn_form2" value="Next step" class="btn btn-success" style="width:30%;"/>
                        </div>
                    </div>
                    <div id="article_submit3" class="col-xl-11 col-lg-11 col-md-11 col-sm-12 col-xs-12" style="text-align: left">
                        <div class="form-group">
                            <label for="resource" style="margin:6px;"><span class="star">*</span>Resource</label>
                            <textarea class="form-control textarea" name="resource" id="resource" onblur="explodeResource()" style="min-height:200px;" required>{{ old('resource') }}</textarea>
                        </div>
                        <div class="form-group">
                            <div id="resource_counter">
                                <span id="col1" style="display: none">Number of separate sources : </span>
                                <span class="label label-danger" id="col2" style="font-size: 14px; vertical-align: 1px;"><span id="resource_number"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="explode_resource" style="margin:6px;"><span class="star">*</span>Separate resources</label>
                            <textarea class="form-control textarea" name="explode_resource" id="explode_resource" readonly style="min-height:400px;" required></textarea>
                        </div>
                        <div class="form-group" style="margin:0;">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 tal" style="margin:20px 0; padding:10px 0; border-bottom:3px dotted #222;">
                                <p class="tar" style="float:right; background-color: #4dc2b6; color:#fff; border-radius: 4px;  font-size:16px; padding:10px; min-width:50px;">File upload</p>
                            </div>
                            <div class="form-group">
                                <div class="upload_file" id="upload_file">
                                    <label for="upload"></label>
                                    <input type="file" name="upload" id="upload" class="btn btn-purple form-control" style="min-height:47px;" /><hr/>
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:45px;direction: rtl;">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 tal" style="margin-bottom: 20px; border-bottom:3px dotted #222;">
                                    <button id="new_struct_btn" onclick="addStruct()" type="button" class="btn btn-info btn-sm tal"><i class="fa fa-plus" style="vertical-align:-2px;  margin:0 4px;"></i>New structure</button>
                                    <p class="tar" style="float:right; background-color: #4dc2b6; color:#fff; border-radius: 4px;  font-size:16px; padding:10px; min-width:50px;">Paper structures</p>
                                </div>
                                <div class="container structs_form" id="structs_form_1">
                                    <div class="row" style="margin:20px 0; direction: ltr;">
                                        <div class="col-sm-3 tac" style="line-height:30px;">
                                            <label for="struct_title_1">Title 1</label>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" name="struct_title[]" class="form-control"/>
                                        </div>
                                    </div>
                                    <div id="substr_1" class="col-sm-12 form-group tar substrs">
                                        <span onclick="AddSubStruct(this)" class="fa fa-plus add_struct"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group tar" style="margin:40px 0;">
                            <input type="submit" value="Submit article" class="btn btn-outline-primary" style="width:30%;"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Upload Modal -->
    <div id="uploadFile" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header rtl">
                    <button id="close_modal" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title tar">File Upload</h4>
                </div>
                <form action="" method="post" id="upload_form" enctype="multipart/form-data">
                    <ul class="alert alert-danger err_list" style="display: none;">
                    </ul>
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input type="hidden" id="group" name="group" value="{{$publication->group_id}}"/>
                    <input type="hidden" id="major" name="major" value="{{$publication->major_id}}"/>
                    <input type="hidden" id="publisher" name="publisher" value="{{ session()->get('publication_user')->id }}"/>
                    <input type="hidden" id="volume" name="volume" value=""/>
                    <input type="hidden" id="issue" name="issue" value=""/>
                    <div class="modal-body tar">
                        <div class="form-group">
                            <div class="upload_file" id="upload_file">
                                <input type="file" name="file" id="file" class="btn btn-purple form-control" style="min-height:47px;" /><hr/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn_upload" class="btn btn-success">Upload</button>
                        <button id="btn_close" type="button" class="btn btn-danger" style="float:right;" data-dismiss="modal">close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <input type="hidden" id="publication_lang" value="{{$publication->lang}}"/>
    <p id="result"></p>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("*").removeClass('active');
            $("#struct_images").val(0);
            $("#struct_images_info").val("");

            let volume_id = $("#volume_id");
            for(let i = 0; i < volume_id.length; i++) {
                volume_id[i].selectedIndex = 0;
            }

            $('#accepted_date').focus(function(){
                let lang = $("#publication_lang").val();
                switch (lang){
                    case "en":
                        $(this).persianDatepicker({
                            calendarType: 'gregorian',
                            initialValue: false,
                            autoClose: true,
                            format: 'YYYY-MM-DD',
                            viewMode: 'year',
                            maxDate: Date.now(),
                        });
                        break;
                    case "fa":
                        $(this).persianDatepicker({
                            calendarType: 'persian',
                            initialValue: false,
                            autoClose: true,
                            format: 'YYYY-MM-DD',
                            viewMode: 'year',
                            maxDate: Date.now(),
                        });
                        break;
                }
            });
            $('#receieved_date').focus(function(){
                let lang = $("#publication_lang").val();
                switch (lang){
                    case "en":
                        $(this).persianDatepicker({
                            calendarType: 'gregorian',
                            initialValue: false,
                            autoClose: true,
                            format: 'YYYY-MM-DD',
                            viewMode: 'year',
                            maxDate: Date.now(),
                        });
                        break;
                    case "fa":
                        $(this).persianDatepicker({
                            calendarType: 'persian',
                            initialValue: false,
                            autoClose: true,
                            format: 'YYYY-MM-DD',
                            viewMode: 'year',
                            maxDate: Date.now(),
                        });
                    break;
                }
            });
        });

        $("#step1").click(function(){
            $("#article_submit1").show();
            $("#article_submit2").hide();
            $("#article_submit3").hide();
        });
        $("#step2").click(function(){
            $("#article_submit1").hide();
            $("#article_submit2").show();
            $("#article_submit3").hide();
        });
        $("#step3").click(function(){
            $("#article_submit1").hide();
            $("#article_submit2").hide();
            $("#article_submit3").show();
        });

        $("#btn_form1").click(function(){
            document.documentElement.scrollTop = 0;
            $("#article_submit1").hide();
            $("#step1").addClass("completed");
            $("#step1").removeClass("activate");
            $("#step1 span").html("");
            $("#step2").addClass("activate");
            $("#article_submit2").show();
            $("#article_submit3").hide();
            $("#volume").val( volume_id );
            $("#issue").val( issue_id );
        });
        $("#btn_form2").click(function(){
            document.documentElement.scrollTop = 0;
            $("#step2").addClass("completed");
            $("#step2").removeClass("activate");
            $("#step2 span").html("");
            $("#step3").addClass("activate");
            $("#article_submit1").hide();
            $("#article_submit2").hide();
            $("#article_submit3").show();
        });

        {{--$("#upload_form").submit(function(e) {--}}
            {{--$("#progressbar").css('display','block');--}}
            {{--$("#progressbar").css('z-index','9999');--}}
            {{--e.preventDefault();--}}
            {{--$.ajax({--}}
                {{--url: '{{ route('publication.article.upload.file') }}' ,--}}
                {{--method: "POST",--}}
                {{--dataType: 'json',--}}
                {{--data :  new FormData(this) ,--}}
                {{--headers: {--}}
                    {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                {{--},--}}
                {{--cache: false,--}}
                {{--contentType: false,--}}
                {{--processData: false,--}}
                {{--success: function( response ) {--}}
                    {{--if(response.message == "fail"){--}}
                        {{--let err_list = $(".err_list");--}}
                        {{--err_list.css('display','block');--}}
                        {{--$.each(response.errors,(k,err)=>{--}}
                            {{--err_list.append('<li>'+err+'</li>');--}}
                        {{--});--}}
                        {{--setInterval(function(){--}}
                            {{--err_list.empty();--}}
                            {{--err_list.hide("slow")--}}
                        {{--},4000)--}}
                        {{--$("#progressbar").css('display','none');--}}
                    {{--}--}}
                    {{--if(response.message == "success"){--}}
                        {{--swal("upload" ,  "Selected file uploaded succesfully" ,  "success");--}}
                        {{--$("#btn_close").trigger('click');--}}
                        {{--$(".no_img_message").remove();--}}
                        {{--let order = parseInt( $(".order:last").val() );--}}
                        {{--if(isNaN(order)){--}}
                            {{--order = 0;--}}
                        {{--}--}}
                        {{--let file_raw_name = response.file_name.split('.');--}}
                        {{--$("#tbl_upload").append('' +--}}
                            {{--'<tr>' +--}}
                            {{--'<table class="table table-responsive-sm">' +--}}
                            {{--'<tr  style="background-color:#f6df74;">' +--}}
                            {{--'<th>download</th>'+--}}
                            {{--'<th>file format</th>'+--}}
                            {{--'<th>file name</th>' +--}}
                            {{--'<th>row</th>' +--}}
                            {{--'</tr>'+--}}
                            {{--'<tr>' +--}}
                            {{--'<td style="vertical-align: middle"><a href="'+response.file_url+'" target="_blank">download file</a></td>' +--}}
                            {{--'<td>'+response.file_ext+'</td>' +--}}
                            {{--'<td>'+file_raw_name[0]+'</td>' +--}}
                            {{--'<td style="width:100px;">' +--}}
                            {{--'<input type="text" name="order[]" id="order_'+(order + 1 )+'" readonly onkeyup="orderFile(this)" class="form-control tac order" required value="'+(order + 1)+'" />' +--}}
                            {{--'<input type="hidden" name="order_files[]" id="order_files_'+(order + 1 )+'" class="form-control tac" value="'+(order + 1)+'$$_$$'+response.file_name+'"/>' +--}}
                            {{--'</td>' +--}}
                            {{--'</tr>' +--}}
                            {{--'</table>' +--}}
                            {{--'</tr>');--}}
                        {{--$(".upload_row:last").remove();--}}
                        {{--$("#progressbar").css('display','none');--}}
                    {{--}--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}

        $("#volume_id").change(function(){
            let _token = $("#_token").val();
            let id = $(this).children(":selected").attr("value");
            let issue_id = $("#issue_id");
            $.ajax({
                'url' : '/user/publication/issues/volume/'+id ,
                'type' : 'POST' ,
                'data' : {_token , id} ,
                'dataType' : 'json' ,
                'success' : function(data){
                    issue_id.empty();
                    for(let i=0; i<data.length; i++){
                        issue_id.append('<option value="'+data[i]._id+'">('+(i+1)+') ' + data[i].duration  +' </option>');
                    }
                }
            });
        });

        function addAuthor(){
            let last_id = $(".authors_form:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;
            if(nextIndex >= 16){
                return;
            }
            $(".authors_form:last").after("<div class='authors_form' id='authors_form_"+ nextIndex +"'></div>");

            $("#authors_form_" + nextIndex).append('<div class="one_author">' +
                '                                       <span class="lang_label tar author_list">Author '+nextIndex+'</span>' +
                '                                       <div class="row"  style="margin:auto">\n' +
                '                                            <div class="col-sm-5">\n' +
                '                                                <label for="author_name_1"><span class="star">*</span>Author name</label>\n' +
                '                                            </div>\n' +
                '                                            <div class="col-sm-7">\n' +
                '                                                <input type="text" name="author_name[]" id="author_name_1" class="form-control" value="" required />\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                        <div class="row"  style="margin:auto">\n' +
                '                                            <div class="col-sm-5">\n' +
                '                                                <label for="author_email_1"><span class="star">*</span>Author email</label>\n' +
                '                                            </div>\n' +
                '                                            <div class="col-sm-7">\n' +
                '                                                <input type="text" name="author_email[]" id="author_email_1" class="form-control ltr" value="" required />\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                        <div class="row"  style="margin:auto">\n' +
                '                                            <div class="col-sm-5">\n' +
                '                                                <label for="author_rate_1"><span class="star">*</span>Author education</label>\n' +
                '                                            </div>\n' +
                '                                            <div class="col-sm-7">\n' +
                '                                                <input type="text" name="author_rate[]" id="author_rate_1" class="form-control" value="" required />\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                        <div class="row"  style="margin:auto">\n' +
                '                                            <div class="col-sm-5">\n' +
                '                                                <label for="author_dependency_1"><span class="star">*</span>Author dependence</label>\n' +
                '                                            </div>\n' +
                '                                            <div class="col-sm-7">\n' +
                '                                                <input type="text" name="author_dependency[]" id="author_dependency_1" class="form-control" value="" required />\n' +
                '                                            </div>\n' +
                '                                        </div>' +
                '</div>');
        }

        function addStruct() {
            let last_id = $(".structs_form:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;

            if (nextIndex > 8) {
                return;
            }

            let counter = $(".structs_form:last").attr("id");

            $(".structs_form:last").after("<div class='structs_form' id='structs_form_" + nextIndex + "'></div>");
            $("#structs_form_" + nextIndex).append('<div class="structs_form" id="structs_form_' + nextIndex + '">\n' +
                '                            <div class="row" style="margin:20px 0; direction: ltr">\n' +
                '                                <div class="col-sm-3 tac" style="line-height:30px;">\n' +
                '                                    <label for="struct_title_' + nextIndex + '">Title ' + nextIndex + ' </label>\n' +
                '                                </div>\n' +
                '                                <div class="col-sm-6">\n' +
                '                                    <input type="text" name="struct_title[]" class="form-control"/>\n' +
                '                                </div>' +
                '                            </div>' +
                '                               <div id="substr_'+nextIndex+'" class="col-sm-12 form-group tal substrs">\n' +
                '                                               <span onclick="AddSubStruct(this)" class="fa fa-plus add_struct"></span>\n' +
                '                                           </div>' +
                '</div>');
        }

        function AddSubStruct(e){
            let div = $(e).parent("div");
            div = div.attr("id");
            div = div.split("_");
            let counter = parseInt(div[1]);
            $("#substr_"+div[1]).css("padding","10px");
            $("#substr_"+div[1]).append('<div class="row">' +
                '<div class="col-sm-3 form-group tal">' +
                '<label> Structural Infrastructure  '+counter+'<label>' +
                '</div>' +
                '<div class="col-sm-8 form-group tal">' +
                '<input type="text" class="form-control" name="sub_struct_'+ div[1] +'[]" />' +
                '</div>' +
                '</div>');
        }

        function explodeResource() {
            // var str = txt.value.replace("<", "( ");
            let str = $("#resource").val();
            let str1 = str.replace(/</g, "< ");

            $("#resource").val(str1);
            let a1 = new Array();
            //a1 = str.split("##");
            let separators = ['\n', '##'];
            a1 = str.split(new RegExp(separators.join('|')));
            a1 = a1.filter(v=>v != '');

            if (str != '') {
                document.getElementById("col1").style.display = "inline";
                document.getElementById("col2").style.display = "inline";
                document.getElementById("resource_counter").style.display = "block";
            }else {
                document.getElementById("col1").style.display = "none";
                document.getElementById("col2").style.display = "none";
                document.getElementById("resource_counter").style.display = "none";
            }
            document.getElementById("resource_number").innerHTML = a1.length;
            document.getElementById("explode_resource").value = a1.join("#\n**********\n#");
            document.getElementById("explode_resource").style.direction = "ltr";
        }
    </script>
@endsection


