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
    <div class="container-fluid">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    @php( $title = json_decode($conference->title) )
                    <h3 class="text-muted" style="margin:12px;">{{ $title->l1 }}</h3>
                    <img src="/img/user/spr.png" height="30" width="280"/>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row container-publication-conference">
            <div class="col-12 col-md-4 journal-content">
                <div>
                    <ul class="journal-content-list text-center">
                        <li>Last Volume</li>
                        <li>Most Popular Articles</li>
                        <li>Greatest Reasercher</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4 journal-content text-center">
                <div>
                    <div class="journal-img img-fluid">
                        @if($conference->owner_logo == "no_img")
                            <img src="/img/user/no_img.png" style="height: 200px;">
                        @else
                            <img src="{{conference_assets_path}}/{{$conference->id}}/{{$conference->owner_logo}}" style="height: 200px;">
                        @endif
                    </div>
                    <button href="#" class="btn btn-light mt-3 btn-outline-info">Submit Your Article</button>
                </div>
                <form class="col-12 search-container text-center">
                    <input type="text" id="search-bar" placeholder="search for journal">
                    <a href="#"><img class="search-icon" src="/img/user/search-icon2.png"></a>
                </form>
            </div>
            <div class="co-12 col-md-4 journal-content">
                <div>
                    <ul class="journal-content-list">
                        <li>Concessionaire:: {{ $conference->lang == 'en' ? 'English' : 'Persian' }}</li>
                        <li>Conference Date::</li>
                        <li>Conference Place: {{ $conference->place }}</li>
                        <li>Print ISSN: {{ $conference->printISSN }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid wow slideInLeft" data-wow-duration="3s">
        <div class="row justify-content-center mt-5">
            <ul class="breadcrumb-2">
                <li><a href="#">Volume & Issue<i class="fa fa-chevron-right pl-3 pt-1"></i></a></li>
                <li><a href="#" id="volume_id"> Volume 51<i class="fa fa-chevron-right pl-3 pt-1"></i></a></li>
                <li><a href="#" class="last-a">Page 229-463</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid section-2">
        <div class="row">
            <div class="col-12 col-md-5 col-lg-3 volume-sidebar pl-4 pt-4">
                <h4>Journal Archive</h4>
                <div id="accordion" style="min-height: 300px;">
                    @if(  $conference->volumes()->exists()  )
                        @foreach($conference->volumes as $key=>$volume)
                            <div  class="card-three">
                                <div class="card-header">
                                    {{ $key +1 }}<button volume-id="{{ $volume->id }}" class="btn btn-primary btn-sm" onclick="getVolumes(this)"> {{ $volume->id }}  </button>
                                    <span>{{ $volume->startDate }} date</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-7 col-lg-9 article-sidebar">
                <div class="right-sidebar-content">
                    <h4 class="journals-section" style="margin:23px;">Research Article</h4>
                    <ul id="article_info_container" class="journals">

                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            //$(".volume_btn:first").trigger("click");
        });

        function getVolumes(target){
            let article_info_container = $("#article_info_container");
            let volume = $(target).attr('volume-id');
            $.ajax({
                url : '{{route("get.conference.volume")}}',
                type : 'post' ,
                data : { '_token':'{{csrf_token()}}' , volume } ,
                success : function(data){
                    article_info_container.empty();
                    if(data.length !== 0){
                        $.each(data, (key,item) => {
                            article_info_container.append('<li>' +
                                '<a href="/conference/article/page/'+ item._id +'" target="_blank">'+ item._id +'</a>' +
                                '</li>');
                        });
                    }else{
                        swal("No article");
                    }
                }
            });
        }

        function getArticles(event){
            $("#progressbar").show("fast");
            $("#article_info_container").show("slow");
            $("#article_resources").empty();
            $("#article_authors_tbl").empty();
            $("#article_structs").empty();
            let conference_id = $(event).attr("conference-id");
            $("#loading_container").show("fast");
            $.ajax({
                url : '/get/articles/' + conference_id ,
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
                        let abstract_en = JSON.parse( article.abstract );
                        $("#article_info_container").append('<li class="journals-section">\n' +
                            '                            <a href="/conference/article/page/'+article.id+'" target="_blank">\n' +
                            '                            <span class="section-text1">\n' +
                            '                               <span>'+(key+1)+'- </span>'+ article.title +'</span>\n' +
                            '                            </a>\n' +
                            '                            <div class="section-text2">\n' +
                            '                                <p class="text-muted">Page '+ article.page +'</p>\n' +
                            '                                <p class="text-muted">\tLeila Haj Najafi; Mohsen Tehranizadeh </p>\n' +
                            '                                <span class="down-arrow" onclick="displayAbstract(this,abstract_article_'+(key+1)+')" data-toggle="collapse" data-target="#abstract-1">Abstract<span class="fa fa-arrow-circle-up" style="margin:0 4px;"></span></span>\n' +
                            '                                <span class="download"><a href="#">Download</a><i class="fa fa-download"></i></span>\n' +
                            '                                <div class="collapseshow text-justify">\n' +
                            '                                    <p id="abstract_article_'+(key+1)+'">'+ abstract_en['en'] +'</p>\n' +
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