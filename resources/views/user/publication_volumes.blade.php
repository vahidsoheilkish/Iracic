
@extends('user/master')
@section('styles')
    <style>
        .journal_img{width:150px;}
        #tbl_volumes{border-radius:10px;}
        #tbl_volumes td,th{padding:2px !important; margin:0 !important; }
        #tbl_volumes tr:nth-child(odd){background-color: #f9f9f9;}
        #tbl_volumes tr:nth-child(even){background-color: #f9f9f9;}
        .issues_container{border:1px solid #ccc; margin-bottom:10px; text-align:center; border-radius:4px;}
        .icon_plus{color:#ff394f;}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .green{color: #0ac282}
        .author_span{ font-size:13px; color: #222222; }
        .down-arrow:hover{color:#ff394f; cursor: pointer; transition: .3s;}
        .issue_info{padding:4px 0; margin:3px; font-size:12px;}
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <ul class="addressing">
                <li><a href="/">Home</a><i class="fa fa-chevron-right"></i></li>
                <li><a href="{{ route('publication.link', ['id'=>$journal]) }}">Journals</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid p-3 mt-5" style="background-color: #e0ebeb">
        <div class="container">
            <div class="row">
                <div class="photo-conf-jour col-12 col-lg-3">
                    <img src="/upload/publications/assets/{{$journal->dir}}/{{$journal->poster}}">
                </div>
                <div class="col-9 conf-atribute">
                    <p><a href="#">{{ $journal->title }}</a></p>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <ul>
                                <li><span class="text-title">concessionaire</span>: Hamadan University of Medical Sciences, Hamedan, Iran<img src="img/flag.jpg" class="conf-place-flag"><img src="img/university/tehranuni.png" class="conf-orgnizer-pic"></li>
                                <li><span class="text-title">Group</span>:<mark class="bg-danger text-light">{{ json_decode($group->name)->en }}</mark></li>
                                <li><span class="text-title">Field</span>:<mark class="bg-danger text-light">{{ json_decode($major->name)->en }}</mark></li>
                                <li><span class="text-title">Print ISSN</span>: {{ $journal->printISSN }}</li>
                                <li><span class="text-title">Electronic ISSN</span>: {{ $journal->onlineISSN }}</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <ul>
                                <li><span class="text-title">Journal Language</span>:
                                    @if($journal->lang == "en")
                                        English
                                    @else
                                        Persian
                                    @endif
                                </li>
                                <li><span class="text-title">Release order</span>: {{ $journal->publisher_order }}</li>
                                <li><span class="text-title">Year of publication started</span>: {{ $journal->first_publish_year }}</li>
                                <li><span class="text-title">Website</span>: {{ $journal->website }}</li>
                                <li><span class="text-title"> Iracic Profile Code</span>: 12234</li>
                                <li><span class="text-title">Article Type</span>: Comlete</li>
                                <li><span class="text-title">Archive Type</span>: 5 March 1397</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <ul class="Council">
                                <li><img src="/img/user/author/author5.jpg"><span class="text-title"> Director responsible for</span>Ali Rezaie</li>
                                <li><img src="/img/user/author/author1.jpg"><span class="text-title">Journal Secretary</span>: Reza Ahmadi</li>
                                <li><img src="/img/user/author/author2.jpg"><span class="text-title">Expert of the Journal</span>: Mehdi Ahmadi</li>
                                <li><img src="/img/user/author/author3.jpg"><span class="text-title">Manager</span>: Reza Ahmadi</li>
                                <li><img src="/img/user/author/author4.jpg"><span class="text-title"> Editor</span>: Mehdi Ahmadi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row text-center pt-5 pb-4">
            <div class="col-12">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="Search for the title of the journals articles">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                    <p class="text-l"><i class="fa fa-arrow-right pr-1 wow slideInLeft text-secondary"></i>Advanced Search<i class="fa fa-arrow-left pl-1 wow slideInRight text-secondary"></i></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-4 main-div">
        <div class="row">
            <div class="col-12 col-md-3">
                <div id="accordion" style="min-height: 300px;">
                    @if(  $journal->volumes()->exists()  )
                        @foreach($journal->volumes as $key=>$volume)
                            <div  class="card-three">
                                <div class="card-header p-header">
                                    <a href="#Section1" class="card-link" data-toggle="collapse"><i class="fa fa-minus icon_plus red pr-2" onclick="displayIssues(this , {{ ($key +1) }})"></i>Volume ({{$volume->year}}) </a>
                                </div>
                                @if(  $volume->issues()->exists()  )
                                    <div id="issue_{{($key+1)}}" class="card-body accordian-content tac" style="padding:4px;">
                                        @foreach($volume->issues as $index=>$issue)
                                            <button class="btn btn-warning btn-sm issue_btn" onclick="getIssue(this)" volume-id="{{$volume->id}}" issue-id="{{$issue->id}}" style="padding:4px;"><span class="fa fa-book" style="margin:0 4px; vertical-align: -1px"></span>Issue {{ $index +1  }}</button>
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
                    @else
                        <div class="alert alert-danger mt-1 tac" style="min-height: 50px;">
                            No volume found
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs">
                            <li class="nav-item tab-nav-item">
                                <a href="#newest-issue" class="nav-link active" data-toggle="tab">Newest publications</a>
                            </li>
                            <li class="nav-item tab-nav-item">
                                <a href="#popular-article" class="nav-link" data-toggle="tab">Popular articles</a>
                            </li>
                            <li class="nav-item tab-nav-item">
                                <a href="#Special-issue" class="nav-link" data-toggle="tab">Especial Issues</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <div id="article_info_container" class="tab-content tab-section-content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $(".issue_btn:first").trigger("click");
        });
        function displayIssues(e , id){
            if ( $(e).hasClass('fa-minus') ){
                $("#issue_"+id).hide("slow");
                $(e).removeClass("fa-minus");
                $(e).removeClass("red");
                $(e).addClass("fa-plus");
                $(e).addClass("green");
            }else{
                $("#issue_"+id).show("slow");
                $(e).removeClass("fa-plus");
                $(e).removeClass("green");
                $(e).addClass("fa-minus");
                $(e).addClass("red");
            }
        }

        function getIssue(event){
            $("#progressbar").show("fast");
            $("#article_info_container").show("slow");
            $("#article_resources").empty();
            $("#article_authors_tbl").empty();
            $("#article_structs").empty();
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
                        $("#article_info_container").append('<li class="journals-section">\n' +
                            '                            <a href="/journal/article/page/'+article._id+'" target="_blank">\n' +
                            '                            <span class="section-text1">\n' +
                            '                               <span>'+(key+1)+'- </span>'+ article.title +'</span>\n' +
                            '                            </a>\n' +
                            '                            <div class="section-text2">\n' +
                            '                                <p class="text-muted">Page '+ article.page +'</p>\n' +
                            '                                <p class="text-muted">\tLeila Haj Najafi; Mohsen Tehranizadeh </p>\n' +
                            '                                <span class="down-arrow" onclick="displayAbstract(this,abstract_article_'+(key+1)+')" data-toggle="collapse" data-target="#abstract-1">Abstract<span class="fa fa-arrow-circle-up" style="margin:0 4px;"></span></span>\n' +
                            '                                <span class="download"><a href="#">Download</a><i class="fa fa-download"></i></span>\n' +
                            '                                <div class="collapseshow text-justify">\n' +
                            '                                    <p id="abstract_article_'+(key+1)+'">'+ article.abstract +'</p>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                        </li>');
                        let authors = JSON.parse(article.authors_info);
                        $.each(authors, (k,author)=>{
                            $("#article_info_container").append('' +
                                '<span class="author_span">'
                                + author.name +' ؛ ' +
                                '</span><span class="left_line"></span>');
                        });
                        $("#article_info_container").append('<hr/>');
                    });
                }
            });
        }

        function displayAbstract(e,target){
            let span = $(e);
            let icon = $(e.firstElementChild);
            if( icon.hasClass("fa-arrow-circle-up")){
                span.css('color','#b73287');
                icon.removeClass("fa-arrow-circle-up");
                icon.addClass("fa-arrow-circle-down");
                $(target).fadeOut("fast");
            }else{
                span.css('color','#249265');
                icon.addClass("fa-arrow-circle-up");
                icon.removeClass("fa-arrow-circle-down");
                $(target).fadeIn("fast");
            }
        }
    </script>
@endsection