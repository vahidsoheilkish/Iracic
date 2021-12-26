@extends('publication.fa.dashboard.master')
@section('styles')
    <style>
        .form-control{border:1.2px solid #3498db;background-color:#fff;border-radius:0;height:30px;padding:0;font-size:13px;padding-right:5px}input .custom-file-input{border:1.2px solid #3498db;background-color:#fff;border-radius:0;height:30px;padding:0;font-size:13px;padding-right:5px}.input-group-text{border-radius:0;width:40px;background-color:transparent}input[type="text"]{font-size:13px;color:#e3e3e3}input[type="text"]:focus{border-color:#3498db;box-shadow:1px 2px 1px #3498db}select:focus option{font-size:12px}.col-form-label{font-size:13px;color:#005b89}.input-wrapper:before{content:"\f044";font-family:FontAwesome;font-style:normal;font-weight:400;text-decoration:inherit;color:#af5e7c;font-size:18px;padding-right:.5em;position:absolute;top:3px;left:20px;z-index:100}i.star{font-size:7px;padding:2px}.custom-control-label{font-size:13px;color:#005b89}.author-arribute{background-color:#dee2e68a;margin-top:40px}button.add-author{background-color:purple;font-size:13px;color:#fff;margin:10px}button.authors{background-color:#1e347b;font-size:13px;color:#fff;margin:5px}.file-upload{background-color:#fff;width:250px;margin:0 auto;padding:20px}.file-upload-btn{width:100%;margin:0;color:#fff;background:#9b59b6;border:none;padding:10px;border-radius:4px;border-bottom:4px solid #9b59b6;transition:all .2s ease;outline:none;text-transform:uppercase;font-weight:700}.file-upload-btn:hover{background:#9b59b6;color:#fff;transition:all .2s ease;cursor:pointer}.file-upload-btn:active{border:0;transition:all .2s ease}.file-upload-content{display:none;text-align:center}.file-upload-input{position:absolute;margin:0;padding:0;width:100%;height:100%;outline:none;opacity:0;cursor:pointer}.image-upload-wrap{margin-top:20px;border:3px dashed grey;position:relative}.image-dropping,.image-upload-wrap:hover{background-color:#b9bbbe;border:4px dashed #fff}.image-title-wrap{padding:0 15px 15px;color:#222}.drag-text{text-align:center}.drag-text h3{font-weight:100;text-transform:uppercase;color:#2A4DB3;padding:60px 0}.file-upload-image{max-height:250px;max-width:250px;margin:auto;padding:20px}.remove-image{width:200px;margin:0;color:#fff;background:#cd4535;border:none;padding:10px;border-radius:4px;border-bottom:4px solid #b02818;transition:all .2s ease;outline:none;text-transform:uppercase;font-weight:700}.remove-image:hover{background:#c13b2a;color:#fff;transition:all .2s ease;cursor:pointer}.remove-image:active{border:0;transition:all .2s ease}
        .tag-editor{width:100%;}
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div id="submit_container" class="col-sm-12">
                <h3 class="tar" style="color:tomato;">ثبت نشریه</h3><hr/>
                @include('message.errors')
                <form action="{{ route('publication.store.fa') }}" enctype="multipart/form-data" method="post" class="form-horizontal" id="" novalidate>
                    @csrf
                    <h5 class="text-center text-info pb-4">مشخصات مجله</h5>
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="title" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>عنوان مجله</label>
                            <div class="input-group col-12 col-lg-10 input-wrapper">
                                <input type="text" class="form-control" id="title" name="title" placeholder="لطفا عنوان مجله را در این قسمت وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row pt-4">
                        <label for="subject" class="col-12 col-lg-2  col-form-label"><i class="fa fa-asterisk text-danger star"></i>موضوعات(محورها)</label>
                        <div class="input-group col-12 col-lg-10">
                            <input type="text" class="form-control" id="subject" placeholder="" name="subject">
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="group_id" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>گروه</label>
                                <select class="form-control col-12 col-lg-9 grouping" id="group_id" name="group_id">
                                    @foreach($groups_list as $group)
                                        @php( $group_name= json_decode($group->name) )
                                        <option value="{{ $group->id }}">{{ $group_name->fa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="major_id" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>رشته</label>
                                <select class="form-control col-12 col-lg-9" id="major_id" name="major_id">
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="lang" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>زبان</label>
                                <select class="form-control col-12 col-lg-9" id="lang" name="lang">
                                    <option value="en">انگلیسی</option>
                                    <option value="fa">فارسی</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="country" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>کشور</label>
                                <select class="form-control col-12 col-lg-9" id="country" name="country">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="publication_publisher" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>ناشر</label>
                                <div class="input-group col-12 col-lg-9 input-wrapper">
                                    <input type="text" class="form-control" id="publication_publisher" placeholder="لطفا عنوان ناشر را وارد کنید" name="publication_publisher">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="ISBN" class="col-12 col-lg-2 col-form-label">شابک</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" name="ISBN" id="ISBN" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="printISSN" class="col-12 col-lg-4 col-form-label">شاپا چاپی</label>
                                <div class="input-group col-12 col-lg-8 input-wrapper">
                                    <input type="text" class="form-control" id="printISSN" placeholder="" name="printISSN">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="onlineISSN" class="col-12 col-lg-5 col-form-label">شاپا الکترونیکی</label>
                                <div class="input-group col-12 col-lg-7 input-wrapper">
                                    <input type="text" class="form-control" id="onlineISSN" placeholder="" name="onlineISSN">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-4">
                        <div class="col-12 col-lg-6">
                            <div class="form-group row">
                                <label for="website" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>آدرس وب سایت</label>
                                <div class="input-group col-12 col-lg-9 input-wrapper">
                                    <input type="text" class="form-control" id="website" placeholder="www.google.com" name="website">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="DOI" class="col-12 col-lg-2 col-form-label">DOI</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="DOI" placeholder="" name="DOI">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="publisher_order" class="col-12 col-lg-6 col-form-label"><i class="fa fa-asterisk text-danger star"></i>ترتیب انتشار:</label>
                                <select class="form-control col-12 col-lg-6" id="publisher_order" name="publisher_order">
                                    <option value="week">هفتگی</option>
                                    <option value="biweek">دو هفتگی</option>
                                    <option value="month">ماهنامه(12 شماره)</option>
                                    <option value="bimonth">دو ماهنامه(6 شماره)</option>
                                    <option value="season">فصلنامه(4 شماره)</option>
                                    <option value="triannual">چهارماه نامه(3 شماره)</option>
                                    <option value="biseason">دو فصلنامه(24 شماره)</option>
                                    <option value="annual">سالنامه(1 شماره)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="first_publish_year" class="col-12 col-lg-5 col-form-label"><i class="fa fa-asterisk text-danger star"></i>اولین سال انتشار</label>
                                <div class="input-group col-12 col-lg-7 input-wrapper">
                                    <input type="text" class="form-control" id="first_publish_year" placeholder="از سال 1350 شمسی" name="first_publish_year">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="access" class="col-12 col-lg-4 col-form-label">نوع دسترسی</label>
                                <select class="form-control col-12 col-lg-8" id="access" name="access">
                                    <option value="open">دسترسی آزاد</option>
                                    <option value="money">پرداخت حق اشتراک</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="type" class="col-12 col-lg-5 col-form-label"><i class="fa fa-asterisk text-danger star"></i> نوع مقالات مجله</label>
                                <select class="form-control col-12 col-lg-7" id="type" name="type">
                                    <option value="abstract">چکیده</option>
                                    <option value="fulltext">کامل</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 tar">
                            <label for="" class="col-form-label"><i class="fa fa-asterisk text-danger star"></i>آپلود پوستر مجله: </label>
                            <div class="file-upload">
                                <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">افزودن تصویر</button>
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input" type='file' name="poster" onchange="readURL(this);" accept="image/*" />
                                    <div class="drag-text">
                                        <h3>آپلود پوستر </h3>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">حذف <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="offset-9">

                        </div>
                    </div>
                    <div class="row author-arribute">
                        <div class="col-4">
                            <a class="alert alert-info pull-right title">اطلاعات تماس</a>
                        </div>
                        <div class="offset-4">

                        </div>
                        <div class="col-4">
                            <button type="button" onclick="addCallInfo()" class="btn  btn-info pull-left add-author"><i class="fa fa-plus pl-2"></i>افزودن اطلاعات تماس</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 border pt-3 call_form" id="call_form_1">
                            <p class="alert alert-success authors pull-right">اطلاعات تماس اول</p>
                            <div class="form-group row pt-3" style="clear: both;">
                                <label for="address_1" class="col-form-label pr-1">نشانی پستی:</label>
                                <textarea style="min-height:100px" class="col-10 mr-2" name="address[]" id="address_1"></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="tell_1" class="col-12 col-lg-2 col-form-label">تلفن تماس:</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="tell_1" name="tell[]" placeholder="09185321212-07166543423">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fax_1" class="col-12 col-lg-2 col-form-label">فکس:</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="fax_1" name="fax[]" placeholder="09185321212-07166543423">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_1" class="col-12 col-lg-2 col-form-label">ایمیل:</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="email_1" name="email[]" placeholder="alirezai@gmail.com-rezai_ali@yahoo.com">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row author-arribute">
                        <div class="col-4">
                            <a class="alert alert-success pull-right title">اطلاعات سازمان مجله</a>
                        </div>
                        <div class="offset-4">

                        </div>
                        <div class="col-4">
                            <button type="button" onclick="addConferenceGroup()" class="btn pull-left add-author"><i class="fa fa-plus pl-2"></i>افزودن سازمان مجله</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 border conference_group" id="conference_group_1">
                            <p class="alert alert-info authors pull-right">سازمان کنفرانس اول</p>
                            <div class="form-group row pt-3" style="clear: both;">
                                <label for="job_1" class="col-12 col-lg-2 col-form-label pr-1"><i class="fa fa-asterisk text-danger star"></i>سمت:</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="job_1" name="job[]" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fullname_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>نام و نام خانوادگی:</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="fullname_1" name="fullname[]" placeholder="">
                                </div>
                            </div>
                            <div class="row" style="padding:6px;">
                                <label for="organizer_1" class="col-form-label"><i class="fa fa-asterisk text-danger star"></i>آپلود تصویر: </label>
                                <div class="btn btn-dark" style="margin:auto">
                                    <input class="" type='file' onchange="readURL(this);" accept="image/*" id="organizer_1" name="organizer[]"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group-lg tac" style="min-height: 200px;">
                        <button type="submit" class="btn btn-success btn-lg" style="width:50%">ثبت نشریه</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p id="result"></p>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_journal_register')").removeClass('active');
            let group_list = $("#group_id");
            for(let i = 0; i < group_list.length; i++) {
                group_list[i].selectedIndex =0;
            }
            $("#lang_en").trigger('click');
        });
        $('#subject').tagEditor();

        function setYearsByLang(e){
            let first_publish_year = $("#first_publish_year");
            first_publish_year.empty();
            switch ($(e).val()){
                case 'en':
                    for(let i = 2019; i>=1994; i--) {
                        first_publish_year.append('<option value="'+i+'" class="rtl">'+i+' میلادی </option>')
                    }
                    break;

                case 'fa':
                    for(let i = 1398; i>=1370; i--) {
                        first_publish_year.append('<option value="'+i+'" class="rtl">'+i+' شمسی </option>')
                    }
                    break;

                case 'ar':
                    for(let i = 1440; i>=1425; i--) {
                        first_publish_year.append('<option value="'+i+'" class="rtl">'+i+' قمری </option>')
                    }
                    break;
            }
        }

        $("#group_id").change(function(){
            $("#progressbar").show("fast");
            let id = $(this).children(":selected").attr("value");
            let major_id = $("#major_id");
            $.ajax({
                'url' : '/fa/publication/majors/group/'+id ,
                'type' : 'POST' ,
                'data' : {_token : '{{csrf_token()}}' , id} ,
                'dataType' : 'json' ,
                'success' : function(data){
                    setTimeout(function(){
                        $("#progressbar").hide("fast");
                    } , 500);
                    major_id.empty();
                    for(let i=0; i<data.length; i++){
                        let major_name = JSON.parse(data[i].name);
                        major_id.append('<option value="'+data[i]._id+'">'+ major_name.en +'</option>');
                    }
                }
            });
        });

        const $inputs = document.getElementsByClassName('input');
        for (let inputIndex = $inputs.length - 1; inputIndex >= 0; inputIndex--) {
            const $input = $inputs[inputIndex];
            // ...
        }
        const $radiobuttons = document.getElementsByClassName('input--radio');
        for (let radioIndex = $radiobuttons.length - 1; radioIndex >= 0; radioIndex--) {
            const $radio = $radiobuttons[radioIndex];
            // ...
        }
        setTimeout(() => { /* TODO: prevent this timeout */
            const $preloadElements = document.getElementsByClassName('preload');
            for (let preloadIndex = $preloadElements.length - 1; preloadIndex >= 0; preloadIndex--) {
                const $preload = $preloadElements[preloadIndex];
                $preload.classList.remove('preload');
            }
        }, 500);

        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();
                    $('.file-upload-image').attr('src', e.target.result);
                    //$("#"+target_id).attr('src', e.target.result);
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

        function addCallInfo(){
            let last_id = $(".call_form:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;
            if(nextIndex >= 5){
                return;
            }
            $(".call_form:last").after("<div class='call_form col-6 border' id='call_form_"+ nextIndex +"'></div>");

            $("#call_form_" + nextIndex).append('<p class="alert alert-success authors pull-right mt-3">اطلاعات تماس '+digitToFarsi(nextIndex)+'</p>\n' +
                '                                <div class="form-group row pt-3" style="clear: both;">\n' +
                '                                    <label for="address_'+nextIndex+'" class="col-form-label pr-1">نشانی پستی:</label>\n' +
                '                                    <textarea style="min-height:100px" class="col-10 mr-2" name="address[]" id="address_'+nextIndex+'"></textarea>\n' +
                '                                </div>\n' +
                '                                <div class="form-group row">\n' +
                '                                    <label for="tell_'+nextIndex+'" class="col-12 col-lg-2 col-form-label">تلفن تماس:</label>\n' +
                '                                    <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                        <input type="text" class="form-control" id="tell_'+nextIndex+'" name="tell[]" placeholder="09185321212-07166543423">\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="form-group row">\n' +
                '                                    <label for="fax_'+nextIndex+'" class="col-12 col-lg-2 col-form-label">فکس:</label>\n' +
                '                                    <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                        <input type="text" class="form-control" id="fax_'+nextIndex+'" name="fax[]" placeholder="09185321212-07166543423">\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="form-group row">\n' +
                '                                    <label for="email_'+nextIndex+'" class="col-12 col-lg-2 col-form-label">ایمیل:</label>\n' +
                '                                    <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                        <input type="text" class="form-control" id="email_'+nextIndex+'" name="email[]" placeholder="alirezai@gmail.com-rezai_ali@yahoo.com">\n' +
                '                                    </div>\n' +
                '                                </div>');
        }

        function addConferenceGroup(){
            let last_id = $(".conference_group:last").attr("id");
            let split_id = last_id.split("_");
            let nextIndex = Number(split_id[2]) + 1;
            if(nextIndex >= 7){
                return;
            }
            $(".conference_group:last").after("<div class='conference_group col-6 border' id='conference_group_"+ nextIndex +"'></div>");

            $("#conference_group_" + nextIndex).append('<p class="alert alert-info authors pull-right">سازمان کنفرانس '+digitToFarsi(nextIndex)+'</p>\n' +
                '                                <div class="form-group row pt-3" style="clear: both;">\n' +
                '                                    <label for="job_'+nextIndex+'" class="col-12 col-lg-2 col-form-label pr-1"><i class="fa fa-asterisk text-danger star"></i>سمت:</label>\n' +
                '                                    <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                        <input type="text" class="form-control" id="job_'+nextIndex+'" name="job[]" placeholder="">\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="form-group row">\n' +
                '                                    <label for="fullname_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>نام و نام خانوادگی:</label>\n' +
                '                                    <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
                '                                        <input type="text" class="form-control" id="fullname_'+nextIndex+'" name="fullname[]" placeholder="">\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <div class="row" style="padding:6px;">\n' +
                '                                    <label for="organizer_'+nextIndex+'" class="col-form-label"><i class="fa fa-asterisk text-danger star"></i>آپلود تصویر: </label>\n' +
                '                                    <div class="btn btn-dark" style="margin:auto">\n' +
                '                                        <input class="" type=\'file\' onchange="readURL(this);" accept="image/*" id="organizer_'+nextIndex+'" name="organizer[]"/>\n' +
                '                                    </div>\n' +
                '                                </div>');
        }



    </script>
@endsection