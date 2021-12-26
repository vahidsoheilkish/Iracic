@extends('conference.fa.panel.master')

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
    <div class="row unconfirm-title rtl">
        <p class="alert alert-primary font-weight-bold">دوره های کنفرانس</p>
    </div>
    <div class="row rtl">
        @foreach($volumes->volumes as $volume)
            <div class="col-12 col-lg-6" style="margin-bottom:20px;">
                <div class="container">
                    <div class="row confgreen-expalin">
                        <div class="col-12 col-lg-9  rtl tar">
                            <p class="conference-notice-text">-{{ $volume->city }} </p>
                            <p class="conference-notice-text">{{ $volume->start_date }}</p>
                            <p class="conference-notice-text">{{ $volume->_id }}</p>
                            <p>{{ $volume->description }}</p>
                        </div>
                        <div class="col-12 col-lg-3">
                            <img src="{{$volume->dir}}/poster.jpg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12 btn-three-red pt-2">
                            <a href="{{ route('conference.article.create.fa' , ['group'=>$volumes->group_id,'major'=>$volumes->major_id,'conference'=>$volumes->id,'volume'=>$volume->id]) }} " class="btn btn-warning btn-sm" style="margin:12px; font-size:12px;">ثبت مقاله</a>
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