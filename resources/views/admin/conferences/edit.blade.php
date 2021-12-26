@extends('admin.master')
@section('styles')
    <style>
        .title_label{line-height:30px; font-size:14px; text-align: justify; padding:2px;}
        .holding_organizer{font-size:13px;}
        .input_file{border:1px solid grey; padding:4px; border-radius:4px; }
        .poster{width:120px; border-radius:10px;}
        .no_img{width:60px;}
    </style>
@endsection

@section('content')
    @php($conference_subjects = json_decode($conference->conference_subjects) )
    @php($description = json_decode($conference->description) )
    @php($title = json_decode($conference->title) )
    @php( $organizer = explode('-' , $conference->organizer) )
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h4 class="tac">ویرایش کنفرانس
                            <span class="title_label">{{$title->l1}}</span><br/>
                            <span class="title_label">{{$title->l2}}</span>
                        </h4>
                        <div class="col-sm-12">
                            <form action="{{ route('admin.conference.update' , ['conference'=>$conference]) }}" method="post" enctype="multipart/form-data" class="row form-horizontal rtl" novalidate>
                                {{ method_field('PATCH') }}
                                <div class="col-sm-6" style="border-left:2px solid #222222; padding:0 40px;">
                                    @include('message.errors')
                                    @csrf
                                    <div class="form-group rtl">
                                        <div class="row" style="padding:6px;">
                                            <div class="col-sm-3">
                                                <label class="alert2 alert-success" style="bottom:15px;">زبان</label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="en">انگلیسی</label>
                                                <input type="radio" id="en" name="lang" value="en" {{$conference->lang=="en" ? "checked" : ''}} style="margin:0 6px; vertical-align: middle;" />
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="fa">فارسی</label>
                                                <input type="radio" id="fa" name="lang" value="fa" {{$conference->lang=="fa" ? "checked" : ''}} style="margin:0 6px; vertical-align: middle;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="alert2 alert-success" for="group_id">گروه</label>
                                        <select name="group_id" id="group_id" class="form-control">
                                            @foreach($groups_list as $group)
                                                @php($group_name = json_decode($group->name) )
                                                @if($group->id == $conference->group_id)
                                                    <option value="{{$group->id}}" selected="selected">{{ $group_name->fa }}</option>
                                                @else
                                                    <option value="{{$group->id}}">{{ $group_name->fa }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="alert2 alert-success" for="major_id">رشته</label>
                                        <select name="major_id" id="major_id" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="alert2 alert-primary" for="title_1">عنوان زبان اصلی</label>
                                        <input type="text" name="title_1" id="title_1" class="form-control" value="{{ $title->l1 }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="alert2 alert-info" for="title_2">عنوان زبان دوم</label>
                                        <input type="text" name="title_2" id="title_2" class="form-control" value="{{ $title->l2 }}"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="alert2 alert-info" for="level">سطح برگزاری</label>
                                        <select name="level" id="level" class="form-control">
                                            <option {{ $conference->level == "international" ? "selected" : "" }} value="international">بین المللی</option>
                                            <option {{ $conference->level == "regional" ? "selected" : "" }} value="regional">منطقه ای</option>
                                            <option {{ $conference->level == "national" ? "selected" : "" }} value="national">ملی</option>
                                            <option {{ $conference->level == "provincial" ? "selected" : "" }} value="provincial">استانی</option>
                                            <option {{ $conference->level == "inner" ? "selected" : "" }} value="inner">داخلی</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="conference_publisher" style="margin:6px;">منتشرکننده کنفرانس</label>
                                        <input type="text" name="conference_publisher" id="conference_publisher" class="form-control" placeholder="منتشر کننده کنفرانس" required value="{{ $conference->conference_publisher }}"/>
                                    </div>
                                    <div class="form-group">
                                        <select name="conference_type" class="form-control">
                                            <option value="fulltext" {{ $conference->conference_type == 'fulltext' ? 'selected' : '' }}>کامل</option>
                                            <option value="abstract" {{ $conference->conference_type == 'abstract' ? 'selected' : '' }}>چکیده</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="access" class="form-control">
                                            <option value="money" {{ $conference->access == 'money' ? 'selected' : '' }}>نقدی</option>
                                            <option value="open" {{ $conference->access == 'open' ? 'selected' : '' }}>رایگان</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="alert alert-warning">امکان ارسال مقاله</label>
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <label for="send_article_yes">دارد</label>
                                                <input type="radio" name="send_article" value="1" {{ $conference->sent_article == 1 ? 'checked' : '' }} id="send_article_yes" style="vertical-align: middle"/>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="send_article_no">ندارد</label>
                                                <input type="radio" name="send_article" value="0" {{ $conference->sent_article == 0 ? 'checked' : '' }} id="send_article_no" style="vertical-align: middle"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="alert bg-primary">وضعیت مقاله
                                                    @if($conference->active == 0 )
                                                        <span class="alert alert-danger">غیرفعال</span>
                                                    @elseif($conference->active == 1)
                                                        <span class="alert alert-success">فعال</span>
                                                    @else
                                                        <span class="alert alert-warning">فعال (عدم ارسال مقاله)</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="active" style="margin:6px;">فعال</label>
                                                <input type="radio" name="active" id="active" class="vertical_middle" value="1" {{ $conference->active == 1 ? 'checked' : '' }}/>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="no_active" style="margin:6px;">غیرفعال</label>
                                                <input type="radio" name="active" id="no_active" class="vertical_middle" value="0" {{ $conference->active == 0 ? 'checked' : '' }}/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="alert2 alert-warning" for="ISBN">ISBN (شابک)</label>
                                        <input type="text" id="ISBN" name="ISBN" class="form-control" value="{{ $conference->ISBN }}"/>
                                    </div>

                                    <div class="form-group">
                                        <label class="alert2 alert-warning" for="printISSN">printISSN</label>
                                        <input type="text" id="printISSN" name="printISSN" class="form-control" value="{{ $conference->printISSN }}" />
                                    </div>

                                    <div class="form-group">
                                        <label class="alert2 alert-warning" for="onlineISSN">onlineISSN</label>
                                        <input type="text" id="onlineISSN" name="onlineISSN" class="form-control" value="{{ $conference->onlineISSN }}" />
                                    </div>

                                    <div class="form-group">
                                        <label class="alert alert-info">برگزارکنندگان</label>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="alert2 alert-success" for="university">دانشگاه</label>
                                                <input type="text" name="university" id="university" class="form-control" value="{{ $organizer[0] }}"/>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="alert2 alert-success" for="college">دانشکده</label>
                                                <input type="text" name="college" id="college" class="form-control" value="{{ $organizer[1] }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="alert2 alert-success" for="country">کشور</label>
                                                <select id="country" name="country" class="form-control">
                                                    @foreach($countries as $country)
                                                        @if($country->id != $conference->country)
                                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                        @else
                                                            <option value="{{ $country->id }}" selected="selected">{{ $country->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="doi">DOI</label>
                                        <input type="text" id="doi" name="doi" value="{{ $conference->DOI }}" class="form-control"/>
                                    </div>



                                    <div class="row form-group">
                                        <div class="col-sm-12">
                                            <label for="owner_logo" class="alert alert-primary">پوستر صاحب امتیاز</label>
                                            <input type="file" id="owner_logoowner_logo" name="owner_logo" class="form-control-file input_file"/>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-12 tac">
                                            @if($conference->owner_logo !=null)
                                                    <span class="alert alert-warning">تصویر قبلی</span>
                                                    <img src="{{conference_assets_path}}/{{$conference->dir}}/{{$conference->owner_logo}}" style="width:230px;"/>
                                            @else
                                                <img src="/img/user/no_img.png" style="width:60px;"/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 tac">
                                            <button type="submit" class="btn btn-success">ویرایش کنفرانس</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>
<input type="hidden" id="major" value="{{$conference->major_id}}"/>
<input type="hidden" id="city_old" value="{{$conference->city}}"/>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            let group_id = $("#group_id").val();
            let major_id = $("#major_id");
            let major = $("#major").val();
            $.ajax({
                'url' : '{{route('admin.conference.majors.group')}}' ,
                'type' : 'POST' ,
                'data' : { '_token':"{{csrf_token()}}", 'group':group_id} ,
                'dataType': 'json',
                'success' : function(data){
                    major_id.empty();
                    $.each(data, (key, value) => {
                        let major_name = JSON.parse(value.name);
                        if(value.id == major) {
                            major_id.append('<option value="' + value._id + '" selected>' + major_name.en + '</option>');
                        }else{
                            major_id.append('<option value="' + value._id + '">' + major_name.en + '</option>');
                        }
                    });
                }
            });

            let city_old = $("#city_old").val();
            let country = $("#country").val();
            $.ajax({
                'url': '{{ route("conference.notice.get.cities") }}',
                'type': 'post',
                'data': {'_token': '{{ csrf_token() }}', 'country_id': country},
                'success': function (data) {
                    $("#city").empty();
                    $("#progressbar").hide("fast");
                    $.each(data, (key, value) => {
                        if(value.id == city_old) {
                            $("#city").append('<option value="' + value._id + '" selected="selected">' + value.name + '</option>');
                        }else{
                            $("#city").append('<option value="' + value._id + '">' + value.name + '</option>');
                        }
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
                        $("#city").append('<option value="' + value.name + '">' + value.name + '</option>');
                    });
                }
            });
        });


        $('#subject_1').tagEditor();
        $('#subject_2').tagEditor();
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
    </script>
@endsection