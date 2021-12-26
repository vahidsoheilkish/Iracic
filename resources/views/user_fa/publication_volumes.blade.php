@extends('user_fa/master')
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
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row text-center pt-5 pb-4">
            <div class="col-12">
                <div class="search">
                    <input type="text" class="searchTerm" placeholder="جستجو برای عنوان مقالات این نشریه">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                    <p class="text-l"><i class="fa fa-arrow-left pl-1 wow slideInRight text-secondary"></i>جستجوی پیشرفته<i class="fa fa-arrow-right pr-1 wow slideInLeft text-secondary"></i></p>
                </div>
            </div>
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
                                <li><span class="text-title">صاحب امتیاز</span>: ایران، تهران، دانشگاه بوعلی سینا همدان<img src="img/flag.jpg" class="conf-place-flag"><img src="img/university/tehranuni.png" class="conf-orgnizer-pic"></li>
                                <li><span class="text-title">گروه</span>: {{ json_decode($group->name)->en }} </li>
                                <li><span class="text-title">رشته</span>: {{ json_decode($major->name)->en }}</li>
                                <li><span class="text-title">شاپا چاپی</span>: {{ $journal->printISSN }}</li>
                                <li><span class="text-title">شاپا الکترونیکی</span>: {{ $journal->onlineISSN }}</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <ul>
                                <li><span class="text-title">زبان نشریه</span>:
                                    @if($journal->lang == "en")
                                        انگلیسی
                                    @else
                                        فارسی
                                    @endif
                                </li>
                                <li><span class="text-title">ترتیب انتشار</span>: {{ $journal->publisher_order }}</li>
                                <li><span class="text-title">سال شروع انتشار</span>: {{ $journal->first_publish_year }}</li>
                                <li><span class="text-title">وب سایت</span>: {{ $journal->website }}</li>
                                <li><span class="text-title"> کد نمایه ایراسیس</span>: 12234</li>
                                <li><span class="text-title"> نوع مقالات</span>: کامل</li>
                                <li><span class="text-title"> تاریخ آرشیو</span>: 5 تیر 1397</li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-4">
                            <ul class="Council">
                                <li><img src="/img/user/author/author5.jpg"><span class="text-title"> مدیر مسئول</span>: محمد رضا رضایی</li>
                                <li><img src="/img/user/author/author1.jpg"><span class="text-title">دبیر نشریه</span>: سید علیرضا رضایی</li>
                                <li><img src="/img/user/author/author2.jpg"><span class="text-title">کارشناس نشریه</span>: محمد مهدی ن رضایی</li>
                                <li><img src="/img/user/author/author3.jpg"><span class="text-title"> مدیر داخلی</span>: رضا رضایی</li>
                                <li><img src="/img/user/author/author4.jpg"><span class="text-title"> ویراستار</span>: رضا رضایی</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container pt-4 main-div">
        <div class="row">
            <div class="col-12 col-md-3">
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if(  $journal->volumes()->exists()  )
                        @foreach($journal->volumes as $key=>$volume)
                            <div  class="card-three">
                                <div class="card-header p-header">
                                    <a href="#Section1" class="card-link" data-toggle="collapse"><i class="fa fa-minus icon_plus red pr-2" onclick="displayIssues(this , {{ ($key +1) }})"></i>دوره ({{$volume->year}}) </a>
                                </div>
                                @if(  $volume->issues()->exists()  )
                                    <div id="issue_{{($key+1)}}" class="card-body accordian-content tac" style="padding:4px;">
                                        @foreach($volume->issues as $index=>$issue)
                                            <button class="btn btn-warning btn-sm issue_btn" onclick="getIssue(this)" volume-id="{{$volume->id}}" issue-id="{{$issue->id}}" style="padding:4px;"><span class="fa fa-book" style="margin:0 4px; vertical-align: -1px"></span>شماره {{ $index +1  }}</button>
                                            <p class="issue_info"> ماه: {{ $issue->month }}<span style="padding:4px; font-size:12px;">صفحه: {{$issue->pages_number}}</span></p>
                                        @endforeach
                                    </div>
                                @else
                                    <div id="issue_{{($key+1)}}">
                                        <p class="alert alert-warning tac no_issue">شماره ای وجود ندارد</p>
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
                            <li class="nav-item tab-nav-item mr-2">
                                <a href="#newest-issue" class="nav-link active" data-toggle="tab">جدیدترین شماره ها</a>
                            </li>
                            <li class="nav-item tab-nav-item">
                                <a href="#popular-article" class="nav-link" data-toggle="tab">محبوب ترین مقالات</a>
                            </li>
                            <li class="nav-item tab-nav-item">
                                <a href="#Special-issue" class="nav-link" data-toggle="tab">شماره های ویژه</a>
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
    <div class="container-fluid">
        <div class="row">
            <nav id="social-media-sidebar">
                <ul class="media">
                    <li class="side-social facebook">
                        <a href=""><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="side-social twitter">
                        <a href=#><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="side-social youtube">
                        <a href=#> <i class="fa fa-youtube-play text-secondary"></i></a>
                    </li>
                    <li class="side-social instagram">
                        <a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a>
                    </li>
                </ul>
            </nav>
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
                $("#issue_"+id).hide("fast");
                $(e).removeClass("fa-minus");
                $(e).removeClass("red");
                $(e).addClass("fa-plus");
                $(e).addClass("green");
            }else{
                $("#issue_"+id).show("fast");
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
                url : '/fa/get/issue/' + issue_id ,
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
                            '                            <a href="/fa/journal/article/page/'+article._id+'" target="_blank">\n' +
                            '                            <span class="section-text1">\n' +
                            '                               <span>'+(key+1)+'- </span>'+ article.title +'</span>\n' +
                            '                            </a>\n' +
                            '                            <div class="section-text2">\n' +
                            '                                <p class="text-muted">صفحه '+ article.page +'</p>\n' +
                            '                                <p class="text-muted">Leila Haj Najafi; Mohsen Tehranizadeh </p>\n' +
                            '                                <span class="down-arrow" onclick="displayAbstract(this,abstract_article_'+(key+1)+')" data-toggle="collapse" data-target="#abstract-1">چکیده<span class="fa fa-arrow-circle-up" style="margin:0 4px;"></span></span>\n' +
                            '                                <span class="download"><a href="#">دانلود</a><i class="fa fa-download"></i></span>\n' +
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