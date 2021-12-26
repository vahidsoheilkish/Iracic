@extends('user.master')
@section('styles')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <ul class="addressing">
                <li><a href="#">Home</a><i class="fa fa-chevron-right"></i></li>
                <li><a>confernces details</a></li>
            </ul>
        </div>
    </div>

    <div class="container-fluid confernce-detail">
        <div class="row">
            <div class="container main-div">
                <h6>Conference Details</h6>
                <div class="row mt-4 meeting pt-3">
                    <div class="col-12 col-lg-2">
                        <div>
                            <img src="img/conference/poster1.jpg" class="conference-detail-pic">
                        </div>
                    </div>
                    <div class="col-12 col-lg-10">
                        <div>
                            <b class="">
                                {{ $conference->title }}
                            </b>
                            <p class="pt-3 text-justify">
                                {{ $conference_volume->description }}
                            <button class="btn btns-Bpurple pull-right rounded-0 mb-3"><a href="#" class="text-white">Login the conference website</a></button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="mt-4 meeting">
                            <ul>
                                <li><i class="fa fa-calendar pr-3"></i>Important Dates</li>
                                @php($start_date = strtotime( $conference_volume->start_date['date']) )
                                @php($end_date = strtotime($conference_volume->end_date['date']) )
                                @php($sendAbstractDate = strtotime($conference_volume->sendAbstractDate['date']) )
                                @php($sendArticleDate = strtotime($conference_volume->sendArticleDate['date']) )
                                @php($declareRefereeDate = strtotime($conference_volume->declareRefereeDate['date']) )
                                @php($deadTime = strtotime($conference_volume->deadTime['date']))
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Start date: {{ date('Y-m-d',$start_date) }} </li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>End date: {{ date('Y-m-d',$end_date) }}</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Send abstract date: {{ date('Y-m-d',$sendAbstractDate) }}</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Send article date: {{ date('Y-m-d',$sendArticleDate) }}</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Referee date: {{ date('Y-m-d',$declareRefereeDate) }}</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Dead date: {{ date('Y-m-d',$deadTime) }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mt-4 meeting">
                            <ul>
                                <li><i class="fa fa-building pr-3"></i>Conference Organization</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i><img src="img/author/author5.jpg" width="25" height="25" class="rounded-circle">Conference Secretary: Ali Rezai</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i><img src="img/author/author4.jpg" width="25" height="25" class="rounded-circle">Conference Head : Ali Rezai</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i><img src="img/author/author3.jpg" width="25" height="25" class="rounded-circle">Scientific secretary: Ali Rezai</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i><img src="img/author/author2.jpg" width="25" height="25" class="rounded-circle">executive Secretary: Ali Rezai </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mt-4 meeting">
                            <ul>
                                <li><i class="fa fa-phone pr-3" style="font-size: 20px"></i>Contacts</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>email: aasasas@gmial.com</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Phone Number: 0713723632</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Address: Shiraz</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>Hours of work: 8-20</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="meeting mt-4">
                            <ul>
                                <li><i class="fa fa-bell pr-3"></i>Announcing to freinds</li>
                                <li class="mt-3">
                                    <form class="friend-form">
                                        <div class="form-group">
                                            <label class="pl-2">Name :</label>
                                            <input type="text" class="ml-2" placeholder="please enter your name">
                                        </div>
                                        <div class="form-group">
                                            <label class="pl-2">email:</label>
                                            <input class="ml-3" type="email" placeholder="please enter your email">
                                        </div>
                                        <div class="form-group">
                                            <label class="pl-2">mobile:</label>
                                            <input class="ml-1" type="text" placeholder="please enter your email number">
                                            <button class="btn rounded-0 btn-sm">send</button>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mt-4 topics">
                            <ul>
                                <li><i class="fa fa-angle-right pr-3"></i>Conference Topics</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 1</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 2 </li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 3 </li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 4</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 5 </li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 6 </li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 7</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 8</li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 9 </li>
                                <li><i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>topic 10</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="mt-4 history">
                            <ul>
                                <li><i class="fa fa-history pr-3"></i>History</li>
                                @foreach( $conference->volumes as $item  )
                                    <li>
                                        @php($date = strtotime($item->start_date['date']) )
                                        <i class="fa fa-angle-right pr-2 text-primary wow slideInLeft" data-wow-duration="1s"></i>
                                        <a href="{{ route('conference.notice.single.page' , ['conference'=>$conference->_id ,'conference_volume'=>$item->_id]) }}">{{$conference->title}} [{{ date('Y',$date) }}]</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection