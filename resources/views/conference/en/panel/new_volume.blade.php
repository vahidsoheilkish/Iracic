@extends('conference.en.panel.master')
@section('styles')
    <style>
        #conference_form{text-align: right;direction:ltr; padding-bottom:40px;}
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
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('conference.notice.volume.store') }}" method="post" enctype="multipart/form-data" id="conference_form">
                    @csrf
                    <div class="col-sm-12" style="">
                        <div class="form-group">
                            <label for="city">شهر</label>
                            <select name="city" id="city" class="form-control">
                                @foreach($cities as $city)
                                    <option value="{{ $city->_id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="alert alert-light" for="place">محل برگزاری</label>
                            <input type="text" id="place" name="place" class="form-control" value="" />
                        </div>
                    </div>

                    <div class="row form-group holding_organizer">
                        <div class="col-sm-12">
                            <label class="alert alert-light" for="poster">پوستر کنفرانس</label>
                            <input type="file" id="poster" name="poster" class="form-control btn btn-light" style="padding:0;"/>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="alert alert-light" for="address">آدرس پستی</label>
                            <textarea name="address" id="address" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="alert alert-light" for="tell">شماره تماس</label>
                                    <input type="text" name="tell" id="tell" class="form-control" value=""/>
                                </div>

                                <div class="col-sm-6">
                                    <label class="alert alert-light" for="email">ایمیل</label>
                                    <input type="text" name="email" id="email" class="form-control" value=""/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="alert alert-light" for="website">آدرس سایت</label>
                                    <input type="text" name="website" id="website" class="form-control" value=""/>
                                </div>

                                <div class="col-sm-6">
                                    <label class="alert alert-light" for="fax">فکس</label>
                                    <input type="text" name="fax" id="fax" class="form-control" value=""/>
                                </div>
                            </div>
                        </div><hr/>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="alert alert-light" for="start_date">تاریخ شروع</label>
                                    <input type="text" name="start_date" id="start_date" class="form-control" value="" readonly/>
                                </div>
                                <div class="col-sm-6">
                                    <label class="alert alert-light" for="end_date">تاریخ پایان</label>
                                    <input type="text" name="end_date" id="end_date" class="form-control" value="" readonly/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="alert alert-light" for="description">توضیحات یا معرفی</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3 tac">
                                    <label for="sendAbstractDate">تاریخ ارسال چکیده</label>
                                    <input type="text" name="sendAbstractDate" id="sendAbstractDate" class="form-control" value="" readonly/>
                                </div>
                                <div class="col-sm-3 tac">
                                    <label for="sendArticleDate">تاریخ ارسال اصل مقاله</label>
                                    <input type="text" name="sendArticleDate" id="sendArticleDate" class="form-control" value="" readonly/>
                                </div>
                                <div class="col-sm-3 tac">
                                    <label for="declareRefereeDate">تاریخ نتایج داوری</label>
                                    <input type="text" name="declareRefereeDate" id="declareRefereeDate" class="form-control" value="" readonly/>
                                </div>
                                <div class="col-sm-3 tac">
                                    <label for="deadTime">مهلت ثبت نام</label>
                                    <input type="text" name="deadTime" id="deadTime" class="form-control" value="" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group holding_organizer">
                            <div class="col-sm-5">
                                <label for="chief">ریاست شورای سیاست گذاری</label>
                                <input type="text" name="chief" id="chief" class="form-control" value=""/>
                            </div>
                            <div class="col-sm-7 tac">
                                <label for="chief_pic" class="tac">تصویر ریاست شورای سیاست گذاری</label>
                                <input type="file" id="chief_pic" name="chief_pic" class="form-control-file input_file tac"/>
                            </div>
                        </div><hr/>

                        <div class="row form-group holding_organizer">
                            <div class="col-sm-6">
                                <label for="conferenceSecretary">دبیر کنفرانس</label>
                                <input type="text" name="conferenceSecretary" id="conferenceSecretary" class="form-control" value=""/>
                            </div>
                            <div class="col-sm-6 tac">
                                <label for="conferenceSecretary_pic" class="tac">تصویر دبیر کنفرانس</label>
                                <input type="file" id="conferenceSecretary_pic" name="conferenceSecretary_pic" class="form-control-file input_file tac"/>
                            </div>
                        </div><hr/>

                        <div class="row form-group holding_organizer">
                            <div class="col-sm-6">
                                <label for="conferencePresidency">ریاست کنفرانس</label>
                                <input type="text" name="conferencePresidency" id="conferencePresidency" class="form-control" value=""/>
                            </div>
                            <div class="col-sm-6 tac">
                                <label for="conferencePresidency_pic" class="tac">تصویر ریاست کنفرانس</label>
                                <input type="file" id="conferencePresidency_pic" name="conferencePresidency_pic" class="form-control-file input_file tac"/>
                            </div>
                        </div><hr/>

                        <div class="row form-group holding_organizer">
                            <div class="col-sm-6">
                                <label for="scientificSecretary">دبیر علمی</label>
                                <input type="text" name="scientificSecretary" id="scientificSecretary" class="form-control" value=""/>
                            </div>
                            <div class="col-sm-6 tac">
                                <label for="scientificSecretary_pic" class="tac">تصویر دبیر علمی</label>
                                <input type="file" id="scientificSecretary_pic" name="scientificSecretary_pic" class="form-control-file input_file tac"/>
                            </div>
                        </div><hr/>

                        <div class="row form-group holding_organizer">
                            <div class="col-sm-6">
                                <label for="executiveSecretary">دبیر اجرایی</label>
                                <input type="text" name="executiveSecretary" id="executiveSecretary" class="form-control" value=""/>
                            </div>
                            <div class="col-sm-6 tac">
                                <label for="executiveSecretary_pic" class="tac">تصویر دبیر اجرایی</label>
                                <input type="file" id="executiveSecretary_pic" name="executiveSecretary_pic" class="form-control-file input_file tac"/>
                            </div>
                        </div><hr/>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 tac">
                            <button type="submit" class="btn btn-success" style="width: 65%;">ثبت دوره کنفرانس</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_volume_register')").removeClass('active');
            {{--let country_id = $("#country").val();--}}
            {{--$("#city").empty();--}}
            {{--$.ajax({--}}
                {{--'url': '{{ route("conference.notice.get.cities") }}',--}}
                {{--'type': 'post',--}}
                {{--'data': {'_token': '{{ csrf_token() }}', country_id},--}}
                {{--'success': function (data) {--}}
                    {{--$.each(data, (key, value) => {--}}
                        {{--$("#city").append('<option value="' + value.id + '">' + value.name + '</option>');--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}
        });

        $("#start_date ,#end_date").persianDatepicker({
            calendarType: 'gregorian',
            initialValue: false,
            autoClose: true,
            format: 'YYYY-MM-DD',
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
        $("#sendArticleDate,#sendAbstractDate,#declareRefereeDate,#deadTime").persianDatepicker({
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

        $("#held_btn").click(function(){
            let held_yes = $("#held_yes");
            let held_no = $("#held_no");
            if(held_yes.prop('checked') === true){
                $("#held_container").hide("slow");
                $("#conf_form").show("fast");
                $("#type").val(1);
            }else if(held_no.prop('checked') === true){
                $("#held_container").hide("slow");
                $("#ran_container").show("fast");
            }
        });


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