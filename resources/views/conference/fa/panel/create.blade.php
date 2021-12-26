@extends('conference.fa.panel.master')
@section('styles')
    <style>
        body{direction:rtl;font-family:"BYekan"!important}.form-control{border:1.2px solid #3498db;background-color:#fff;border-radius:0;height:30px;padding:0;font-size:13px;padding-right:5px}input .custom-file-input{border:1.2px solid #3498db;background-color:#fff;border-radius:0;height:30px;padding:0;font-size:13px;padding-right:5px}.input-group-text{border-radius:0;width:40px;background-color:transparent}input[type="text"]{font-size:13px;color:#e3e3e3}input[type="text"]:focus{border-color:#3498db;box-shadow:1px 2px 1px #3498db}select:focus option{font-size:12px}.col-form-label{font-size:13px;color:#005b89}.input-wrapper:before{content:"\f044";font-family:FontAwesome;font-style:normal;font-weight:400;text-decoration:inherit;color:#af5e7c;font-size:18px;padding-right:.5em;position:absolute;top:3px;left:20px;z-index:100}i.star{font-size:7px;padding:2px}.custom-control-label{font-size:13px;color:#005b89}.author-arribute{background-color:#dee2e68a;margin-top:40px}button.add-author{background-color:purple;font-size:13px;color:#fff;margin:10px}button.authors{background-color:#1e347b;font-size:13px;color:#fff;margin:5px}
        .file-upload{background-color:#fff;width:250px;margin:0 auto;padding:20px}.file-upload-btn{width:100%;margin:0;color:#fff;background:#9b59b6;border:none;padding:10px;border-radius:4px;border-bottom:4px solid #9b59b6;transition:all .2s ease;outline:none;text-transform:uppercase;font-weight:700}.file-upload-btn:hover{background:#9b59b6;color:#fff;transition:all .2s ease;cursor:pointer}.file-upload-btn:active{border:0;transition:all .2s ease}.file-upload-content{display:none;text-align:center}.file-upload-input{position:absolute;margin:0;padding:0;width:100%;height:100%;outline:none;opacity:0;cursor:pointer}.image-upload-wrap{margin-top:20px;border:4px dashed #1e347b;position:relative}.image-dropping,.image-upload-wrap:hover{background-color:#b9bbbe;border:4px dashed #fff}.image-title-wrap{padding:0 15px 15px;color:#222}.drag-text{text-align:center}.drag-text h3{font-weight:100;text-transform:uppercase;color:#2A4DB3;padding:60px 0}.file-upload-image{max-height:0px;max-width:0px;margin:auto;padding:20px}.remove-image{width:200px;margin:0;color:#fff;background:#cd4535;border:none;padding:10px;border-radius:4px;border-bottom:4px solid #b02818;transition:all .2s ease;outline:none;text-transform:uppercase;font-weight:700}.remove-image:hover{background:#c13b2a;color:#fff;transition:all .2s ease;cursor:pointer}.remove-image:active{border:0;transition:all .2s ease}
        .tag-editor{width:100%;}
        .remove_organizer{padding:4px; color:#f1f1f1; border-radius:4px; background-color: tomato}
        .remove_organizer:hover{}
    </style>
@endsection

@section('user')
@endsection

@section('active_conference_register')
    active_menu
@endsection

@section('content')
    <div class="container" style="margin-bottom:30px;">
        @include('message.errors')
        <div id="conf_form" class="row">
            <form action="{{ route('conference.notice.store.fa') }}" method="post" enctype="multipart/form-data" id="">
                @csrf
                <div class="container border p-5">
                    <h5 class="text-center text-info pb-5">مشخصات ثابت کنفرانس</h5>
                    <div class="form-group row">
                        <label for="title" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>عنوان کنفرانس</label>
                        <div class="input-group col-12 col-lg-10 input-wrapper">
                            <input type="text" class="form-control" id="title" placeholder="لطفا عنوان کنفرانس را در این قسمت وارد کنید" name="title">
                        </div>
                    </div>
                    <div class="form-group row pt-4">
                        <label for="subject" class="col-12 col-lg-2  col-form-label"><i class="fa fa-asterisk text-danger star"></i>موضوعات(محورها)</label>
                        <div class="input-group col-12 col-lg-10">
                            <input type="text" class="form-control" id="subject" placeholder="" name="subject">
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="group_id" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>گروه</label>
                                <select class="form-control col-12 col-lg-9 grouping" id="group_id" name="group_id">
                                    @foreach($groups_list as $group)
                                        @php($group_name = json_decode($group->name) )
                                        <option value="{{$group->id}}">{{ $group_name->fa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="major_id" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>رشته</label>
                                <select class="form-control col-12 col-lg-9" id="major_id" name="major_id">
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="lang" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>زبان</label>
                                <select class="form-control col-12 col-lg-9" id="lang" name="lang">
                                    <option value="en">انگلیسی</option>
                                    <option value="fa">فارسی</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row tac mt-4">
                        <div class="col-sm-1">
                            <label class="col-form-label" for="country"><i class="fa fa-asterisk text-danger star"></i>کشور</label>
                        </div>
                        <div class="col-sm-10">
                            <select id="country" name="country" class="form-control">
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row author-arribute">
                        <div class="col-4">
                            <a class="btn pull-right title alert alert-primary">برگزارکنندگان</a>
                        </div>
                        <div class="offset-4">

                        </div>
                        <div class="col-4">
                            <button type="button" onclick="addOrganizer()" class="btn pull-left add-author"><i class="fa fa-plus pl-2"></i>افزودن برگزارکننده</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-6 border pt-3 organizer_form" id="organizer_form_1">
                            <span class="fa fa-remove remove_organizer"></span>
                            <span class="alert alert-success" style="float: right;"> برگزارکننده اول</span>
                            <div class="form-group row mt-3" style="clear: both">
                                <label for="organizer_name_1" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>برگزارکننده: </label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="organizer_name_1" placeholder="" name="organizer_name[]">
                                </div>
                            </div>
                            <div class="row">
                                <label for="" class="col-form-label"><i class="fa fa-asterisk text-danger star"></i>لوگوی برگزارکننده: </label>
                                <div class="form-group">
                                    <input class="form-control mr-3" target-id="pic_1" name="organizer_pic[]" type='file' onchange="readURL(this);" accept="image/*" style="height:auto;" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="level" class="col-12 col-lg-5 col-form-label"><i class="fa fa-asterisk text-danger star"></i>سطح برگزاری</label>
                                <select class="form-control col-12 col-lg-7" id="level" name="level">
                                    <option value="international">بین المللی</option>
                                    <option value="regional">منطقه ای</option>
                                    <option value="national">ملی</option>
                                    <option value="provincial">استانی</option>
                                    <option value="inner">سازمانی</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="access" class="col-12 col-lg-5 col-form-label">نوع دسترسی</label>
                                <select class="form-control col-12 col-lg-7" id="access" name="access">
                                    <option value="open">دسترسی آزاد</option>
                                    <option value="pay">پرداخت حق اشتراک</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="form-group row">
                                <label for="type" class="col-12 col-lg-5 col-form-label"><i class="fa fa-asterisk text-danger star"></i>نوع مقالات</label>
                                <select class="form-control col-12 col-lg-7" id="type" name="type">
                                    <option value="abstract">چکیده</option>
                                    <option value="fulltext">متن کامل</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="conference_publisher" class="col-12 col-lg-3 col-form-label"><i class="fa fa-asterisk text-danger star"></i>ناشر</label>
                                <div class="input-group col-12 col-lg-9 input-wrapper">
                                    <input type="text" class="form-control" id="conference_publisher" placeholder="لطفا عنوان ناشر را وارد کنید" name="conference_publisher">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="ISBN" class="col-12 col-lg-2 col-form-label">شابک</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="ISBN" placeholder="" name="ISBN">
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
                    <div class="row pt-4">
                        <div class="col-12 col-lg-3">
                            <div class="form-group row">
                                <label for="DOI" class="col-12 col-lg-2 col-form-label">DOI</label>
                                <div class="input-group col-12 col-lg-10 input-wrapper">
                                    <input type="text" class="form-control" id="DOI" placeholder="" name="DOI">
                                </div>
                            </div>
                        </div>
                        <div class="offset-3">

                        </div>
                        <div class="offset-3">

                        </div>
                        <div class="offset-3">

                        </div>
                    </div><hr/>
                    <div class="form-group-lg tac">
                        <button type="submit" class="btn btn-primary btn-lg" style="width:50%">ثبت کنفرانس</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("*:not('#menu_journal_register')").removeClass('active');
    });

    $('#subject').tagEditor();
    $("#start_date ,#end_date").persianDatepicker({
        calendarType: 'gregorian',
        initialValue: false,
        autoClose: true,
        format: 'YYYY-MM-DD H:mm',
        viewMode: 'year',
        maxDate: Date.now(),
        'timePicker' : {
            enabled : true,
            step : true,
            second : false
        } ,
        'persian': {
            'locale': 'en',
            'showHint': false,
            'leapYearMode': 'algorithmic' // "astronomical"
        },

        'gregorian': {
            'locale': 'en',
            'showHint': false
        }
    });
    $("#sendArticleDate,#sendAbstractDate,#declareRefereeDate").persianDatepicker({
        calendarType: 'gregorian',
        initialValue: false,
        autoClose: true,
        format: 'YYYY-MM-DD',
        viewMode: 'year',
        maxDate: Date.now(),
        'persian': {
            'locale': 'en',
            'showHint': false,
            'leapYearMode': 'algorithmic' // "astronomical"
        },

        'gregorian': {
            'locale': 'en',
            'showHint': false
        }
    });
    $("#group_id").change(function() {
        $("#progressbar").show("fast");
        $("#major_id").empty();
        let group = this.value;
        $.ajax({
            'url': '/group/' + group,
            'type': 'post',
            'data': {'_token': '{{ csrf_token() }}', 'group': group},
            'success': function (data) {
                $("#progressbar").hide("fast");
                $.each(data, (key, value) => {
                    let major_name = JSON.parse(value.name);
                    $("#major_id").append('<option value="' + value._id + '">' + major_name.en + '</option>');
                });
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

    function addOrganizer(){
        let last_id = $(".organizer_form:last").attr("id");
        let split_id = last_id.split("_");
        let nextIndex = Number(split_id[2]) + 1;
        if(nextIndex >= 7){
            return;
        }
        $(".organizer_form:last").after("<div class='organizer_form col-6 border' id='organizer_form_"+ nextIndex +"'></div>");

        $("#organizer_form_" + nextIndex).append('<span class="alert alert-success" style="float: right;"> برگزارکننده '+digitToFarsi(nextIndex)+'</span>\n' +
            '                            <div class="form-group row mt-3" style="clear: both">\n' +
            '                                <label for="organizer_name_'+nextIndex+'" class="col-12 col-lg-2 col-form-label"><i class="fa fa-asterisk text-danger star"></i>برگزارکننده: </label>\n' +
            '                                <div class="input-group col-12 col-lg-10 input-wrapper">\n' +
            '                                    <input type="text" class="form-control" id="organizer_name_'+nextIndex+'" placeholder="" name="organizer_name[]">\n' +
            '                                </div>\n' +
            '                            </div>\n' +
            '                            <div class="row">\n' +
            '                                <label for="" class="col-form-label"><i class="fa fa-asterisk text-danger star"></i>لوگوی برگزارکننده: </label>\n' +
            '                                <div class="form-group">\n' +
            '                                    <input class="form-control mr-3" target-id="pic_'+nextIndex+'" name="organizer_pic[]" type=\'file\' onchange="readURL(this);" accept="image/*" style="height:auto;" />\n' +
            '                                </div>\n' +
            '                            </div>');
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('.image-upload-wrap').hide();
                let target_id = $(input).attr("target-id");
                //$('.file-upload-image').attr('src', e.target.result);
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


</script>
@endsection