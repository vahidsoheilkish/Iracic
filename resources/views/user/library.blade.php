@extends('user/master')
@section('styles')
    <style>
    </style>
@endsection
@section("content")
    <div class="container">
        <div class="row">
            <ul class="addressing">
                <li><a href="#">Home</a><i class="fa fa-chevron-right"></i></li>
                <li><a>online-library</a></li>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center content-container-row mt-5">
            <div class="row search-container mt-2">
                <div class="input-group shadow">
                    <input type="search" class="w-50 search-section form-control border-dark" placeholder="Search...">
                    <span class="input-group-btn input-group-prepend">
                    <button type="button" class="btn button-search border-dark">
                        <i class="fa fa-search text-white"></i>
                    </button>
                </span>
                </div>
                <p class="border-secondary advance-search">Advanced Search</p>
            </div>
        </div>
    </div>
    <!--filters-->
    @foreach($groups as $key=>$group)
        @php($group_name = json_decode($group->name))
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="groups">
                        <h6><a href="/journal/group/{{$group->id}}/major/" class="link_a">{{$group_name->en}}</a></h6>
                        <div class="row groups-list">
                            @foreach($group->majors as $major)
                                @php($major_name = json_decode($major->name))
                                <div class="col-3">
                                    <ul>
                                        <li><i class="fa fa-circle"></i><a href="/journal/group/{{$group->id}}/major/{{$major->id}}">{{$major_name->en}}</a></li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="atributes-1">
                                    <h5 class="text-center text-primary">Newest Archives</h5>
                                    <ul class="atributes-content">
                                        @foreach($recent_journals[$key] as $recent_journal)
                                            @if( $recent_journal->id != null )
                                                <li><a href="/journal/{{$recent_journal->id}}/{{$recent_journal->slug}}">{{ $recent_journal->title }}</a></li>
                                                <li class="detail">volume:16، issue:2، june 1396</li>
                                            @else
                                                <p>No recent publication found</p>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="atributes-2">
                                    <h5 class="text-center text-primary">Popular Articles</h5>
                                    @if(!empty($popular_articles_journal))
                                        @foreach($popular_articles_journal as $key=>$article)
                                            @if($article['group_id'] == $group->id )
                                                <ul class="atributes2-content">
                                                    <li><a href="/journal/article/{{$article['articles']->id}}" target="_blank">{{$article['articles']->title}}</a></li>
                                                    <li class="text-muted">volume:{{$article['articles']->issue->volume->id}}</li>, <i class="text-muted">Issue:{{$article['articles']->issue->id}}</i>, <i class="text-muted">{{$article['articles']->issue->volume->year}} / @digitToMonth(  $article["articles"]->issue->month  )</i>
                                                </ul>
                                            @endif
                                        @endforeach
                                    @else
                                        <p class="alert alert-danger tac">Article not found</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
            $("#journal_tab").click(function(){
                $(this).addClass("tab_animation");
                $("#conference_tab").removeClass("tab_animation");
                $("#book_tab").removeClass("tab_animation");

                $("#journal_tab_container").fadeIn("fast");
                $("#conference_tab_container").fadeOut("fast");
                $("#book_tab_container").fadeOut("fast");
            });
            $("#conference_tab").click(function(){
                $(this).addClass("tab_animation");
                $("#journal_tab").removeClass("tab_animation");
                $("#book_tab").removeClass("tab_animation");

                $("#journal_tab_container").fadeOut("fast");
                $("#conference_tab_container").fadeIn("fast");
                $("#book_tab_container").fadeOut("fast");
            });
            $("#book_tab").click(function(){
                $(this).addClass("tab_animation");
                $("#journal_tab").removeClass("tab_animation");
                $("#conference_tab").removeClass("tab_animation");

                $("#journal_tab_container").fadeOut("fast");
                $("#conference_tab_container").fadeOut("fast");
                $("#book_tab_container").fadeIn("fast");
            });
        });

        $("#register_button").click(function(){
            let email = $("#email").val();
            let name = $("#name").val();
            let family = $("#family").val();
            let melicode = $("#melicode").val();
            let password = $("#password").val();
            let password2 = $("#password2").val();
            $.ajax({
                'url' : '/user/register' ,
                'method' : 'POST',
                'data' : {_token:'{{csrf_token()}}' , email,name,family,melicode,password,password2},
                'dataType' : 'json',
                'success' : function(data){
                    let errs_list = $("#err_list");
                    errs_list.empty();
                    if(data.err){
                        document.documentElement.scrollTop = 0;
                        errs_list.show("fast");
                        for (let key in data.err) {
                            $("#err_list").append('<li>'+data.err[key]+'</li>');
                        }
                        return false;
                    }
                    if(data.message = "success"){
                        swal("", "Successfully register", "success");
                        setTimeout(function(){
                            location.reload();
                        },2000);
                    }else if(data.message="fail"){
                        errs_list.show("fast");
                        $("#err_list").append('<li>خطا در ثبت نام، لطفا مجددا تلاش کنید.</li>');
                    }
                }
            });
        });
    </script>
@endsection