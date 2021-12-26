@extends('user/master')

@section('styles')
    <style>
    </style>
@endsection

@section("content")
    <div class="container">
        <div class="row">
            <ul class="addressing">
                <li><a href="/">Home</a><i class="fa fa-chevron-right"></i></li>
                <li><a href="{{ route('usr.get.journal.article',['article'=>$article]) }}">Article</a></li>
            </ul>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-12 col-lg-3" id="structure-sidebar">
                <ul>
                    <li><h5>General structure</h5></li>
                    <li><a href="#pii_abstract">Abstract</a></li>
                    <li><a href="#pii_authors">Authors</a></li>
                    <li><a href="#pii_highlight">Highlight</a></li>
                    <li><a href="#pii_keywords">Keywords</a></li>
                    <hr/>
                    <h4 class="">Structures</h4>
                    @foreach($structs as $index=>$struct)
                        <li>
                            <hr style="padding:0; margin:0;"/>
                            <a href="#Str{{ str_limit($struct->str,4,'') }}" onclick="scrollTarget(this)" style="font-size:12px;">{{ $struct->str    }}</a>
                        </li>
{{--                        @if( !empty($struct->substr) )--}}
                            {{--<ul class="substr">--}}
                                {{--@for($i=0; $i<count($struct->substr); $i++)--}}
                                    {{--<li style="color:#222">{{ $struct->substr[$i] }}</li>--}}
                                {{--@endfor--}}
                            {{--</ul>--}}
                        {{--@endif--}}
                    @endforeach
                </ul>
                <hr>
                <ul id="related-abstract">
                    <li><h5>Related Articles</h5></li>
                    @foreach($related_articles as $related)
                        <li>
                            <a href="{{ route('usr.get.journal.article',['article'=>$related->id] ) }}" target="_blank"><i class="fa fa-circle"></i>
                                {{ $related->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-lg-6">
                <div class="row">
                    <!--<div class="col-12 col-lg-3 text-right logo">-->
                    <!--<img src="img/logo.png" class="article-iracic-logo">-->
                    <!--</div>-->
                    <div class="col-12 jrnl-attribute">
                        <div class="row">
                            <div class="col-12 col-lg-10">
                                <a href="inlinepage-2.html" class="pl-2"> {{$article->issue->volume->publication->title}} </a>
                                <ul id="grouping">
                                    <li>{{ $article->issue->volume->id }}</li><i class="fa fa-chevron-right pr-1"></i>
                                    <li>{{ $article->issue->id }}</li><i class="fa fa-chevron-right pr-1"></i>
                                    <li>{{ $article->issue->volume->year }} {{ $article->issue->month}}</li><i class="fa fa-chevron-right pr-1"></i>
                                    <li>{{ $article->page_from }} - {{ $article->page_to }}</li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-2">
                                <img src="{{publication_assets_path}}/{{$article->issue->volume->publication->dir}}/{{$article->issue->volume->publication->poster}}" class="pull-left">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="article-social-media">
                            <a href="{{publication_article_path.$article->dir.'/'.$pdf_file}}"><i class="fa fa-download pr-1"></i>Download</a>
                            <a href="#"><i class="fa fa-at pr-1"></i>email</a>
                            <a href="#"><i class="fa fa-share-alt pr-1"></i>Share</a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <ul class="issn pt-3">
                            <li class="text-left"><i class="fa fa-arrow-right pr-2"></i>print ISSN:{{$article->issue->volume->publication->printISSN }}</li>
                            <li class="text-left"><i class="fa fa-arrow-right pr-2"></i>online ISSN:{{$article->issue->volume->publication->onlineISSN }}</li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <ul id="article-content">
                        <li>{{ $article->title }}</li>
                        <li>
                            @foreach($authors as $author)
                                <span class="red">{{$author->name}};</span>
                            @endforeach
                        </li>
                        <li>Tehran University </li>
                        @php( $apply_date = strtotime($article->created_at) )
                        @php( $accept = strtotime($article->accepted['date']) )
                        @php( $receieve = strtotime($article->receieved['date']) )

                        <li><span>Date Of Acceptance :</span>{{ date("Y-m-d",$accept) }} , <span>publication date : </span>{{date("Y-m-d",$receieve)}} , <span>Index Date : </span> {{ date("Y-m-d",$apply_date) }} </li>
                        <li><span class="pull-left pr-2">Iracic Code:  </span>{{ $article->IOI }} </li>
                        <li><span class="pull-left pr-2"> DOI: </span>{{ $article->DOI }} </li>
                        <li><span>Publisher:  </span>Tehran University</li>
                    </ul>
                </div>
                <hr>
                <div id="accordion">
                    <div id="pii_highlight" class="card-five">
                        <div class="card-header highlight-header">
                            <a href="#Section1" class="card-link" data-toggle="collapse"><i class="fa fa-chevron-down"></i>Highlights</a>
                        </div>
                        <div id="Section1" class="collapse show" data-parent="#accordion">
                            <div class="card-body text-justify">
                                {{ $article->highlight }}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="accordion">
                    <div id="pii_abstract" class="card-five">
                        <div class="card-header highlight-header">
                            <a href="#Section2" class="card-link" data-toggle="collapse"><i class="fa fa-chevron-down"></i>Abstract</a>
                        </div>
                        <div id="Section2" class="collapse show" data-parent="#accordion">
                            <div class="card-body text-justify">
                                {{ $article->abstract }}
                            </div>
                        </div>
                    </div>
                </div>
                <div id="accordion">
                    <div id="pii_keywords" class="card-five">
                        <div class="card-header highlight-header">
                            <a href="#Section3" class="card-link" data-toggle="collapse"><i class="fa fa-chevron-down"></i>Keywords</a>
                        </div>
                        <div id="Section3" class="collapse show" data-parent="#accordion">
                            <div class="card-body text-justify">
                                @foreach($keywords as $keyword)
                                    <p style="text-align: justify;">{{$keyword}}</p>
                                @endforeach
                            </div>
                        </div>
                     </div>
                </div>
                <div id="accordion">
                    <div id="pii_authors" class="card-five">
                        <div class="card-header highlight-header">
                            <a href="#Section4" class="card-link" data-toggle="collapse"><i class="fa fa-chevron-down"></i>Authors</a>
                        </div>
                        <div id="Section4" class="collapse show" data-parent="#accordion">
                            <div class="card-body text-justify">
                                @foreach($authors as $author)
                                    <span class="red">{{$author->name}};</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div id="accordion">
                    <div class="card-five">
                        <div class="card-header highlight-header">
                            <a href="#Section5" class="card-link" data-toggle="collapse"><i class="fa fa-chevron-down"></i>Structure</a>
                        </div>
                        <div id="Section5" class="collapse show" data-parent="#accordion">
                            <div class="card-body text-justify">
                                @if($structs)
                                    @foreach($structs as $key=>$struct)
                                        <h6 class="context_title"><a id="Str{{ str_limit($struct->str,4,'') }}">{{ $key+1 }}- {{ $struct->str }}</a></h6>
                                        <div style="color:#222">
                                            @if( !empty($struct->substr) )
                                                @for($i=0; $i<count($struct->substr); $i++)
                                                    <ul style="list-style: none">
                                                        <li style="color:#222"><i class="sub_index">({{$key+1}}.{{$i+1}})</i>{{ $struct->substr[$i] }}</li>
                                                    </ul>
                                                @endfor
                                            @endif
                                        </div>
                                        @if(!$loop->last)
                                            <div style="height:2px; background-color:#ff0000; margin:14px;"></div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3" id="article-right-sidebar">
                <ul id="Citation-article">
                    <li><h6>Paper citations</h6></li>
                    @foreach($resource_cite as $res)
                        <li style="padding:0;">
                            @if( isset($res['citation'] ))
                                <span style="color:#4dc0b5">[{{$loop->index +1 }}]</span>
                                <a href="{{ route('usr.get.journal.article' , [$res['citation'] ])  }}" target="_blank"><i class="fa fa-circle">{{ $res['resource'] }}</i></a>
                            @else
                                {{--<span class="alert alert-danger" style="font-size:11px; padding:4px; margin:0">Resource {{$loop->index+1}} No citation found</span>--}}
                            @endif
                        </li>
                    @endforeach
                </ul>
                <hr>
                <ul id="Reference-article">
                    <li><h6>Paper References ({{count($resource)}})</h6></li>
                    @foreach($resource as $res)
                        <li>
                            <a href="#"><i class="fa fa-circle"></i>{{$res}}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function scrollTarget(e){
            let target = $(e).attr("href");
            target = target.substr(1,target.length);
            $('html, body').animate({
                scrollTop: $("#"+target).offset().top
            }, 500);
        }
        $(document).ready(function(){
            $(".context").trigger("click");
        });
        $(".context").click(function(){
            let context_list =  $("#context_list");
            let context = $(".context");
            let status = context_list.css('display');
            if(status == "none"){
                context.removeClass("fa-arrow-right");
                context.addClass("fa-arrow-down");
                context.css("color","#00aeef");
                $("#context_list").show("fast");
            }else{
                context.removeClass("fa-arrow-down");
                context.addClass("fa-arrow-right");
                context.css("color","tomato");
                $("#context_list").hide("fast");
            }
        });
        function toggleContext(e,target){
            if($(e).hasClass('fa-caret-down')){
                $(e).removeClass("fa-caret-down");
                $(e).addClass("fa-caret-up");
                $("#"+target).hide("fast");
            }else{
                $(e).removeClass("fa-caret-up");
                $(e).addClass("fa-caret-down");
                $("#"+target).show("fast");
            }
        }
    </script>
@endsection