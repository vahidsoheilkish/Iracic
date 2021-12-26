@extends('user_fa/master')

@section('styles')
    <style>
        .article_image{width:450px; border-radius:10px;margin:10px;}
        .resource_container{margin:5px; padding:10px;  border-bottom:2px solid #222; }
        .icons{margin:0 10px; position:relative;}
        .icons:hover{transition: .4s; cursor: pointer; opacity:.7; animation-name:top_bottom; animation-duration:1s;}
        .context{font-weight: normal; margin:0 6px; color:tomato;position: relative;font-size:24px;vertical-align:-3px;}
        .context:hover{cursor: pointer; color: #00aeef;  transition: .1s; opacity: .8;}
        #context_list{margin:6px 0; display: none; padding:0;}
        #context_list li{padding:2px 0;}
        .context_text{font-size:14px;text-align:justify;}
        .context_title{font-weight: bolder; font-stretch: expanded;padding:10px;}
        #tbl_outline a:hover{text-decoration:none;}
        .substr{padding-left:20px;}
        .substr li{text-align:justify;font-size:11px; text-align: left;box-shadow: 0 0 4px #e1e1e1;padding: 0 8px !important;margin: 6px 0 !important;}
        .sub_index{color:tomato;margin:0 8px 0 0; font-size:12px; vertical-align: middle;}
        @keyframes top_bottom { from{bottom:5px;} to{bottom:0;} }
        #pii_structs{padding:10px 0; margin:20px 0;}
        #pii_refrences{padding:10px 0; margin:20px 0;}
        #struct_label{width:30%;margin:15px; box-shadow: 0 0 8px #dddddd;}
        .red{color:tomato}
        .down_icon{float: left; margin-right:10px; vertical-align:middle; color: #659bff; font-size:20px; position: relative; top:-10px;}
        .down_icon:hover{cursor: pointer; transition: .3s; color:darkorange;}
    </style>
@endsection
@section("content")
    <hr>
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-12 col-md-3" id="structure-sidebar">
                <h5>ساختار کلی</h5><hr/>
                <ul>
                    <li><a href="#pii_abstract">چکیده</a></li>
                    <li><a href="#pii_authors">نویسندگان</a></li>
                    <li><a href="#pii_keywords">کلمات کلیدی</a></li>
                    <li><a href="#pii_structs">ساختار</a><span class="fa fa-arrow-left context"></span></li>
                    <ul id="context_list" class="list-contacts">
                        @foreach($structs as $index=>$struct)
                            <li style="font-size:13px; border-bottom:1px solid #222;">
                                <a href="#Str{{ str_limit($struct->str,4,'') }}" onclick="scrollTarget(this)">{{ $struct->str    }}</a>
                                @if( !empty($struct->substr) )
                                    <ul class="substr">
                                        @for($i=0; $i<count($struct->substr); $i++)
                                            <li style="color:#222">{{ $struct->substr[$i] }}</li>
                                        @endfor
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <li><a href="#pii_refrences">منابع</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-12 col-md-2 text-right logo">
                        {{--<img src="/img/user/logo.png" class="article-iracic-logo">--}}
                    </div>
                    <div class="col-12 col-md-5 text-center">
                        <h4><a href="inlinepage-2.html">عنوان کنفرانس</a></h4>
                        <ul id="grouping">
                            <li>دوره</li><i class="fa fa-chevron-left pr-1"></i>
                            <li>شماره</li><i class="fa fa-chevron-left pr-1"></i>
                            <li>سال/ماه</li><i class="fa fa-chevron-left pr-1"></i>
                            <li>شماره صفحه</li>
                        </ul>
                        <ul class="issn">
                            <li class="text-left">:print ISSN</li>
                            <li class="text-left">:online ISSN</li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-5 text-left">
                        <img src="/img/user/journal/journal-1.jpg" width="90px" height="100px">
                        <div class="article-social-media pt-4 pr-3">
                            <a href="{{conference_article_path.$article->files_directory.'/'.$pdf_file}}" class="badge badge-pill badge-success" style="margin:2px 0;">دانلود<i class="fa fa-file" style="margin:4px;"></i></a>
                            <span class="badge badge-pill badge-success">ایمیل<i class="fa fa-at"></i></span>
                            <span class="badge badge-pill badge-success">اشتراک گذاشتن<i class="fa fa-share-alt-square"></i></span>
                        </div>
                    </div>
                </div>
                <hr>
                <i class="fa fa-caret-down down_icon" onclick="toggleContext(this,'article-content')"></i><h5>عنوان مقاله</h5>
                <div class="row">
                    <ul id="article-content">
                        <li>نام نویسنده/نام نویسندگان:
                            @foreach($authors as $author)
                                <span class="red">{{$author->name}};</span>
                            @endforeach
                        </li>
                        <li>نام دانشگاه:
                            @foreach($authors as $author)
                                <span class="red">{{$author->dependency}};</span>
                            @endforeach
                        </li>
                        @php( $apply_date = strtotime($article->created_at) )
                        <li> تاریخ پذیرش و چاپ و ایندکس: {{ date('Y-m-d', $apply_date)  }}</li>
                        <li class="tal ltr"> IOI: {{ $article->IOI }}</li>
                        <li class="tal ltr">DOI: {{ $article->DOI }}</li>
                        <li>ناشر : {{ $article->title }} </li>
                    </ul>
                </div><hr>
                <i class="fa fa-caret-down down_icon" onclick="toggleContext(this,'abstract_content')"></i><h5 id="pii_abstract">چکیده:</h5>
                <div id="abstract_content" class="form-group">
                    <p style="text-align: justify;">{{$article->abstract}}</p>
                </div><hr/>
                <i class="fa fa-caret-down down_icon" onclick="toggleContext(this,'keywords_content')"></i><h5 id="pii_keywords">کلمات کلیدی:</h5>
                <div id="keywords_content" class="form-group">
                    @foreach($keywords as $keyword)
                        <p style="text-align: justify;">{{$keyword}}</p>
                    @endforeach
                </div><hr/>
                <i class="fa fa-caret-down down_icon" onclick="toggleContext(this,'context_content')"></i><h5 id="pii_structs">ساختار: </h5>
                <div id="context_content" class="form-group">
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
                <div class="form-group" style="margin:40px 0;">
                    <i class="fa fa-caret-down down_icon" onclick="toggleContext(this,'refrences_content')"></i><h5 id="pii_refrences">منابع: </h5>
                    <div id="refrences_content" class="form-group">
                        @foreach($resource_cite as $res)
                            <div class="col-sm-12 resource_container">
                                <span style="color:#4dc0b5;">[{{$loop->index +1}}]</span>
                                @if( isset($res['citation']) )
                                    <a href="{{ route('usr.get.journal.article',[ $res['citation'] ] ) }}" target="_blank">{{ $res['resource'] }}</a>
                                @else
                                    <span href="#">{{ $res['resource'] }}</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3" id="article-right-sidebar">
                <h5 class="tac">مقاله های مرتبط</h5>
                <ul class="tac" id="related-abstract" style="list-style:none">
                    <li>پیدا نشد</li>
                </ul><hr>
                <h5 class="tac">مقاله های مرجع</h5>
                <ul class="tac" id="reference-article" style="list-style:none;padding:0;">
                    <li>پیدا نشد</li>
                </ul><hr/>
                <h5 class="tac">استنادهای مقاله</h5>
                <ul class="tac" id="citation-article" style="list-style:none;padding:0;">
                    @foreach($resource_cite as $key=>$res)
                        @if( isset($res['citation']) )
                            <li><a href="{{ route('usr.get.journal.article',[ $res['citation'] ] ) }}" target="_blank">{{ $res['resource'] }}</a></li>
                        @else
                            <li><span style="font-size:11px;">منبع {{$key+1}} - </span>استنادی یافت نشد</li>
                        @endif
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
                context.removeClass("fa-arrow-left");
                context.addClass("fa-arrow-down");
                context.css("color","#00aeef");
                $("#context_list").show("fast");
            }else{
                context.removeClass("fa-arrow-down");
                context.addClass("fa-arrow-left");
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