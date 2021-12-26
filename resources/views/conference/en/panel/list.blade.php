@extends('conference.en.panel.master')

@section('styles')
    <style>
        .confgreen-expalin {background-color: #009A59;}
        .confgreen-expalin p {color: #fff;font-size: 15px;padding-right: 20px;padding-left: 32px; padding-top:10px;}
        .btn-one {background-color: #fff;color: #0e0e0e;border: 1px solid grey;text-align: center;font-size: 1rem;}
        .btn-two {background-color: #e6e6e6;color: #0e0e0e;border: 1px solid grey;text-align: center;font-size: 0.8rem;line-height: 23px;}
        .btn-three {background-color: #fff;color: #0e0e0e;border: 1px solid grey;text-align: center;font-size: 1rem;}
        .confred-expalin {background-color: #e9322d;}
        .confred-expalin p {color: #fff;font-size: 15px;padding-right: 20px;padding-left: 32px;padding-top:10px;}
        .btn-one-red, .btn-three-red {border: 1px solid grey;text-align: center;font-size: 0.9rem;}
        .btn-two-red {font-size: 0.8rem;border: 1px solid grey;text-align: center;}
        .confgreen-expalin img {border: 5px solid #fff;margin: 40px 0 10px 0;width: 110px;}
        .confred-expalin img {border: 5px solid #fff;margin: 40px 0 10px 0;width: 110px;}
    </style>
@endsection

@section('content')
    <div class="row confirm-title mt-3">
        <p class="font-weight-bold">Confirmed conferences</p>
    </div>
    <div class="row">
        @foreach($conferences_active as $conference)
            <div class="col-12 col-lg-6">
                <div class="container">
                    <div class="row confgreen-expalin">
                        <div class="col-12 col-lg-2">
                            <img src="{{conference_assets_path}}/{{$conference->poster}}">
                        </div>
                        <div class="col-12 col-lg-10">
                            <p class="conference-notice-text">-{{ json_decode($conference->title)->l1 }} </p>
                            <p class="conference-notice-text">-{{ $conference->organizer }}</p>
                            <p class="conference-notice-text">{{ date('Y-m-d' , $conference->startDate) }}</p>
                            <p class="conference-notice-text">{{ $conference->code }}</p>
                            <p>{{ $conference->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4 btn-one pt-2">
                            <i class="fa fa-check text-success"></i> Accepted
                        </div>
                        <div class="col-12 col-lg-4 btn-two">
                            <a href="{{route('conference.notice.conference.articles',['conference'=>$conference->id])}}" class="btn btn-sm btn-danger" data-wow-duration="1s" style="vertical-align:-4px;width:100%; margin:4px;">
                                Articles list
                            </a>
                        </div>
                        <div class="col-12 col-lg-4 btn-three pt-2">
                            <a href="{{ route('conference.article.create' , ['conference'=>$conference] ) }}">Article Register</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr>

    <div class="row unconfirm-title">
        <p class="font-weight-bold">Unconfirmed conferences</p>
    </div>
    <div class="row">
        @foreach($conferences_noactive as $conference)
            <div class="col-12 col-lg-6" style="margin-bottom:20px;">
                <div class="container">
                    <div class="row confred-expalin">
                        <div class="col-12 col-lg-2">
                            <img src="{{conference_assets_path}}/{{$conference->poster}}">
                        </div>
                        <div class="col-12 col-lg-10">
                            <p class="conference-notice-text">-{{ json_decode($conference->title)->l1 }} </p>
                            <p class="conference-notice-text">-{{ $conference->organizer }}</p>
                            <p class="conference-notice-text">{{ date('Y-m-d' , $conference->startDate) }}</p>
                            <p class="conference-notice-text">{{ $conference->code }}</p>
                            @php($description=json_decode($conference->description))
                            <p>{{ $description->l1 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4 btn-one-red pt-2">
                            <i class="fa fa-times text-danger" style="margin-left:4px;"></i>
                            Not Yet Accepted
                        </div>
                        <div class="col-12 col-lg-4 btn-two-red">
                            <a class="badge badge-secondary text-white wow slideInLeft" data-wow-duration="1s" style="vertical-align:-4px">
                                Conference details
                            </a>
                        </div>
                        <div class="col-12 col-lg-4 btn-three-red pt-2">
                            <del>Article Register</del><br/>
                            <a href="{{ route('conference.notice.edit.conference',['conference'=>$conference->id]) }}" class="btn btn-warning btn-sm" style="margin:12px; font-size:12px;">Edit Conference</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_list')").removeClass('active');
        });
    </script>
@endsection