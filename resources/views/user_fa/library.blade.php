@extends('user_fa/master')
@section('styles')
    <style>

    </style>
@endsection
@section("content")

    @foreach($groups as $key=>$group)
        @php($group_name = json_decode($group->name))
        <div class="container mt-5">
            <div class="row">
                <div class="col-12">
                    <div class="groups">
                        <h6>{{$group_name->fa}}</h6>
                        <div class="row groups-list">
                            @foreach($group->majors as $major)
                                @php($major_name = json_decode($major->name))
                                <div class="col-3">
                                    <ul>
                                        <li><i class="fa fa-circle"></i><a href="{{route('user.fa.publications' , ['group'=>$group->id , 'major'=>$major->id] )}}">{{ $major_name->fa }}</a></li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="atributes-1">
                                    <h5 class="text-center text-primary">آخرین آرشیوها</h5>
                                    @if(count($recent_journals[$key]) >0)
                                        @if(isset($recent_journals[$key]) && $recent_journals[$key] != null)
                                            @foreach($recent_journals[$key] as $recent_journal)
                                                @if( $recent_journal->id != null )
                                                <ul class="atributes-content">
                                                    <li><a href="/fa/journal/{{$recent_journal->id}}/{{$recent_journal->slug}}">{{ $recent_journal->title }}</a></li>
                                                    <li class="detail">دوره:16، شماره:2، مهر 1396</li>
                                                </ul>
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        <p class="alert alert-warning tac">آرشیو یافت نشد</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="atributes-2">
                                    <h5 class="text-center text-primary">مقالات محبوب</h5>
                                    @if(!empty($popular_articles_journal))
                                        @foreach($popular_articles_journal as $key=>$article)
                                            @if($article['group_id'] == $group->id )
                                                <ul class="atributes2-content">
                                                    <li><a href="/fa/journal/article/{{$article['articles']->id}}" target="_blank">{{$article['articles']->title}}</a></li>
                                                    <li class="text-muted"><i>volume:{{$article['articles']->issue->volume->id}}</i>, <i class="text-muted">Issue:{{$article['articles']->issue->id}}</i>, <i class="text-muted">{{$article['articles']->issue->volume->year}} / @digitToMonth(  $article["articles"]->issue->month  )</i></li>
                                                </ul>
                                            @endif
                                        @endforeach
                                    @else
                                        <p class="alert alert-danger tac">مقاله ای یافت نشد</p>
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
    </script>
@endsection