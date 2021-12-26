@extends('publication.en.dashboard.master')

@section('styles')
    <style>
        #article_info_container{text-align: center;}
    </style>
@endsection

@section('content')
    <div class="container" style="margin-top:50px;">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="alert alert-info tac">Click on issue to load issue articles</h4>
                <table id="article_info_container" class="table table-bordered">
                </table>
            </div>
            <div class="col-sm-3" style="border:1px solid #ccc; text-align: center; padding:10px;">
                <h3>Volumes</h3>
                @if(  $publication->volumes()->exists()  )
                    @foreach($publication->volumes as $key=>$volume)
                        <div  class="card-three">
                            <div class="card-header p-header">
                                <a class="card-link" data-toggle="collapse">Volume {{ $volume->id }} ({{$volume->year}}) </a>
                            </div>
                            @if(  $volume->issues()->exists()  )
                                <div id="issue_{{($key+1)}}" class="card-body accordian-content tac" style="padding:4px;">
                                    @foreach($volume->issues as $issue)
                                        <button class="btn btn-warning btn-sm issue_btn" onclick="getIssue(this)" volume-id="{{$volume->id}}" issue-id="{{$issue->id}}" style="padding:4px;"><span class="fa fa-book" style="margin:0 4px; vertical-align: -1px"></span>Issue {{ $issue->id }}</button>
                                        <p class="issue_info"> Month: {{ $issue->month }}<span style="padding:4px; font-size:12px;">Pages: {{$issue->pages_number}}</span></p>
                                    @endforeach
                                </div>
                            @else
                                <div id="issue_{{($key+1)}}">
                                    <p class="alert alert-warning tac no_issue">No issue</p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
    <p id="result"></p>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_tree_list')").removeClass('active');
        });

        function getIssue(event){
            $("#progressbar").show("fast");
            $("#article_info_container").show("slow");
            let issue_id = $(event).attr("issue-id");
            $.ajax({
                url : '/get/issue/' + issue_id ,
                type : 'post' ,
                data : { '_token':'{{csrf_token()}}'  } ,
                success(data){
                    $("#progressbar").hide("fast");
                    $('html').animate({ scrollTop: 550 }, 'slow');
                    $("#article_info_container").empty();
                    if( Object.entries(data).length === 0 ){
                        $("#article_info_container").append('<h2 class="alert alert-danger" style="color:tomato; text-align:center; margin:30px;">No article found</h2>');
                        return;
                    }
                    $.each(data,(key,article)=>{
                        if(article.active == 0 ) {
                            $("#article_info_container").append('' +
                                '<tr class="alert-danger">\n' +
                                    '<td>' + article._id + '</td>\n' +
                                    '<td>' + article.title + '</td>\n' +
                                    '<td><a href="/user/publication/edit/article/'+article._id+'"><span class="fa fa-edit" style="vertical-align: middle;font-size:16px; margin:0 4px;"></span>Edit article</a></td>\n' +
                                '</tr>');
                        }else{
                            $("#article_info_container").append('' +
                                '<tr class="alert-success">\n' +
                                    '<td>' + article._id + '</td>\n' +
                                    '<td>' + article.title + '</td>\n' +
                                    '<td>---</td>\n' +
                                '</tr>');
                        }
                    });
                }
            });
        }
    </script>
@endsection