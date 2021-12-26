@extends('user_fa.master')
@section('styles')
    <style>
    </style>
@endsection
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-md-3">
                <form class="search-form">
                    <div class="search-field-container">
                        <input type="text" class="search-field rounded-0" placeholder="عنوان کنفرانس" />
                    </div>
                    <a href="#"><i class="fa fa-search pr-4 text-secondary"></i></a>
                </form>
                <form class="search-form">
                    <div class="search-field-container">
                        <input type="text" class="search-field rounded-0" placeholder="برگزارکننده کنفرانس" />
                    </div>
                    <a href="#"><i class="fa fa-search pr-4 pt-3 text-secondary"></i></a>
                </form>
                <form class="search-form">
                    <div class="search-field-container">
                        <input type="text" class="search-field  rounded-0" placeholder="کد اختصاصی کنفرانس" />
                    </div>
                    <a href="#"><i class="fa fa-search pr-4 pt-3 text-secondary"></i></a>
                </form>
                <hr>
                <div class="years">
                    <p>سال برگزاری کنفرانس</p>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="aCheckbox" type="checkbox" class="custom-control-input">
                        <label for="aCheckbox" class="custom-control-label">2019</label><span class="pull-left">200</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="fCheckbox" type="checkbox" class="custom-control-input">
                        <label for="fCheckbox" class="custom-control-label">2018</label><span class="pull-left">200</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="gCheckbox" type="checkbox" class="custom-control-input">
                        <label for="gCheckbox" class="custom-control-label">2017</label><span class="pull-left">200</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="hCheckbox" type="checkbox" class="custom-control-input">
                        <label for="hCheckbox" class="custom-control-label">2016</label><span class="pull-left">200</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="iCheckbox" type="checkbox" class="custom-control-input">
                        <label for="iCheckbox" class="custom-control-label">2015</label><span class="pull-left">200</span>
                    </div>
                    <a class="badge badge-secondary text-white" data-toggle="modal" data-target="#myModal"> بیشتر</a>
                    <div class="modal" id="myModal">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header btns-Bpurple">
                                    <h4 class="modal-title">سال انتشار</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox72" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox72">1391</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox73" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox73">1390</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox74" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox74">1389</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox75" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox75">1388</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox76" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox76">1387</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox77" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox77">1386</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox78" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox78">1385</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox79" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox79">1384</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox80" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox80">1383</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox81" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox81">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox82" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox82">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox83" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox83">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox84" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox84">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox85" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox85">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox86" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox86">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox87" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox87">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox88" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox88">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox89" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox89">1382</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox90" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox90">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox91" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox91">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox92" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox92">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox93" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox93">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox94" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox94">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox95" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox95">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox96" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox96">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox97" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox97">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox98" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox98">1382</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="year-analyse">
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox99" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox99">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox100" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox100">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox101" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox101">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox102" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox102">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox103" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox103">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox104" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox104">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox105" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox105">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox106" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox106">1382</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" id="customcheckbox107" name="customcheckbox" class="custom-control-input">
                                                        <label class="custom-control-label" for="customcheckbox107">1382</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="countries">
                    <P class="mt-3">کشورها</P>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="wCheckbox" type="checkbox" class="custom-control-input">
                        <label for="wCheckbox" class="custom-control-label">انگلستان </label><span class="pull-left">2050</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="ZCheckbox" type="checkbox" class="custom-control-input">
                        <label for="ZCheckbox" class="custom-control-label">آمریکا </label><span class="pull-left">2040</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="YCheckbox" type="checkbox" class="custom-control-input">
                        <label for="YCheckbox" class="custom-control-label">آلمان </label><span class="pull-left">1200</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="QCheckbox" type="checkbox" class="custom-control-input">
                        <label for="QCheckbox" class="custom-control-label">کانادا </label><span class="pull-left">280</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="QCheckbox" type="checkbox" class="custom-control-input">
                        <label for="QCheckbox" class="custom-control-label">فرانسه </label><span class="pull-left">280</span>
                    </div>
                    <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                    <div class="form-group mt-3 searchdiv">
                        <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                    </div>
                    <hr>
                    <P class="mt-3">شهرها</P>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="ACheckbox" type="checkbox" class="custom-control-input">
                        <label for="ACheckbox" class="custom-control-label">تهران</label><span class="pull-left">700</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="BCheckbox" type="checkbox" class="custom-control-input">
                        <label for="BCheckbox" class="custom-control-label">کرمان </label><span class="pull-left">200</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="TCheckbox" type="checkbox" class="custom-control-input">
                        <label for="TCheckbox" class="custom-control-label">شیراز</label><span class="pull-left">800</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="SCheckbox" type="checkbox" class="custom-control-input">
                        <label for="SCheckbox" class="custom-control-label">اصفهان</label><span class="pull-left">270</span>
                    </div>
                    <div class="custom-control custom-checkbox ml-4">
                        <input id="SCheckbox" type="checkbox" class="custom-control-input">
                        <label for="SCheckbox" class="custom-control-label">مشهد</label><span class="pull-left">270</span>
                    </div>
                    <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                    <div class="form-group mt-3 searchdiv">
                        <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                    </div>
                    <hr>
                    <p>گروه </p>
                    <div class="input-group mt-4">
                        <select class="category form-control" id="group_id">
                            @foreach($groups_list as $group)
                                @php($group_name = json_decode($group->name) )
                                <option value="{{$group->id}}">{{ $group_name->fa }}</option>
                            @endforeach
                        </select>
                    </div>
                    <hr>
                    <p>رشته </p>
                    <div class="input-group mt-4">
                        <select class="custom-select" id="major_id">
                        </select>
                    </div>
                    <hr>
                    <p>موضوعات پژوهشی</p>
                    <div class="Hashtags">
                        <p>#موضوعات پژوهشی 1<span class="pull-left">200</span></p>
                        <p>#موضوعات پژوهشی 1<span class="pull-left">200</span></p>
                        <p>#موضوعات پژوهشی 1<span class="pull-left">200</span></p>
                        <p>#موضوعات پژوهشی 1<span class="pull-left">200</span></p>
                        <p>#موضوعات پژوهشی 1<span class="pull-left">200</span></p>
                    </div>
                    <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                    <div class="form-group mt-3 searchdiv">
                        <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6" id="conferences_container">
                <div class="row conference-notice shadow">
                    <div class="col-12 col-lg-2 notice-poster">
                        <img src="img/conference/poster2.jpg">
                    </div>
                    <div class="col-12 col-lg-10 pr-4">
                        <p class="conference-notice-text"><a href="#">سیزدهمین کنفرانس بین المللی مدیریت استراتژیک</a></p>
                        <p class="conference-notice-text"><i class="fa fa-circle"></i>دانشگاه صنعتی شریف</p>
                        <p class="conference-notice-text"><i class="fa fa-circle"></i>8 مرداد 1397</p>
                        <p class="conference-notice-text"><i class="fa fa-circle"></i>ایران، تهران</p>
                        <P class="conference-notice-text"><i class="fa fa-circle"></i>کد اختصاصی: 8376372</P>
                    </div>
                    <div>
                        <p class="description">
                            از تمامی پژوهشگران و دانشجویان علاقه مند دعوت می گردد جهت ارسال مقالات حداکثر تا ۲۰ دی با توجه به محورهای اصلی همایش اقدام نمایند.

                        </p>
                        <P class="subject">
                            <a href="#" class="badge mr-1 pt-1">صنعت</a>
                            <a href="#" class="badge mr-1 pt-1">علوم و تحقیقات</a>
                            <a href="#" class="badge mr-1 pt-1">فناوری و اطلاعات</a>
                            <a href="#" class="btn rounded-0 pull-left">بیشتر بخوانید</a>
                        </P>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <h6 class="title">اینجا برای تبلیغات شماست</h6>
                <div class="text-center">
                    <div class="mt-1">
                        <img src="img/ad/images.jpg" height="70" width="230">
                    </div>
                    <div class="mt-3">
                        <img src="img/ad/21_ADD.jpg"  height="70" width="230">
                    </div>
                    <div class="mt-3">
                        <img src="img/ad/884b7c4e-9ff4-4932-99aa-00503f64bb48.jpg"  height="70" width="230">
                    </div>
                </div>
                <h6 class="title mt-3">پربازدیدترین کنفرانس ها</h6>
                <div class="favorite shadow p-2">
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                    <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                    <br>
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                    <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                    <br>
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                    <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                    <br>
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                    <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                    <br>
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                    <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                    <br>
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                    <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                    <br>
                    <a href="#" class="Congress-title">دومین کنفرانس بازیابی تعاملی اطلاعات</a>
                    <br>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            let group = $("#group_id").val();
            $.ajax({
                'url' : '/group/' + group ,
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'group' : group},
                'success' : function(data){
                    $("#select_major").show("fast");
                    $("#progressbar").hide("fast");
                    $.each(data,(key,value)=>{
                        let major_name = JSON.parse(value.name);
                        $("#major_id").append('<option value="'+value._id+'">'+major_name.en+'</option>');
                    });
                    let major= $("#major_select option:first").val();
                    $("#group_id").val(group);
                    $("#major_id").val(major);
                }
            });


            let years = document.getElementsByName("years_chk[]");
            for(k=0;k< years.length;k++)
            {
                if(years[k].checked ){
                    years[k].checked=false;
                }
            }
        });
        $("#group_id").change(function(){
            $("#progressbar").show("fast");
            $("#major_id").empty();
            let group = this.value;
            $.ajax({
                'url' : '/group/' + group ,
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'group' : group},
                'success' : function(data){
                    $("#select_major").show("fast");
                    $("#progressbar").hide("fast");
                    $.each(data,(key,value)=>{
                        let major_name = JSON.parse(value.name);
                        $("#major_id").append('<option value="'+value._id+'">'+major_name.en+'</option>');
                    });
                    let major= $("#major_select option:first").val();
                    $("#group_id").val(group);
                    $("#major_id").val(major);
                }
            });
        });

        $("#major_id").change(function(){
            $("#progressbar").show("fast");
            $("#major_helper").hide("fast");
            let group_id = $("#group_id");
            let major_id = $("#major_id");
            let group = group_id.val();
            let major = major_id.val();
            $.ajax({
                'url' : '/conferences/get/group/' + group +'/major/' + major ,
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'group' : group , 'major' : major},
                'success' : function(data){
                    $("html, body").animate({ scrollTop: 0 }, 600);
                    $("#select_major").hide("fast");
                    $("#progressbar").hide("fast");
                    if(data.length > 0){
                        $("#conferences_container").empty();
                        for(i=0; i<data.length; i++){
                            $("#conferences_container").append('<div class="row conference-notice shadow">\n' +
                                '                    <div class="col-12 col-lg-2 notice-poster">\n' +
                                '                        <img src="img/conference/poster2.jpg">\n' +
                                '                    </div>\n' +
                                '                    <div class="col-12 col-lg-10 pr-4">\n' +
                                '                        <p class="conference-notice-text"><a href="'+ data[i]._id +'">'+data[i].title+'</a></p>\n' +
                                '                        <p class="conference-notice-text"><i class="fa fa-circle"></i>دانشگاه صنعتی شریف</p>\n' +
                                '                        <p class="conference-notice-text"><i class="fa fa-circle"></i>'+data[i].startDate+'</p>\n' +
                                '                        <p class="conference-notice-text"><i class="fa fa-circle"></i>'+data[i].country+'</p>\n' +
                                '                        <P class="conference-notice-text"><i class="fa fa-circle"></i>کد اختصاصی: '+data[i]._id+'</P>\n' +
                                '                    </div>\n' +
                                '                    <div>\n' +
                                '                        <p class="description">\n' +

                                '                        </p>\n' +
                                '                        <P class="subject">\n' +
                                '                            <a href="#" class="badge mr-1 pt-1">صنعت</a>\n' +
                                '                            <a href="#" class="badge mr-1 pt-1">علوم و تحقیقات</a>\n' +
                                '                            <a href="#" class="badge mr-1 pt-1">فناوری و اطلاعات</a>\n' +
                                '                            <a href="#" class="btn rounded-0 pull-left">بیشتر بخوانید</a>\n' +
                                '                        </P>\n' +
                                '                    </div>\n' +
                                '                </div>');
                            for(j=0; j<conference_sub.length ;j++){
                                $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                            }
                        }
                    }else{
                        swal("", "Nothing found", "error");
                    }
                }
            });
        });

        function search_conference(search_type){
            switch(search_type){
                case 'title':
                    let title = $("#title_search_input").val();
                    if(title === ""){
                        swal("", "Please enter title", "error");
                    }else{
                        $("#progressbar").show("fast");
                        $.ajax({
                            'url' : '{{ route("conference.notice.search.fa") }}',
                            'type' : 'post',
                            'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'title' , 'phrase' : title } ,
                            'success' : function(data){
                                if(data.length > 0){
                                    $("#conferences_container").empty();
                                    for(i=0; i<data.length; i++){
                                        $("#conferences_container").append('<div class="row conference-notice">\n' +
                                            '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                            '                            <img src="/img/user/conference/poster1.jpg">\n' +
                                            '                        </div>\n' +
                                            '                        <div class="col-12 col-lg-10 pl-4 pt-2">\n' +
                                            '                            <p class="conference-notice-text">'+data[i].title+'</p>\n' +
                                            '                            <p class="conference-notice-text text-danger">-'+data[i].organizer+'</p>\n' +
                                            '                            <p class="conference-notice-text">-'+data[i].startDate+'</p>\n' +
                                            '                            <p class="conference-notice-text">-'+data[i].country+', '+data[i].city+'</p>\n' +
                                            '                            <P class="conference-notice-text">-Orgnizer: '+data[i].ISSN+'</P>\n' +
                                            '                            <p class="description">\n' +
                                            '                                -'+data[i].description+'\n' +
                                            '                            <div class="conference-notice-text sub_tags">' +
                                            '                            </div><br/>'+
                                            '                            </p>\n' +
                                            '                            <a href="/conference/single/'+data[i].id+'" class="btn btn-info text-dark r-more">Read More</a>\n' +
                                            '                        </div>\n' +
                                            '                    </div>');
                                        let conference_sub = data[i].conference_subjects.split(',');
                                        for(j=0; j<conference_sub.length ;j++){
                                            $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                                        }
                                    }
                                }else{
                                    swal("", "Nothing found", "error");
                                }
                            }
                        })
                    }
                break;
                case 'organizer':
                    let organizer = $("#organizer_search_input").val();
                    if(organizer === ""){
                        swal("", "Please enter organizer", "error");
                    }else{
                        $.ajax({
                            'url' : '{{ route("conference.notice.search.fa") }}',
                            'type' : 'post',
                            'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'organizer' , 'phrase' : organizer } ,
                            'success' : function(data){
                                if(data.length > 0){
                                    $("#conferences_container").empty();
                                    for(i=0; i<data.length; i++){
                                        $("#conferences_container").append('<div class="row conference-notice">\n' +
                                            '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                            '                            <img src="/img/user/conference/poster1.jpg">\n' +
                                            '                        </div>\n' +
                                            '                        <div class="col-12 col-lg-10 pl-4 pt-2">\n' +
                                            '                            <p class="conference-notice-text">'+data[i].title+'</p>\n' +
                                            '                            <p class="conference-notice-text text-danger">-'+data[i].organizer+'</p>\n' +
                                            '                            <p class="conference-notice-text">-'+data[i].startDate+'</p>\n' +
                                            '                            <p class="conference-notice-text">-'+data[i].country+', '+data[i].city+'</p>\n' +
                                            '                            <P class="conference-notice-text">-Orgnizer: '+data[i].ISSN+'</P>\n' +
                                            '                            <p class="description">\n' +
                                            '                                -'+data[i].description+'\n' +
                                            '                            <div class="conference-notice-text sub_tags">' +
                                            '                            </div><br/>'+
                                            '                            </p>\n' +
                                            '                            <a href="/conference/single/'+data[i].id+'" class="btn btn-info text-dark r-more">Read More</a>\n' +
                                            '                        </div>\n' +
                                            '                    </div>');
                                        let conference_sub = data[i].conference_subjects.split(',');
                                        for(j=0; j<conference_sub.length ;j++){
                                            $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                                        }
                                    }
                                }else{
                                    swal("", "Nothing found", "error");
                                }
                            }
                        })
                    }
                break;
                case 'code':
                    let code = $("#code_search_input").val();
                    if(code === ""){
                        swal("", "Please enter code", "error");
                    }else{
                        $.ajax({
                            'url' : '{{ route("conference.notice.search.fa") }}',
                            'type' : 'post',
                            'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'code' , 'phrase' : code } ,
                            'success' : function(data){
                                if(data.length > 0){
                                    $("#conferences_container").empty();
                                    for(i=0; i<data.length; i++){
                                        $("#conferences_container").append('<div class="row conference-notice">\n' +
                                            '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                            '                            <img src="/img/user/conference/poster1.jpg">\n' +
                                            '                        </div>\n' +
                                            '                        <div class="col-12 col-lg-10 pl-4 pt-2">\n' +
                                            '                            <p class="conference-notice-text">'+data[i].title+'</p>\n' +
                                            '                            <p class="conference-notice-text text-danger">-'+data[i].organizer+'</p>\n' +
                                            '                            <p class="conference-notice-text">-'+data[i].startDate+'</p>\n' +
                                            '                            <p class="conference-notice-text">-'+data[i].country+', '+data[i].city+'</p>\n' +
                                            '                            <P class="conference-notice-text">-Orgnizer: '+data[i].ISSN+'</P>\n' +
                                            '                            <p class="description">\n' +
                                            '                                -'+data[i].description+'\n' +
                                            '                            <div class="conference-notice-text sub_tags">' +
                                            '                            </div><br/>'+
                                            '                            </p>\n' +
                                            '                            <a href="/conference/single/'+data[i].id+'" class="btn btn-info text-dark r-more">Read More</a>\n' +
                                            '                        </div>\n' +
                                            '                    </div>');
                                        let conference_sub = data[i].conference_subjects.split(',');
                                        for(j=0; j<conference_sub.length ;j++){
                                            $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                                        }
                                    }
                                }else{
                                    swal("", "Nothing found", "error");
                                }
                            }
                        })
                    }
                break;
            }
            $("#progressbar").hide("fast");
        }

        $(".year_search").change(function(){
            $("#progressbar").show("fast");
            let years = document.getElementsByName("years_chk[]");
            let selected_years = [];
            for(k=0;k< years.length;k++)
            {
                if(years[k].checked ){
                    selected_years.push( years[k].value )
                }
            }
            $.ajax({
                'url' : '{{ route("conference.notice.search.fa") }}',
                'type' : 'post',
                'data' : {'_token' : '{{ csrf_token() }}', 'type' : 'year' , 'phrase' : selected_years } ,
                'success': function(data){
                    console.log(data);
                    if(data.length > 0){
                        $("#conferences_container").empty();
                        for(i=0; i<data.length; i++){
                            $("#conferences_container").append('<div class="row conference-notice">\n' +
                                '                        <div class="col-12 col-lg-2 notice-poster">\n' +
                                '                            <img src="/img/user/conference/poster1.jpg">\n' +
                                '                        </div>\n' +
                                '                        <div class="col-12 col-lg-10 pl-4 pt-2">\n' +
                                '                            <p class="conference-notice-text">'+data[i].conference_notice.title+'</p>\n' +
                                '                            <p class="conference-notice-text text-danger">-'+data[i].conference_notice.organizer+'</p>\n' +
                                '                            <p class="conference-notice-text">-'+data[i].conference_notice.startDate+'</p>\n' +
                                '                            <p class="conference-notice-text">-'+data[i].conference_notice.country+', '+data[i].city+'</p>\n' +
                                '                            <P class="conference-notice-text">-Orgnizer: '+data[i].ISSN+'</P>\n' +
                                '                            <p class="description">\n' +
                                '                                -'+data[i].conference_notice.description+'\n' +
                                '                            <div class="conference-notice-text sub_tags">' +
                                '                            </div><br/>'+
                                '                            </p>\n' +
                                '                            <a href="/conference/single/'+data[i].conference_notice.id+'" class="btn btn-info text-dark r-more">Read More</a>\n' +
                                '                        </div>\n' +
                                '                    </div>');
                            let conference_sub = data[i].conference_notice.conference_subjects.split(',');
                            for(j=0; j<conference_sub.length ;j++){
                                $(".sub_tags:last").append('<a href="#" class="badge badge-secondary mr-1 pt-1">'+ conference_sub[j] +'</a>')
                            }
                        }
                    }else{
                        swal("", "Nothing found", "error");
                    }
                    $("#progressbar").hide("fast");
                }
            });
        });
    </script>
@endsection