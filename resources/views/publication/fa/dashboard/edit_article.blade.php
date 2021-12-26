@extends('publication.fa.dashboard.master')
@section('styles')
    <style>
        @-webkit-keyframes scale-up-bottom {
            0% {
                -webkit-transform: scale(0.5);
                transform: scale(0.5);
                -webkit-transform-origin: 50% 100%;
                transform-origin: 50% 100%;
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: 50% 100%;
                transform-origin: 50% 100%;
            }
        }
        @keyframes scale-up-bottom {
            0% {
                -webkit-transform: scale(0.5);
                transform: scale(0.5);
                -webkit-transform-origin: 50% 100%;
                transform-origin: 50% 100%;
            }
            100% {
                -webkit-transform: scale(1);
                transform: scale(1);
                -webkit-transform-origin: 50% 100%;
                transform-origin: 50% 100%;
            }
        }
        #article_form1 label{font-weight: 400;margin:2px;}
        #authors input {margin:8px;float:left;font-size:12px;direction:rtl;}
        #authors label {font-size:13px;padding:10px 14px;text-align: center;margin:auto;float: right;clear: right;}
        .one_author{border-bottom:2px solid #ccc;border-left:1px solid tomato;padding:15px;}
        .author_list{float:right;background-color: #2e6da4;color:#fff;border-radius: 4px;font-size:14px;padding:5px;min-width:50px;position: relative;bottom:0;right:5px;}
        .remove_author:nth-child(even){background-color: #f1f1f1;position: relative;left:3%;padding:4px;box-shadow:0 0 2px #222;border-radius:5px;}
        .remove_author:hover{cursor: pointer;box-shadow:0 0 4px #ff394f;transition: 0.3s;}
        #steps_article_submit{text-align:center;margin:20px 5px 0 0;}
        #submit_steps {list-style:none;font-size:19px;padding:8px; border:1px solid #ccc; padding:0!important;background-color: #f2dede;}
        #steps_article_submit li{padding:12px; border-bottom:2px solid tomato;}
        .star{color:#ff0000; margin:4px; vertical-align: -1px;}
        .authors_form{display:inline-block;}
        #resource_counter{display:none; font-size: 14px; font-weight: bold; text-align: center;  width: 30%;margin:20px auto;background-color: blanchedalmond;padding: 10px;border-radius: 10px;border: 1px solid #222;box-shadow: 0 0 13px #ccc; animation-name: scale-up-bottom; animation-duration: 1s; animation-iteration-count: infinite;}
        .article_image{width:250px; border-radius:10px;margin:10px;}
        .middle{vertical-align: middle !important;}
        .line_height_40{line-height: 35px;}
        .font_13{font-size:13px;}
        .img_info_label{padding: 0 !important;width: 40px;}
        .remove_img_icon{vertical-align: top; color:tomato; position:relative;top:4px;}
        .remove_img_icon:hover{cursor: pointer; color:orange; transition: .3s}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: ltr}
        .swal-text{direction: ltr}
        #tbl_upload th,td{text-align: center; font-weight: normal; vertical-align: middle !important;}
        .btn-purple{color: #fff;background-color: #993366;;border-color: #993366;}
        .btn-purple:hover{border:none;color:yellow;box-shadow:0 0 10px #eaeaea;transition: .4s;}
        .select2-selection__choice__remove{color:#222 !important}
        .select2-selection__choice__remove:hover{color:#ff0f30 !important}
        .select2-selection__choice{color:#222 !important;}
        .modal_image_file{ position: fixed; z-index: 9999; display:none; right:0; top:0; background-color: #ffffff; padding:10px; border:1px solid #555; box-shadow:0 0 5px #ccc; border-radius:10px;  }
        .image_file{width:400px;}
        .image_last_upload{width:200px; box-shadow:0 0 8px #222; border-radius:10px;}


        .add_struct{vertical-align: -9px; color:#092c18; padding:6px; background-color:#dddddd; border-radius:6px; }
        .add_struct:hover{transition:.3s; color:orangered; cursor: pointer;}
        .add_struct{position: absolute;left: 0;top: -50px;}
        .structs_form{border-bottom: 1px solid tomato;}
        .substrs{background: #e3e3e3;border-radius: 10px;}
    </style>
@endsection

@section('content')
    <div class="row rtl tar">
        <div class="col-sm-12" style="margin-top:50px;">
            <h6 class="alert alert-primary tac">ویرایش : {{ $article->title }}</h6>
            @include('message.errors')
            <div id="err_container" class="col-sm-12 alert alert-danger" style="direction: rtl;text-align: right; display:none;">
                <ul id="err_list" style="list-style: disc;">
                </ul>
            </div>
            <form action="{{ route('user.publication.article.update.fa',['article'=>$article]) }}" method="post" enctype="multipart/form-data">
                {{ method_field('PATCH') }}
                @csrf
                <div class="form-group">
                    <label for="price" style="margin:6px;"><span class="star">*</span>قیمت مقاله</label>
                    <input type="text" name="price" id="price" class="form-control" required value="{{ $article->price }}"/>
                </div>
                <div class="form-group">
                    <label for="type" style="margin:6px;"><span class="star">*</span>نوع مقاله</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="abstract" {{$article->type == 'abstract' ? 'selected=selected' : ''}}>abstract</option>
                        <option value="fulltext" {{$article->type == 'fulltext' ? 'selected=selected' : ''}}>full text</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title" style="margin:6px;"><span class="star">*</span>عنوان مقاله</label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ $article->title }}"/>
                </div>
                <div class="form-group">
                    <label for="abstract" style="margin:6px;"><span class="star">*</span>چکیده</label>
                    <textarea name="abstract" id="abstract" class="form-control" placeholder="" rows="4" required>{{ $article->abstract }}</textarea>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 tal" style="margin-bottom: 20px;">
                    <button onclick="addAuthor()" type="button" id="add_author_btn" class="btn btn-warning btn-sm tal" style=""><i class="fa fa-plus" style="vertical-align:-2px; margin:0 4px;"></i>نویسنده جدید</button>
                    <p class="tar" style="float:right; background-color: #a42e2e; color:#fff; border-radius: 4px; font-size:16px; padding:10px; min-width:50px;">مشخصات نویسندگان مقاله</p>
                </div><hr/>
                @if($authors)
                    <div class="form-inline form-vertical" style="float:right;">
                        @foreach($authors as $author)
                            <div class="authors_form" id="authors_form_{{ $loop->index+1 }}">
                                <p class="tar author_list" style="">نویسنده
                                    @digitToFarsi(  $loop->index+1  )
                                </p>
                                <div class="one_author col-sm-5" style="display:inline-table;">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><label for="author_name_{{$loop->index+1}}"><span class="star">*</span>نام نویسنده</label></td>
                                            <td><input type="text" name="author_name[]" id="author_name_{{$loop->index+1}}" class="form-control-sm" value="{{ $author->name }}" required /></td>
                                        </tr>

                                        <tr>
                                            <td><label for="author_email_{{$loop->index+1}}"><span class="star">*</span>ایمیل نویسنده</label></td>
                                            <td><input type="text" name="author_email[]" id="author_email_{{$loop->index+1}}" class="form-control-sm" value="{{ $author->email }}" required /></td>
                                        </tr>

                                        <tr>
                                            <td><label for="author_rate_{{$loop->index+1}}"><span class="star">*</span>رتبه نویسنده</label></td>
                                            <td><input type="text" name="author_rate[]" id="author_rate_{{$loop->index+1}}" class="form-control-sm" value="{{ $author->rate }}" required /></td>
                                        </tr>

                                        <tr>
                                            <td><label for="author_dependency_{{$loop->index+1}}"><span class="star">*</span>وابستگی نویسنده</label></td>
                                            <td> <input type="text" name="author_dependency[]" id="author_dependency_{{$loop->index+1}}" class="form-control-sm" value="{{ $author->dependency }}" required /></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <hr/>
                <div class="form-group" style="clear:both;margin-top:20px;">
                    <label for="keywords" style="margin:6px;"><span class="star">*</span>کلمات کلیدی</label>
                    <input type="text" name="keywords" id="keywords" class="form-control" placeholder="" required value="{{ $article->keywords }}" />
                </div>
                <div class="row form-group">
                    <div class="col-sm-6">
                        <label for="accepted_date" style="margin:6px;"><span class="star">*</span>تاریخ پذیرش</label>
                        <input type="text" name="accepted_date" id="accepted_date" class="form-control" placeholder="تاریخ پذیریش" readonly required value="{{ $article->accepted }}"/>
                    </div>
                    <div class="col-sm-6">
                        <label for="receieved_date" style="margin:6px;"><span class="star">*</span>تاریخ دریافت</label>
                        <input type="text" name="receieved_date" id="receieved_date" class="form-control" placeholder="تاریخ دریافت" readonly required value="{{ $article->receieved }}"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="highlight" style="margin:6px;"><span class="star">*</span>نکات برجسته</label>
                    <input type="text" name="highlight" id="highlight" class="form-control" placeholder="" required value="{{$article->highlight }}"/>
                </div>
                <div class="form-group">
                    <label for="DOI" style="margin:6px;"><span class="star">*</span>DOI</label>
                    <input type="text" name="DOI" id="DOI" class="form-control" placeholder="" required value="{{ $article->DOI }}"/>
                </div>
                <div class="row form-group rtl">
                    @php($page_start_end = explode('-',$article->page) )
                    <div class="col-sm-4">
                        <label for="page_count" style="margin:6px;"><span class="star">*</span>تعداد صفحات</label>
                        <input type="text" name="page_count" id="page_count" class="form-control-sm" placeholder="" required value="{{ $article->pageCount }}"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="page_from" style="margin:6px;"><span class="star">*</span>صفحه شروع</label>
                        <input type="number" min="1" max="1000" name="page_from" id="page_from" class="form-control-sm label-success" placeholder="" required value="{{ $page_start_end[0] }}"/>
                    </div>
                    <div class="col-sm-4">
                        <label for="page_to" style="margin:6px;"><span class="star">*</span>صفحه پایان</label>
                        <input type="number" min="1" max="1000" name="page_to" id="page_to"  class="form-control-sm label-warning" placeholder="" required value="{{ $page_start_end[1] }}"/>
                    </div>
                </div><hr/>
                <div class="row form-group">
                    <div class="col-sm-3">
                        <label for="press" class="bg bg-warning" style="padding:4px; border-radius:2px;">ثبت در مطبوعات</label>
                    </div>
                    <div class="col-sm-2">
                        <label for="press_yes">دارد</label>
                        <input type="radio" class="radio" name="press" id="press_yes" value="1" style="vertical-align: middle;"/>
                    </div>
                    <div class="col-sm-2">
                        <label for="press_no">ندارد</label>
                        <input type="radio" class="radio" name="press" id="press_no" value="0" checked style="vertical-align: middle;"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="resource" style="margin:6px;"><span class="star">*</span>منابع</label>
                    <textarea class="form-control textarea" name="resource" id="resource" onblur="explodeResource()" style="min-height:200px;direction:ltr;" required>@foreach($resource as $res){!!$res."\n"!!}@endforeach</textarea>
                </div>
                <div class="form-group">
                    <div id="resource_counter">
                        <span id="col1" style="display: none">تعداد منابع مجزا : </span>
                        <span class="label label-danger" id="col2" style="font-size: 14px; vertical-align: 1px;"><span id="resource_number"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="explode_resource" style="margin:6px;"><span class="star">*</span>منابع مجزا</label>
                    <textarea class="form-control textarea" name="explode_resource" id="explode_resource" readonly style="min-height:400px;" required></textarea>
                </div><hr/>
                <div id="uploaded_file_container" class="form-group" style="margin:40px; border-bottom: 1px solid #f00;">

                    <table id="tbl_upload" class="table table-bordered">
                        <h4>Article pdf</h4>
                        @if(empty($files))
                            <div class="upload_file" id="upload_file">
                                <label class="alert alert-warning" for="file">Pdf file</label>
                                <input type="file" name="file" id="file" class="btn btn-purple form-control" style="min-height:47px;" /><hr/>
                            </div>
                        @endif
                        @foreach($files as $file)
                            <table id="tbl_upload" class="table table-responsive-sm">
                                <tr style="background-color:#1ba12e; color:#f1f1f1;">
                                    <th>نام فایل</th>
                                    <th>پیش نمایش</th>
                                    <th>Remove file</th>
                                </tr>
                                <tr>
                                    <td>{{ $file }}</td>
                                    <td><a href="{{publication_article_path}}{{$article->files_directory}}/{{$file}}" target="_blank"><span class="fa fa-file-pdf-o" style="margin:0 4px;"></span>Download</a></td>
                                    <td><button class="btn btn-sm btn-danger" type="button" onclick="deleteArticlePdf('{{publication_article_path}}{{$article->files_directory}}/{{$file}}')"><span class="fa fa-remove" style="margin:0 4px;"></span>Delete article pdf</button></td>
                                </tr>
                            </table>
                        @endforeach
                    </table>
                </div>
                <div class="form-group">
                    @foreach($structs as $structKey => $struct)
                        <span class="btn btn-info" style="position: relative; bottom:25px;">ساختار
                            @digitToFarsi(  $loop->index+1  )
                        </span>
                        <div class="row">
                            <div class="col-sm-6" style="border-left:2px solid #222;">
                                <table class="table table-borderless">
                                    <tr>
                                        <td><label class="line_height_40 font_13" for="struct_title_{{ $loop->index+1 }}">ساختار</label></td>
                                        <td><input type="text" name="struct_title[]" id="struct_title_{{ $loop->index+1 }}" class="form-control" value="{{ $struct->str }}"/></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-6" id="">
                                @if( !empty($struct->substr) )
                                    <span style="display:inline-block; padding:4px;" class="alert alert-info">زیرساختارها</span>
                                    @for($i=0 ; $i<count($struct->substr) ; $i++)
                                        <div class="img_container" style="text-align:right">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <input type="text" name="sub_struct_{{$structKey + 1}}[]" class="form-control" value="{{  $struct->substr[$i] }}"/>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endfor
                                @endif
                            </div>
                        </div>
                        <div style="height:2px; background-color:tomato"></div>
                        <hr/>
                    @endforeach
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 tal" style="margin-bottom: 20px; border-bottom:3px dotted #222;">
                    <button id="new_struct_btn" onclick="addStruct()" type="button" class="btn btn-info btn-sm tal"><i class="fa fa-plus" style="vertical-align:-2px;  margin:0 4px;"></i>ساختار جدید</button>
                    <p class="tar" style="float:right; background-color: #4dc2b6; color:#fff; border-radius: 4px;  font-size:16px; padding:10px; min-width:50px;">ساختارهای مقاله</p>
                </div>
                <div class="form-group">
                    <div class="structs_form" id="structs_form_{{$struct_counts}}">
                    </div>
                </div>
                <div class="form-group tac">
                    <button type="submit" class="btn btn-warning" style="width:50%;">ویرایش مقاله</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal_image_file tac">
        <img src="" class="image_file" />
    </div>
    <input type="hidden" id="_token" value="{{ csrf_token() }}"/>
    <input type="hidden" id="conference_lang" value="{{ $article->issue->volume->publication->lang}}"/>
    <input id="directory_address" type="hidden" value="{{$article->files_directory}}"/>
@endsection


@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_list')").removeClass('active');

            $('.image_selector_1').select2();
            $("#resource").trigger("blur");

            $(".image_selector_1").change(function(){
                $(".img_description_field_1").empty();
                // $(".select2-selection__rendered").addClass('select2-selection__rendered_1');
                $(".select_image_container_1").find('ul').addClass('select2-selection__rendered_1');
                $('.select2-selection__rendered_1').children().not('li.select2-search--inline').each(function(index, value){
                    if( $(value).attr('class') !== "select2-search--inline"){
                        $(".img_description_field_1").append('' +
                            '   <div class="row tac" style="line-height:30px; margin:20px 0;">\n' +
                            '       <div class="col-sm-4">\n' +
                            '           <label style="direction:rtl;">توضیحات فایل '+ $(value).attr('title') +'    </label>\n' +
                            '       </div>\n' +
                            '       <div class="col-sm-8">\n' +
                            '           <input type="text" name="struct_image_description_1[]" class="form-control" />\n' +
                            '       </div>\n' +
                            '   </div>');
                    }
                });
            });

            $('#accepted_date').focus(function(){
                let lang = $("#conference_lang").val();
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
                let lang = $("#conference_lang").val();
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

        function removeMe(e){
            e.parentElement.parentElement.remove();
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

        function addAuthor(){
            let last_id = $(".authors_form:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;
            if(nextIndex >= 16){
                return;
            }
            $(".authors_form:last").after("<div class='authors_form' id='authors_form_"+ nextIndex +"'></div>");

            $("#authors_form_" + nextIndex).append('' +
                '                                <p class="tar author_list" style="background-color:#0d9e4c; color:#ffffff;">نویسنده '+digitToFarsi(nextIndex)+'</p>' +
                '                                <div class="one_author col-sm-5" style="display:inline-table;">\n' +
                '                                    <table class="table table-borderless"> '+
                '                                       <tr> '+
                '                                            <td><label for="author_name_'+nextIndex+'"><span class="star">*</span>نام نویسنده</label></td> '+
                '                                            <td><input type="text" name="author_name[]" id="author_name_'+nextIndex+'" class="form-control-sm" value="" required /></td> '+
                '                                            <td><label for="author_email_'+nextIndex+'"><span class="star">*</span>ایمیل نویسنده</label></td> '+
                '                                            <td><input type="text" name="author_email[]" id="author_email_'+nextIndex+'" class="form-control-sm ltr" value="" required /></td> '+
                '                                        </tr> '+
                '                                        <tr> '+
                '                                        <td><label for="author_rate_'+nextIndex+'"><span class="star">*</span>رتبه نویسنده</label></td> '+
                '                                        <td><input type="text" name="author_rate[]" id="author_rate_'+nextIndex+'" class="form-control-sm" value="" required /></td> '+
                '                                        <td><label for="author_dependency_'+nextIndex+'"><span class="star">*</span>وابستگی نویسنده</label></td> '+
                '                                        <td><input type="text" name="author_dependency[]" id="author_dependency_'+nextIndex+'" class="form-control-sm" value="" required /></td> '+
                '                                        </tr> '+
                '                                    </table> '+
                '                           </div>');
        }

        function addStruct() {
            let last_id = $(".structs_form:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;

            if (nextIndex > 15) {
                return;
            }
            let order_files = new Array();
            <?php if(isset($files) ) { ?>
            <?php foreach($files as $key => $val){ ?>
            order_files.push('<?php echo $val; ?>');
            <?php } ?>
            <?php } ?>

            $(".structs_form:last").after("<div class='structs_form' id='structs_form_" + nextIndex + "'></div>");
            $("#structs_form_" + nextIndex).append('<div class="structs_form" id="structs_form_' + nextIndex + '">\n' +
                '                            <div class="row" style="margin:20px 0;">\n' +
                '                                <div class="col-sm-3 tac" style="line-height:30px;">\n' +
                '                                    <label for="struct_title_' + nextIndex + '">عنوان   ' + nextIndex + ' </label>\n' +
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
            $("#substr_"+div[1]).append('<div class="row tac">' +
                '<div class="col-sm-3 form-group tal">' +
                '<label> زیرساخت ساختار  '+counter+'<label>' +
                '</div>' +
                '<div class="col-sm-8 form-group tar">' +
                '<input type="text" class="form-control-sm" name="sub_struct_'+ div[1] +'[]" />' +
                '</div>' +
                '</div>');
        }


        $(document).on('mouseenter', 'li.select2-selection__choice', function() {
            $(".modal_image_file").addClass('in');
            $(".modal_image_file").css('display','block');
            let directory = $("#directory_address").val();
            let thefile = "/upload/conferences/articles/" + directory + "/" + $(this).attr('title').trim();
            $(".image_file").attr('src' , thefile);
        });

        $(document).on('mouseleave', 'li.select2-selection__choice', function() {
            $(".modal_image_file").removeClass('in');
            $(".modal_image_file").css('display','none');
        });

        $(document).on('click', 'span.select2-selection__choice__remove', function() {
            $(".modal_image_file").removeClass('in');
            $(".modal_image_file").css('display','none');
        });

        function deleteArticlePdf(path){
            swal({
                title: "for delete article pdf enter 'delete' ",
                text: "Are you sure to delete pdf ?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: "input",
                html: true
            })
                .then((value) => {
                    if(value=="delete"){
                        $.ajax({
                            'url' : '{{route("publication.article.delete.pdf.fa")}}',
                            'type' : 'post',
                            'data' : {'_token':'{{ csrf_token()}}' ,path} ,
                            'dataType' : 'json' ,
                            'success' : function(data){
                                if(data.message=="success"){
                                    $("#uploaded_file_container").empty();
                                    $("#uploaded_file_container").append('<div class="upload_file" id="upload_file">\n' +
                                        '                                <label class="alert alert-warning" for="file">Pdf file</label>\n' +
                                        '                                <input type="file" name="file" id="file" class="btn btn-purple form-control" style="min-height:47px;" /><hr/>\n' +
                                        '                            </div>');
                                    swal({'text':'File remove succcessfully, now upload pdf',icon: "success",});
                                }else if(data.message=="fail"){
                                    swal({'text':'Error to remove file'});
                                }else{
                                    swal({'text':'Pdf file not exist!'});
                                }
                            }
                        });
                    }else if(value==""){
                        swal("You should enter delete");
                        return false;
                    }else{
                        swal("Please enter delete");
                        return false;
                    }
                });
        }
    </script>
@endsection