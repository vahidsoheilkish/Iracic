@extends('publication.en.dashboard.master')

@section('styles')

@endsection

@section('content')
    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-sm-12 tar" style="margin:auto;">
                @include('message.success')
                @include('message.en.errors')
                @include('message.fail')
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h4 class="tal" style="">Dear {{ $publication_user->email}} welcome</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="text-align:left; margin:20px;">
                <a href="{{ route('publication.create') }}" class="btn btn-warning btn-sm">Submit publication</a>
                <a href="#" data-toggle="modal" data-target="#createVolume" class="btn btn-info btn-sm">Submit new volume</a>
                <a href="#" data-toggle="modal" data-target="#createIssue" class="btn btn-primary btn-sm">Submit new issue</a>
                <a href="{{ route('publication.article.create') }}" class="btn btn-success btn-sm">Submit article</a>
                @include('modal.PublicationUser.en.createVolume')
                @include('modal.PublicationUser.en.createIssue')
                @if( !empty($publication) )
                    @if($publication->active == 0)
                        <p class="alert alert-danger tac" style="color:tomato; margin:20px;">Your publication not accepted</p>
                    @elseif($publication->active == 1)
                        <p class="alert alert-success tac" style="margin:20px;">Your publication accepted successfully</p>
                    @else
                        <p class="alert alert-success tac" style="margin:20px;">Your publication accepted but no permission to submit articles</p>
                    @endif
                @else
                    <p class="alert alert-info tac" style="margin:20px;">You don't submit your publication</p>
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