@extends('publication.fa.dashboard.master')

@section('styles')

@endsection

@section('content')
    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-sm-12 tar" style="margin:auto;">
                @include('message.success')
                @include('message.errors')
                @include('message.fail')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4 class="tar" style="">کاربر عزیز  {{ $publication_user->email}} خوش آمدید </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 tar" style="margin:20px;">
                <a href="{{ route('publication.create.fa') }}" class="btn btn-warning btn-sm">ثبت نشریه</a>
                <a href="#" data-toggle="modal" data-target="#createVolume" class="btn btn-info btn-sm">ثبت دوره جدید</a>
                <a href="#" data-toggle="modal" data-target="#createIssue" class="btn btn-primary btn-sm">ثبت شماره جدید</a>
                <a href="{{ route('publication.article.create.fa') }}" class="btn btn-success btn-sm">ثبت مقاله</a>
                @include('modal.PublicationUser.fa.createVolume')
                @include('modal.PublicationUser.fa.createIssue')
                @if( !empty($publication) )
                    @if($publication->active == 0)
                        <p class="alert alert-danger tac" style="color:tomato; margin:20px;">نشریه شما هنوز تایید نشده است</p>
                    @elseif($publication->active == 1)
                        <p class="alert alert-success tac" style="margin:20px;">نشریه شما با موفقیت تایید شده است</p>
                    @else
                        <p class="alert alert-success tac" style="margin:20px;">نشریه شما تایید اما دسترسی ثبت مقاله وجود ندارد</p>
                    @endif
                @else
                    <p class="alert alert-info tac" style="margin:20px;">شما هنوز نشریه خود را ثبت نکرده اید !</p>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_dashboard')").removeClass('active');
            $("#special_issue").click(function(){
                let special_issue = $(this);
                if(special_issue.prop('checked') == 1 ){
                    $("#special_issue_description").css('display','block');
                }else{
                    $("#special_issue_description").css('display','none');
                }
            });
        });
    </script>
@endsection