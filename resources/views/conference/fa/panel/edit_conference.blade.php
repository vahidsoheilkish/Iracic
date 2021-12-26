@extends('conference.fa.panel.master')

@section('styles')
    <style>
        .old_poster{width:400px; border:1px solid tomato; border-radius:3px;}
        #conference_form{direction: rtl; text-align: right;}
    </style>
@endsection

@section('content')
    <div class="col-sm-8" style="margin:20px auto;">
        <form action="{{ route('conference.notice.update.conference.fa' , ['conference'=>$conference->id]) }}" method="post" enctype="multipart/form-data" id="conference_form">
            @include('message.errors')
            @csrf
            {{ method_field("PATCH") }}
            <div class="form-group">
                <label>زبان</label>
                <div class="row" style="border:1px solid rgba(0,0,0,0.27); padding:6px;">
                    <div class="col-sm-4">
                        <label for="en">انگلیسی</label>
                        <input type="radio" id="en" name="lang" {{$conference->lang=="en" ? "checked" : ""}} value="en" style="margin:0 6px; vertical-align: middle;" />
                    </div>
                    <div class="col-sm-4">
                        <label for="fa">فارسی</label>
                        <input type="radio" id="fa" name="lang" {{$conference->lang=="fa" ? "checked" : ""}} value="fa" style="margin:0 6px; vertical-align: middle;" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="group_id">گروه</label>
                <select name="group_id" id="group_id" class="form-control">
                    @foreach($groups_list as $group)
                        @php($group_name = json_decode($group->name) )
                        @if($conference->group_id == $group->id)
                            <option value="{{$group->id}}" selected>{{ $group_name->fa }}</option>
                        @else
                            <option value="{{$group->id}}">{{ $group_name->fa }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="major_id">رشته</label>
                <select name="major_id" id="major_id" class="form-control">
                </select>
            </div>
            <div class="form-group">
                @php($title = json_decode($conference->title) )
                <label for="title">عنوان</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $title->l1 }}"/>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="start_date">تاریخ شروع</label>
                        <input type="text" name="start_date" id="start_date" class="form-control" value="{{ date("Y-m-d h:i",$conference->startDate) }}" readonly/>
                    </div>
                    <div class="col-sm-6">
                        <label for="end_date">تاریخ پایان</label>
                        <input type="text" name="end_date" id="end_date" class="form-control" value="{{ date("Y-m-d h:i",$conference->endDate) }}" readonly/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="alert alert-info">برگزارکننده</label>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="university">دانشگاه</label>
                        <input type="text" name="university" id="university" class="form-control" value="{{ $conference->organizer }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="place">محل برگزاری</label>
                <input type="text" id="place" name="place" class="form-control" value="{{ $conference->place }}"/>
            </div>
            <div class="form-group alert alert-info">
                <h4>سازمان کنفرانس</h4>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="chief">ریاست شواری سیاست گذاری</label>
                    <input type="text" name="chief" id="chief" class="form-control" value="{{ $conference->chief }}"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="conferencePresidency">ریاست کنفرانس</label>
                    <input type="text" name="conferencePresidency" id="conferencePresidency" class="form-control" value="{{ $conference->conferencePresidency }}"/>
                </div>
                <div class="form-group col-sm-6">
                    <label for="conferenceSecretary">دبیر کنفرانس</label>
                    <input type="text" name="conferenceSecretary" id="conferenceSecretary" class="form-control" value="{{ $conference->conferenceSecretary }}"/>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="scientificSecretary">دبیر علمی</label>
                    <input type="text" name="scientificSecretary" id="scientificSecretary" class="form-control" value="{{ $conference->scientificSecretary }}"/>
                </div>
                <div class="form-group col-sm-6">
                    <label for="executiveSecretary">دبیر اجرایی</label>
                    <input type="text" name="executiveSecretary" id="executiveSecretary" class="form-control" value="{{ $conference->executiveSecretary }}"/>
                </div>
            </div><hr/>

            @if($conference->type==2)
                <div id="website_wrapper" class="form-group" style="">
                    <label for="website" id="website_label">وب سایت کنفرانس</label>
                    <input type="text" name="website" id="website" class="form-control" value="-{{ $conference->website }}"/>
                </div>
            @elseif($conference->type==3)
                <div id="website_wrapper" class="form-group" style="">
                    <label for="website" id="website_label">آدرس دامنه موردنظر</label>
                    <input type="text" name="website" id="website" class="form-control" value="-{{ $conference->website }}"/>
                </div>
            @endif

            <div class="form-group tac">
                <p class="alert alert-warning">تصویر قبلی</p>
                <img class="old_poster" src="{{conference_assets_path}}/{{$conference->poster}}"/>
            </div>

            <div class="form-group">
                <label for="poster">پوستر جدید</label>
                <input type="file" id="poster" name="poster" class="form-control btn btn-warning" style="padding:0;"/>
            </div>

            @if($conference->type == 3)
                <div class="form-group tac">
                    <p class="alert alert-warning">نامه درخواست قبلی</p>
                    <a href="{{conference_assets_path}}/{{$conference->dir}}/letter.pdf"><span class="fa  fa-file-pdf-o" style="font-size:24px;vertical-align: middle; margin:0 6px;"></span>Download</a>
                </div>
                <div id="letter_wrapper" class="form-group">
                    <label for="letter">آپلود درخواست نامه وب سایت</label>
                    <input type="file" id="letter" name="letter" class="form-control btn btn-primary" style="padding:0;"/>
                </div>
            @endif

            <input type="hidden" id="type" name="type" value=""/>
            <div class="tac col-sm-12">
                <button type="submit" class="btn btn-info" style="width:100%;">ویرایش کنفرانس</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_list')").removeClass('active');
            $(document).ready(function(){
                $("*:not('#menu_journal_register')").removeClass('active');
                let country_id = $("#country").val();
                $("#city").empty();
                $.ajax({
                    'url': '{{ route("conference.notice.get.cities.fa") }}',
                    'type': 'post',
                    'data': {'_token': '{{ csrf_token() }}', country_id},
                    'success': function (data) {
                        $.each(data, (key, value) => {
                            $("#city").append('<option value="' + value._id + '">' + value.name + '</option>');
                        });
                    }
                });


                $.ajax({
                    'url': '/group/' + '{{$conference->group_id}}',
                    'type': 'post',
                    'data': {'_token': '{{ csrf_token() }}', 'group': '{{$conference->group_id}}' },
                    'success': function (data) {
                        $("#progressbar").hide("fast");
                        $.each(data, (key, value) => {
                            let major_name = JSON.parse(value.name);
                            if(value.id == '{{ $conference->major_id }}' )
                                $("#major_id").append('<option value="' + value._id + '" selected>' + major_name.en + '</option>');
                            else{
                                $("#major_id").append('<option value="' + value._id + '">' + major_name.en + '</option>');
                            }
                        });
                    }
                });

            });
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
                'url': '{{ route("conference.notice.get.cities.fa") }}',
                'type': 'post',
                'data': {'_token': '{{ csrf_token() }}', country_id},
                'success': function (data) {
                    $("#city").empty();
                    $("#progressbar").hide("fast");
                    $.each(data, (key, value) => {
                        $("#city").append('<option value="' + value._id + '">' + value.name + '</option>');
                    });
                }
            });
        });
    </script>
@endsection