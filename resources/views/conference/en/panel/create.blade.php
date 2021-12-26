@extends('conference.en.panel.master')
@section('styles')
    <style>
        #conference_form{text-align: right;direction:ltr; padding-bottom:50px;}
        .tag-editor{padding:10px 0;}
        .title{display:none}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl; font-size:18px;}
        #conference_form{text-align: left;}
        .inputGroup {background-color: #fff;display: block;margin: 10px 0;position: relative;}
        .inputGroup label {padding: 12px 30px;width: 100%;display: block;text-align: left;color: #3c454c;cursor: pointer;position: relative;z-index: 2;transition: color 200ms ease-in;overflow: hidden;}
        .inputGroup label:before {width: 10px;height: 10px;border-radius: 50%;content: '';background-color: #5562eb;position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%) scale3d(1, 1, 1);transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);opacity: 0;z-index: -1;}
        .inputGroup label:after {width: 32px;height: 32px;content: '';border: 2px solid #d1d7dc;background-color: #fff;background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");background-repeat: no-repeat;background-position: 2px 3px;border-radius: 50%;z-index: 2;position: absolute;right: 30px;top: 50%;transform: translateY(-50%);cursor: pointer;transition: all 200ms ease-in;}
        .inputGroup input:checked ~ label {color: #fff;}
        .inputGroup input:checked ~ label:before {transform: translate(-50%, -50%) scale3d(56, 56, 1);opacity: 1;}
        .inputGroup input:checked ~ label:after {background-color: #54e0c7;border-color: #54e0c7;}
        .inputGroup input {width: 32px;height: 32px;order: 1;z-index: 2;position: absolute;right: 30px;top: 50%;transform: translateY(-50%);cursor: pointer;visibility: hidden;}
        .form {padding: 0 16px;max-width: 550px;margin: 50px auto;font-size: 18px;font-weight: 600;line-height: 36px;}
        code {background-color: #9aa3ac;padding: 0 8px;}
    </style>
@endsection

@section('user')
@endsection

@section('active_conference_register')
    active_menu
@endsection

@section('content')
    <div class="container">
        @include('message.en.errors')
        <div id="conf_form" class="row">
            <div class="col-sm-8" style="margin:auto;">
                <form action="{{ route('conference.notice.store') }}" method="post" enctype="multipart/form-data" id="conference_form">
                    @csrf
                    <div class="form-group">
                        <label>زبان</label>
                        <div class="row" style="border:1px solid rgba(0,0,0,0.27); padding:6px;">
                            <div class="col-sm-4">
                                <label for="en">انگلیسی</label>
                                <input type="radio" id="en" name="lang" value="en" style="margin:0 6px; vertical-align: middle;" />
                            </div>
                            <div class="col-sm-4">
                                <label for="fa">فارسی</label>
                                <input type="radio" id="fa" name="lang" value="fa" style="margin:0 6px; vertical-align: middle;" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_id">گروه</label>
                        <select name="group_id" id="group_id" class="form-control">
                            @foreach($groups_list as $group)
                                @php($group_name = json_decode($group->name) )
                                <option value="{{$group->id}}">{{ $group_name->fa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="major_id">رشته</label>
                        <select name="major_id" id="major_id" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">عنوان</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"/>
                    </div>

                    <div class="form-group">
                        <label class="alert alert-success" for="subject">محورها-موضوعات</label>
                        <textarea name="subject" id="subject" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="country">کشور</label>
                        <select id="country" name="country" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="alert alert-info">برگزارکننده</label>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-4">--}}
                                {{--<label for="university">دانشگاه</label>--}}
                                {{--<input type="text" name="university" id="university" class="form-control" value="{{ old('university') }}"/>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label for="conference_publisher">ناشر</label>
                        <input type="text" name="conference_publisher" id="conference_publisher" class="form-control" value="{{ old('conference_publisher') }}" />
                    </div>

                    <div class="form-group">
                        <label for="ISBN">شابک</label>
                        <input type="text" name="ISBN" id="ISBN" class="form-control" value="{{ old('ISBN') }}" />
                    </div>
                    <div class="form-group">
                        <label for="printISSN">شاپا چاپی</label>
                        <input type="text" name="printISSN" id="printISSN" class="form-control" value="{{ old('printISSN') }}" />
                    </div>
                    <div class="form-group">
                        <label for="onlineISSN">شاپا الکترونیکی</label>
                        <input type="text" name="onlineISSN" id="onlineISSN" class="form-control" value="{{ old('onlineISSN') }}" />
                    </div>

                    <div class="form-group">
                        <label for="level">سطح برگزاری</label>
                        <select name="level" id="level" class="form-control">
                            <option value="international">بین المللی</option>
                            <option value="regional">منطقه ای</option>
                            <option value="national">ملی</option>
                            <option value="provincial">استانی</option>
                            <option value="inner">سازمانی</option>
                        </select>
                    </div>

                    <div class="form-group-lg">
                        <label for="" class="alert alert-primary">نوع دسترسی</label>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="free">آزاد</label>
                                <input type="radio" name="access" id="free" value="free" class="radio" style="vertical-align: middle;"/>
                            </div>
                            <div class="col-sm-6">
                                <label for="money">حق اشتراک</label>
                                <input type="radio" name="access" id="money" value="money" class="radio" style="vertical-align: middle;"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-lg">
                        <label for="" class="alert alert-primary">نوع مقالات</label>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="abstract">چکیده</label>
                                <input type="radio" name="type" id="abstract" value="abstract" class="radio" style="vertical-align: middle;"/>
                            </div>
                            <div class="col-sm-6">
                                <label for="fulltext">کامل</label>
                                <input type="radio" name="type" id="fulltext" value="fulltext" class="radio" style="vertical-align: middle;"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-lg">
                        <label for="DOI">DOI</label>
                        <input type="text" id="DOI" name="DOI" class="form-control"/>
                    </div><hr/>

                    <div class="tac form-group-lg">
                        <button type="submit" class="btn btn-outline-primary">ثبت کنفرانس</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $('#subject').tagEditor({
        delimiter: ';',
    });

    $(document).ready(function(){
        $("*:not('#menu_journal_register')").removeClass('active');
        let country_id = $("#country").val();
        $("#city").empty();
        $.ajax({
            'url': '{{ route("conference.notice.get.cities") }}',
            'type': 'post',
            'data': {'_token': '{{ csrf_token() }}', country_id},
            'success': function (data) {
                $.each(data, (key, value) => {
                    $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
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
    $("#country").change(function(){
        $("#progressbar").show("fast");
        let country_id = $(this).val();
        $.ajax({
            'url': '{{ route("conference.notice.get.cities") }}',
            'type': 'post',
            'data': {'_token': '{{ csrf_token() }}', country_id},
            'success': function (data) {
                $("#city").empty();
                $("#progressbar").hide("fast");
                $.each(data, (key, value) => {
                    $("#city").append('<option value="' + value.id + '">' + value.name + '</option>');
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

    $("#ran_btn").click(function(){
        let ran_yes = $("#ran_yes");
        let ran_no = $("#ran_no");
        if(ran_yes.prop('checked') === true){
            $("#ran_container").hide("slow");
            $("#conf_form").show("fast");
            $("#website_wrapper").show("fast");
            $("#website").val("");
            $("#website_wrapper").show("fast");
            $("#type").val(2);
        }else if(ran_no.prop('checked') === true){
            $("#ran_container").hide("slow");
            $("#conf_form").show("fast");
            $("#website_wrapper").show("fast");
            $("#website_label").html("آدرس دامنه مورد نظر");
            $("#letter_wrapper").show("fast");
            $("#website").val("");
            $("#type").val(3);
        }
    });

</script>
@endsection