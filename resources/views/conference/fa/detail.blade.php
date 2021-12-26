@extends('user_fa.master')
@section('styles')
@endsection
@section('content')
    <!--- conference Slider --->
    <div class="container-fluid slider">
        <div class="row">
            <div>
                <div class="carousel slide" data-direction="rtl" id="myCarousel2">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/img/user/conference/conference22.jpg" alt="" class="img-fluid">
                            <div class="carousel-caption">
                                <h3>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است</h3>
                                <a class="btn btn-info r-more text-dark">دکمه-1</a>
                                <a class="btn btn-info r-more text-dark">دکمه-2</a>
                                <br>
                                <a href="#" class="socialmedia text-success pr-1"><i class="fa fa-instagram"></i></a>
                                <a href="#" class="socialmedia text-success pr-1"><i class="fa fa-facebook"></i></a>
                                <a href="#" class="socialmedia text-success pr-1"><i class="fa fa-twitter"></i></a>
                                <a href="#" class="socialmedia text-success pr-1"><i class="fa fa-pinterest"></i></a>
                                <a href="#" class="socialmedia text-success"><i class="fa fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid confernce-detail">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#Details" class="nav-link active" data-toggle="tab"><strong>جزییات کنفرانس</strong></a>
                    </li>
                    <li class="nav-item">
                        <a href="#History" class="nav-link" data-toggle="tab"><strong>تاریخچه کنفرانس</strong></a>
                    </li>
                    <li class="nav-item">
                        <a href="#Information" class="nav-link" data-toggle="tab"><strong>اطلاعات سفر</strong></a>
                    </li>
                </ul>
            </div>
            <div class="col-12 mt-2">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="Details">
                        <div class="container">
                            <div class="row mt-4 meeting">
                                <div class="col-12 col-lg-2">
                                    <div>
                                        <img src="/upload/conferences/notice/{{$conference->poster}}" class="conference-detail-pic">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10 pl-3">
                                    <div>
                                        <b class="text-info">{{ json_decode($conference->title)->l1 }}</b>
                                        <p class="pt-3 text-justify">{{ json_decode($conference->description)->l1 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-lg-4">
                                    <div class="mt-4 meeting">
                                        <ul>
                                            <li><h5><i class="fa fa-calendar pl-3 text-primary"></i>تاریخ های مهم</h5></li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>مهلت ارسال چکیده: 1398/01/01</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>مهلت ارسال اصل مقاله: 1398/03/02 </li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>اعلام نتایج داوری: 1398/11/03</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>تاریخ برگزاری: 1397/09/07</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mt-4 meeting">
                                        <ul>
                                            <li><h5><i class="fa fa-building pl-3 text-primary"></i>سازمان همایش</h5></li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>دبیر همایش: آقای محمدی</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>اسم ریاست: آقای رضایی</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>دبیر علمی: آقای احمدی</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>دبیر اجرایی:آقای زارعی </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="mt-4 meeting">
                                        <ul>
                                            <li><h5><i class="fa fa-address-card text-primary pl-3" style="font-size: 20px"></i>اطلاعات تماس</h5></li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>ایمیل: aasasas@gmial.com</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>شماره تماس: 0713723632</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>آدرس: شیراز</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>ساعت کاری: 8 الی 20</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="History">
                        <div class="container">
                            <div class="row mt-4 history">
                                <div class="col-12 col-lg-2">
                                    <div>
                                        <img src="/img/user/conference/poster1.jpg" class="conference-detail-pic">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10 pl-3">
                                    <div>
                                        <b class="text-info">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است </b>
                                        <p class="pt-3 text-justify">
                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد
                                        </p>
                                    </div>
                                    <div class="row mt-4">
                                        <ul>
                                            <li>برگزارکنندگان:a, b, c</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>برگزارکنندگان: ااااااا</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>مکان برگزاری: ایران، شیراز </li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>زمان برگزاری: 1396/06/04</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>کد اختصاصی: 625356</li>
                                            <a href="inline-conference2.html" class="btn btn-info mt-4 r-more text-dark">در مورد کنفرانس ها بیشتر بخوانید</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 history">
                                <div class="col-12 col-lg-2">
                                    <div>
                                        <img src="/img/user/conference/poster1.jpg" class="conference-detail-pic">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10 pl-3">
                                    <div>
                                        <b class="text-info"> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است </b>
                                        <p class="pt-3 text-justify">
                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد
                                        </p>
                                    </div>
                                    <div class="row mt-4">
                                        <ul>
                                            <li>برگزارکنندگان:a, b, c</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>برگزارکنندگان: ااااااا</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>مکان برگزاری: ایران، شیراز </li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>زمان برگزاری: 1396/06/04</li>
                                            <li><i class="fa fa-angle-left pl-2 text-primary wow slideInRight" data-wow-duration="1s"></i>کد اختصاصی: 625356</li>
                                            <a href="inline-conference2.html" class="btn btn-info mt-4 r-more text-dark">در مورد کنفرانس ها بیشتر بخوانید</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 history">
                                <div class="col-12 col-lg-2">
                                    <div>
                                        <img src="/img/user/conference/poster1.jpg" class="conference-detail-pic">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10 pl-3">
                                    <div>
                                        <b class="text-info">the Second Southern Conference on Programmable Logic (SPL) </b>
                                        <p class="pt-3 text-justify">the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                                            took a galley of type and scrambled it to the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                            the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                                            took a galley of type and scrambled it to the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                    </div>
                                    <div class="row mt-4">
                                        <ul>
                                            <li>Organizers:a, b, c</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Conference Secretary: Mr.smith</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Event Place: Canada, Toronto</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Holding time: 2019, April, 20</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Proprietary code: 625356</li>
                                            <a href="inline-conference2.html" class="btn btn-info mt-4 r-more text-dark">Read More About Conference</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4 history">
                                <div class="col-12 col-lg-2">
                                    <div>
                                        <img src="/img/user/conference/poster1.jpg" class="conference-detail-pic">
                                    </div>
                                </div>
                                <div class="col-12 col-lg-10 pl-3">
                                    <div>
                                        <b class="text-info">the First Southern Conference on Programmable Logic (SPL) </b>
                                        <p class="pt-3 text-justify">the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                                            took a galley of type and scrambled it to the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to
                                            the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                                            took a galley of type and scrambled it to the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text
                                            ever since the 1500s, when an unknown printer took a galley of type and scrambled it to </p>
                                    </div>
                                    <div class="row mt-4">
                                        <ul>
                                            <li>Organizers:a, b, c</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Conference Secretary: Mr.smith</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Event Place: Canada, Toronto</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Holding time: 2019, April, 20</li>
                                            <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Proprietary code: 625356</li>
                                            <a href="inline-conference2.html" class="btn btn-info mt-4 r-more text-dark">Read More About Conference</a>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Information">News Content</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection