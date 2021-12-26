@extends('publication.fa.dashboard.master')
@section('styles')
    <style>
        body{direction:rtl;font-family:"BYekan"!important}.form-control{border:1.2px solid #3498db;background-color:#fff;border-radius:0;height:30px;padding:0;font-size:13px;padding-right:5px}input .custom-file-input{border:1.2px solid #3498db;background-color:#fff;border-radius:0;height:30px;padding:0;font-size:13px;padding-right:5px}.input-group-text{border-radius:0;width:40px;background-color:transparent}input[type="text"]{font-size:13px;color:#e3e3e3}input[type="text"]:focus{border-color:#3498db;box-shadow:1px 2px 1px #3498db}select:focus option{font-size:12px}.col-form-label{font-size:13px;color:#005b89}.input-wrapper:before{content:"\f044";font-family:FontAwesome;font-style:normal;font-weight:400;text-decoration:inherit;color:#af5e7c;font-size:18px;padding-right:.5em;position:absolute;top:3px;left:20px;z-index:100}i.star{font-size:7px;padding:2px}.custom-control-label{font-size:13px;color:#005b89}.author-arribute{background-color:#dee2e68a}button.add-author{background-color:purple;font-size:13px;color:#fff;margin:10px}button.authors{background-color:#1e347b;font-size:13px;color:#fff;margin:5px}
        .file-upload{background-color:#fff;width:250px;margin:0 auto;padding:20px}.file-upload-btn{width:100%;margin:0;color:#fff;background:#9b59b6;border:none;padding:10px;border-radius:4px;border-bottom:4px solid #9b59b6;transition:all .2s ease;outline:none;text-transform:uppercase;font-weight:700}.file-upload-btn:hover{background:#9b59b6;color:#fff;transition:all .2s ease;cursor:pointer}.file-upload-btn:active{border:0;transition:all .2s ease}.file-upload-content{display:none;text-align:center}.file-upload-input{position:absolute;margin:0;padding:0;width:100%;height:100%;outline:none;opacity:0;cursor:pointer}.image-upload-wrap{margin-top:20px;border:4px dashed #1e347b;position:relative}.image-dropping,.image-upload-wrap:hover{background-color:#b9bbbe;border:4px dashed #fff}.image-title-wrap{padding:0 15px 15px;color:#222}.drag-text{text-align:center}.drag-text h3{font-weight:100;text-transform:uppercase;color:#2A4DB3;padding:60px 0}.file-upload-image{max-height:100px;max-width:100px;margin:auto;padding:20px}.remove-image{width:200px;margin:0;color:#fff;background:#cd4535;border:none;padding:10px;border-radius:4px;border-bottom:4px solid #b02818;transition:all .2s ease;outline:none;text-transform:uppercase;font-weight:700}.remove-image:hover{background:#c13b2a;color:#fff;transition:all .2s ease;cursor:pointer}.remove-image:active{border:0;transition:all .2s ease}
        .add_struct{vertical-align: -9px; color:#092c18; padding:6px; background-color:#ffefba; border-radius:6px; }
        .add_struct:hover{transition:.3s; color:orangered; cursor: pointer;}
        .add_struct{position: absolute;left: 5%;top: -55px;}
        .structs_form{border-bottom: 1px solid tomato;}
        .substrs{background: #f2f2f2;border-radius: 10px;}
        .tag-editor{width:100%;}
    </style>
@endsection
@section('content')
    <div class="row rtl mt-5">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 class="tar" style="color:#1ba12e;">ثبت مقاله جدید</h3>
            @include('message.errors')
            <div id="err_container" class="alert alert-danger" style="direction: rtl;text-align: right; display:none;">
                <ul class="err_list">
                </ul>
            </div>
            <form action="{{ route('publication.article.store.fa') }}" method="post" enctype="multipart/form-data" class="form-horizontal" id="" novalidate>
                <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}"/>
                <input type="hidden" id="group_id" name="group_id" value="{{$publication->group_id}}"/>
                <input type="hidden" id="major_id" name="major_id" value="{{$publication->major_id}}"/>
                <input type="hidden" id="publisher_id" name="publisher_id" value="{{ $publication->id }}"/>
                <div class="container border p-5">
                    <div class="form-group">
                        <label class="col-form-label pull-right" for="volume_id" style="margin:6px;"><span class="star">*</span>انتخاب دوره</label>
                        <select name="volume_id" id="volume_id" class="input-wrapper form-control" required>
                            <option></option>
                            @foreach($publication->volumes as $volume)
                                <option value="{{$volume->id}}"> سال {{ $volume->year }}  </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label pull-right" for="issue_id" style="margin:6px;"><span class="star">*</span>انتخاب شماره</label>
                        <select name="issue_id" id="issue_id" class="input-wrapper form-control" required>
                        </select>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="title" class="col-12 col-lg-2 col-form-label">زبان مقاله</label>
                            <div class="col-sm-4">
                                <input type="radio" name="lang" id="lang_fa" style="vertical-align: middle" value="fa">
                                <label for="lang_fa" class="mr-2">فارسی</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="radio" name="lang" id="lang_en" style="vertical-align: middle" value="en">
                                <label for="lang_en" class="mr-2">انگلیسی</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="title" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>عنوان مقاله</label>
                            <div class="input-group col-12 col-lg-10 input-wrapper">
                                <input type="text" class="form-control" id="title" placeholder="لطفا عنوان مقاله را در این قسمت وارد کنید" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label class="col-12 col-lg-2 col-form-label" for="type"><i class="fa fa-asterisk text-danger star"></i>نوع مقاله</label>
                            <select type="text" name="type" id="type" class="form-control input-group col-12 col-lg-10 input-wrapper">
                                <option value="abstract">چکیده</option>
                                <option value="fulltext">متن کامل</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="abstract" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>چکیده:</label>
                            <textarea style="min-height: 200px" class="col-10" name="abstract" id="abstract"></textarea>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12 pt-4">
                            <div class="form-group row">
                                <label for="keywords" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>کلمات کلیدی:</label>
                                <div class="input-group col-12 col-lg-10">
                                    <input class="form-control" type="text" id="keywords" placeholder="" name="keywords">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="highlight" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>نکات برجسته:</label>
                            <textarea style="min-height: 200px" class="col-10" name="highlight" id="highlight"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="resource" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>مراجع مقاله:</label>
                            <textarea onblur="explodeResource()" style="min-height: 200px" class="col-10" name="resource" id="resource"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="resource_counter" class="tac alert alert-info">
                            <span id="col1" style="display: none">تعداد منابع مجزا : </span>
                            <span class="label label-danger" id="col2" style="font-size: 24px; vertical-align: 1px;"><span id="resource_number"></span></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="explode_resource" class="col-12 col-lg-2 col-form-label"><span><i class="fa fa-asterisk text-danger star"></i></span>منابع مجزا</label>
                            <textarea class="col-10" name="explode_resource" id="explode_resource" readonly style="min-height:200px;" required></textarea>
                        </div>
                    </div>
                    <div class="row author-arribute">
                        <div class="col-4">
                            <p class="btn pull-right title alert alert-warning" style="margin:0">مشخصات نویسندگان مقاله</p>
                        </div>
                        <div class="offset-4">

                        </div>
                        <div class="col-4">
                            <button type="button" class="btn pull-left add-author" onclick="addAuthor()"><i class="fa fa-plus pl-2"></i>افزودن نویسنده</button>
                        </div>
                    </div>
                    <div class="row tar">
                        <div class="authors_form col-6 border" id="authors_form_1">
                            <button class="btn authors">نویسنده اول</button>
                            <div class="one_author">
                                <div class="form-group row mt-3">
                                    <label for="author_name_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>نام: </label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="author_name_1" placeholder="" name="author_name[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author_family_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i> نام خانوادگی:</label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="author_family_1" placeholder="" name="author_family[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author_email_1" class="col-12 col-lg-2 col-form-label">ایمیل:</label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="author_email_1" placeholder="ali_ahmadi@gmail.com" name="author_email[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="author_education_1" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>تحصیلات:</label>
                                    <select class="form-control col-12 col-lg-8 grouping" id="author_education_1" name="author_education[]">
                                        <option>دکتری تخصصی</option>
                                        <option>دکتری پزشکی</option>
                                        <option>دانشجوی دکتری</option>
                                        <option>کارشناسی ارشد</option>
                                        <option>دانشجوی کارشناسی ارشد</option>
                                        <option>کارشناسی</option>
                                        <option>سایر</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="author_rate_1" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>رتبه علمی:</label>
                                    <select class="form-control col-12 col-lg-8 grouping" id="author_rate_1" name="author_rate[]">
                                        <option>استاد</option>
                                        <option>دانشیار</option>
                                        <option>استادیار</option>
                                        <option>مربی</option>
                                        <option>ندارد</option>
                                        <option>سایر</option>
                                    </select>
                                </div>
                                <h6 class="alert alert-primary">وابستگی</h6>
                                <div class="form-group row mt-3">
                                    <label for="group_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>گروه: </label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="group_1" placeholder="" name="group[]">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="college_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>دانشکده: </label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="college_1" placeholder="" name="college[]">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="university_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>دانشگاه: </label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="university_1" placeholder="" name="university[]">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="city_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>شهر: </label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="city_1" placeholder="" name="city[]">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="country_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>کشور: </label>
                                    <div class="input-group col-12 col-lg-10 input-wrapper">
                                        <input type="text" class="form-control" id="country_1" placeholder="" name="country[]">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-form-label pr-4"><i class="fa fa-asterisk text-danger star"></i>نویسنده مسئول مقاله:</label>
                                    <div class="pt-1">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="customRadioYes_1" name="author_manager_0" value="1">
                                            <label class="custom-control-label" for="customRadioYes_1">بلی</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" id="customRadioNo_1" name="author_manager_0" value="0">
                                            <label class="custom-control-label" for="customRadioNo_1">خیر</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-5">
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="DOI" class="col-12 col-lg-2 col-form-label">DOI:</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="DOI" placeholder="" name="DOI">
                                </div>
                            </div>
                        </div>
                        <div class="offset-8">

                        </div>
                    </div>
                    <div class="row">
                        <h6 class="text-secondary pb-2">تقویم مقاله:</h6>
                        <div class="col-12">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group row">
                                            <label for="receieved_date" class="col-form-label pull-right"><i class="fa fa-asterisk text-danger star"></i>تاریخ دریافت مقاله:</label>
                                            <div class="input-group input-wrapper">
                                                <input type="text" class="form-control" id="receieved_date" placeholder="" readonly name="receieved_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="accepted_date" class="col-form-label pull-right"><i class="fa fa-asterisk text-danger star"></i>تاریخ پذیرش در مجله/ کنفرانس:</label>
                                            <div class="input-group input-wrapper">
                                                <input type="text" class="form-control" id="accepted_date" placeholder="1398/07/07" readonly name="accepted_date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="publish_year" class="col-form-label pull-right"><i class="fa fa-asterisk text-danger star"></i>سال چاپ مقاله:</label>
                                            <div class="input-group input-wrapper">
                                                <input type="text" class="form-control" id="publish_year" placeholder="" readonly name="publish_year">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="offset-3">

                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12 col-lg-3">
                            <div class="row">
                                <label class="col-form-label pl-4"><i class="fa fa-asterisk text-danger star"></i>ثبت در مطبوعات :</label>
                                <div class="pt-1">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="customRadio3" name="press" value="1">
                                        <label class="custom-control-label" for="customRadio3">بلی</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" id="customRadio4" name="press" value="0">
                                        <label class="custom-control-label" for="customRadio4">خیر</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="price" class="col-12 col-lg-4 col-form-label"><i class="fa fa-asterisk text-danger star"></i>قیمت مقاله:</label>
                                <div class="input-group col-12 col-lg-8 input-wrapper">
                                    <input type="text" class="form-control" id="price" placeholder="" name="price">
                                </div>
                            </div>
                        </div>
                        <div class="offset-5">
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-3">
                            <div class="form-group row">
                                <label for="page_count" class="col-12 col-lg-7 col-form-label"><i class="fa fa-asterisk text-danger star"></i>تعداد صفحات مقاله: </label>
                                <div class="input-group col-12 col-lg-5 input-wrapper">
                                    <input type="text" class="form-control" id="page_count" name="page_count">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group row">
                                <label for="page_from" class="col-12 col-lg-7 col-form-label"><i class="fa fa-asterisk text-danger star"></i> صفحه شروع: </label>
                                <div class="input-group col-12 col-lg-5 input-wrapper">
                                    <input type="text" class="form-control" id="page_from" name="page_from">
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group row">
                                <label for="page_to" class="col-12 col-lg-7 col-form-label"><i class="fa fa-asterisk text-danger star"></i>صفحه پایان: </label>
                                <div class="input-group col-12 col-lg-5 input-wrapper">
                                    <input type="text" class="form-control" id="page_to" name="page_to">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top:45px;direction: rtl;">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 tal" style="margin-bottom: 20px; border-bottom:3px dotted #222;">
                            <button id="new_struct_btn" onclick="addStruct()" type="button" class="btn btn-info btn-sm tal"><i class="fa fa-plus" style="vertical-align:-2px;  margin:0 4px;"></i>ساختار جدید</button>
                            <p class="tar" style="float:right; background-color: #4dc2b6; color:#fff; border-radius: 4px;  font-size:16px; padding:10px; min-width:50px;">ساختارهای مقاله</p>
                        </div>
                        <div class="container structs_form" id="structs_form_1">
                            <div class="row" style="margin:20px 0;">
                                <div class="col-sm-2 tal" style="line-height: 25px; padding: 0;">
                                    <label for="struct_title_1">عنوان 1</label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" name="struct_title[]" class="form-control"/>
                                </div>
                            </div>
                            <div id="substr_1" class="col-sm-12 form-group tar substrs">
                                    <span onclick="AddSubStruct(this)" class="fa fa-plus add_struct">
                                        <span style="font-family: IRANSans; vertical-align: 2px;">زیرساخت</span>
                                    </span>
                            </div>
                        </div>
                    </div>
                    <div class="file-upload">
                        <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">افزودن فایل مقاله</button>

                        <div class="image-upload-wrap">
                            <input class="file-upload-input" type='file' name="upload" onchange="readURL(this);" accept="application/pdf" />
                            <div class="drag-text">
                                <h3>بارگذاری مقاله</h3>
                            </div>
                        </div>
                        <div class="file-upload-content">
                            <img class="file-upload-image" src="/img/user/pdf.png" alt="مقاله شما" />
                            <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">حذف <span class="image-title">Uploaded Image</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group-lg">
                        <div class="col-sm-12 tac">
                            <button type="submit" class="btn btn-lg btn-success" style="width: 50%">ثبت مقاله</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p id="language_selected" style="display: none;">{{ $publication->lang }}</p>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("*:not('#menu_list')").removeClass('active');

            let volume_id = $("#volume_id");
            for(let i = 0; i < volume_id.length; i++) {
                volume_id[i].selectedIndex = 0;
            }
            $('#accepted_date').focus(function(){
                let lang = $("#language_selected").html();
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
                let lang = $("#language_selected").html();
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
            $('#publish_year').focus(function(){
                let lang = $("#language_selected").html();
                switch (lang){
                    case "en":
                        $(this).persianDatepicker({
                            calendarType: 'gregorian',
                            initialValue: false,
                            autoClose: true,
                            format: 'YYYY',
                            viewMode: 'year',
                            maxDate: Date.now(),
                        });
                    break;
                    case "fa":
                        $(this).persianDatepicker({
                            calendarType: 'persian',
                            initialValue: false,
                            autoClose: true,
                            format: 'YYYY',
                            viewMode: 'year',
                            maxDate: Date.now(),
                        });
                    break;
                }
            });
        });
        $('#keywords').tagEditor();
        function addAuthor(){
            let last_id = $(".authors_form:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;
            if(nextIndex >= 16){
                return;
            }
            $(".authors_form:last").after("<div class='authors_form col-6 border' id='authors_form_"+ nextIndex +"'></div>");

            $("#authors_form_" + nextIndex).append(' <button class="btn authors">نویسنده '+digitToFarsi(nextIndex)+'</button>\n' +
                '                                <div class="one_author">\n' +
                '                                    <div class="form-group row mt-3">\n' +
                '                                        <label for="author_name_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>نام: </label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" placeholder="" id="author_name_'+nextIndex+'" name="author_name[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <label for="author_family_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i> نام خانوادگی:</label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="author_family_'+nextIndex+'" placeholder="" name="author_family[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <label for="author_email_'+nextIndex+'" class="col-12 col-lg-2 col-form-label">ایمیل:</label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="author_email_'+nextIndex+'" placeholder="ali_ahmadi@gmail.com" name="author_email[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <label for="author_education_'+nextIndex+'" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>تحصیلات:</label>\n' +
                '                                        <select class="form-control col-12 col-lg-8 grouping" id="author_education_'+nextIndex+'" name="author_education[]">\n' +
                '                                            <option>دکتری تخصصی</option>\n' +
                '                                            <option>دکتری پزشکی</option>\n' +
                '                                            <option>دانشجوی دکتری</option>\n' +
                '                                            <option>کارشناسی ارشد</option>\n' +
                '                                            <option>دانشجوی کارشناسی ارشد</option>\n' +
                '                                            <option>کارشناسی</option>\n' +
                '                                            <option>سایر</option>\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row">\n' +
                '                                        <label for="author_rate_'+nextIndex+'" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>رتبه علمی:</label>\n' +
                '                                        <select class="form-control col-12 col-lg-8 grouping" id="author_rate_'+nextIndex+'" name="author_rate[]">\n' +
                '                                            <option>استاد</option>\n' +
                '                                            <option>دانشیار</option>\n' +
                '                                            <option>استادیار</option>\n' +
                '                                            <option>مربی</option>\n' +
                '                                            <option>ندارد</option>\n' +
                '                                            <option>سایر</option>\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                    <h6 class="alert alert-primary">وابستگی</h6>\n' +
                '                                    <div class="form-group row mt-3">\n' +
                '                                        <label for="group_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>گروه: </label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="group_'+nextIndex+'" placeholder="" name="group[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row mt-3">\n' +
                '                                        <label for="college_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>دانشکده: </label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="college_'+nextIndex+'" placeholder="" name="college[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row mt-3">\n' +
                '                                        <label for="university_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>دانشگاه: </label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="university_'+nextIndex+'" placeholder="" name="university[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row mt-3">\n' +
                '                                        <label for="city_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>شهر: </label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="city_'+nextIndex+'" placeholder="" name="city[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="form-group row mt-3">\n' +
                '                                        <label for="country_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>کشور: </label>\n' +
                '                                        <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                            <input type="text" class="form-control" id="country_'+nextIndex+'" placeholder="" name="country[]">\n' +
                '                                        </div>\n' +
                '                                    </div>\n' +
                '                                    <div class="row">\n' +
                '                                        <label class="col-form-label pr-4"><i class="fa fa-asterisk text-danger star"></i>نویسنده مسئول مقاله:</label>\n' +
                '                                        <div class="pt-1">\n' +
                '                                            <div class="custom-control custom-radio custom-control-inline">\n' +
                '                                                <input type="radio" class="custom-control-input" id="customRadioYes_'+nextIndex+'" name="author_manager_'+(nextIndex-1)+'" value="1">\n' +
                '                                                <label class="custom-control-label" for="customRadioYes_'+nextIndex+'">بلی</label>\n' +
                '                                            </div>\n' +
                '                                            <div class="custom-control custom-radio custom-control-inline">\n' +
                '                                                <input type="radio" class="custom-control-input" id="customRadioNo_'+nextIndex+'" name="author_manager_'+(nextIndex-1)+'" value="0">\n' +
                '                                                <label class="custom-control-label" for="customRadioNo_'+nextIndex+'">خیر</label>\n' +
                '                                            </div>\n' +
                '                                        </div>\n' +
                '                                    </div>');
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
                '                            <div class="row" style="margin:20px 0;">\n' +
                '                                <div class="col-sm-3 tac">\n' +
                '                                    <label for="struct_title_' + nextIndex + '">عنوان   ' + nextIndex + ' </label>\n' +
                '                                </div>\n' +
                '                                <div class="col-sm-6">\n' +
                '                                    <input type="text" name="struct_title[]" class="form-control"/>\n' +
                '                                </div>' +
                '                            </div>' +
                '                               <div id="substr_'+nextIndex+'" class="col-sm-12 form-group tal substrs">\n' +
                '                                               <span onclick="AddSubStruct(this)" class="fa fa-plus add_struct">' +
                '                                                   <span style="font-family: IRANSans; vertical-align: 2px;">زیرساخت</span>' +
                '                                               </span>\n' +
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
                '<div class="col-sm-2 form-group tal">' +
                '<label style="line-height:30px"> زیرساخت ساختار  '+counter+'<label>' +
                '</div>' +
                '<div class="col-sm-8 form-group tar">' +
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

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    //$('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping');
        });


    </script>
@endsection


