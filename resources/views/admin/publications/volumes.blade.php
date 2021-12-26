@extends('admin.master')
@section('styles')
    <style>
        #all_publications_tbl th,td{  text-align: center;  }
        #all_publications_tbl td{  font-size: 14px; }
        .active_publication{font-size:12px; font-family: Arial; font-weight: bolder; }
        .active_publication:hover{cursor: pointer; color:#222 !important; background: #f1c40f !important; }
        #tbl_volumes{border:1px solid #ccc; border-radius:10px;}
        #tbl_volumes td,th{padding:4px !important; margin:0 !important; }
        #tbl_volumes tr:nth-child(odd){background-color: #f9f9f9;}
        #tbl_volumes tr:nth-child(even){background-color: #f9f9f9;}
        .icon_plus{color:#ff394f;}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .green{color: #0ac282}
        .article_image{width:250px;}
        #article_info_container{border:1px solid #222; direction:ltr; padding:10px; border-radius:8px;}
        .author_span{ font-size:13px; color: #008cc2; }
        .left_line{ border-right:1px solid #222; margin:4px; }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        .issue_remove{color:#ff394f}
        .issue_remove:hover{color:darkorange; transition: .3s}
        .no_issue{text-align:center; border:1px solid tomato; color:tomato; font-weight:bolder}
        .issues_container{border:1px solid #ccc; margin-bottom:10px; border-radius:4px;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <div class="col-sm-12">
                            <table id="all_publications_tbl" class="table table-bordered table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>گروه</th>
                                    <th>رشته</th>
                                    <th>کاربر نشریه</th>
                                    <th>عنوان</th>
                                    <th>PrintISSN</th>
                                    <th>OnlineISSN</th>
                                    <th>وابستگی نشریه</th>
                                    <th>DOI</th>
                                    <th>فعال</th>
                                </tr>
                                <tr>
                                    <td>{{ $publication->id }}</td>
                                    <td>{{ $publication->group_id }}</td>
                                    <td>{{ $publication->major_id }}</td>
                                    <td>{{ $publication->publication_user->name }}</td>
                                    <td>
                                        {{ $publication->title }}
                                    </td>
                                    <td>{{ $publication->printISSN }}</td>
                                    <td>{{ $publication->onlineISSN }}</td>
                                    <td>{{ $publication->dependency }}</td>
                                    <td>{{ $publication->DOI }}</td>
                                    <td>
                                        @if($publication->active == 0)
                                            <span class="label label-danger active_publication" publication-id="{{$publication->id}}" onclick="changeActive(this)">Inactive</span>
                                        @else
                                            <span class="label label-success active_publication" publication-id="{{$publication->id}}" onclick="changeActive(this)">active</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-2">
                            <h5 class="tac">دوره های نشریه</h5><hr/>
                            @if(  $publication->volumes()->exists()  )
                                @foreach($publication->volumes as $key=>$volume)
                                    <table id="tbl_volumes" class="table table-responsive table-borderless">
                                        <tr>
                                            <td><span style="font-size:0px;">{{ $volume->id }}</span></td>
                                            <td><span>({{ $volume->year }})</span></td>
                                            <td><span class="fa fa-plus icon_plus green" onclick="displayIssues(this , {{ ($key +1) }})"></span></td>
                                        </tr>
                                    </table>
                                    @if(  $volume->issues()->exists()  )
                                        <div class="issues_container" id="issue_{{($key+1)}}" style="display:none;">
                                            @foreach($volume->issues as $issue)
                                                    <div style="margin:8px;">
                                                        <span class="fa fa-book" style="margin:0 4px; vertical-align: middle"></span>
                                                        <button class="btn btn-primary btn-sm" onclick="getIssue(this)" issue-id="{{$issue->id}}">شماره {{ $loop->index+1 }}</button>
                                                    </div>
                                                    <span style="padding:4px; font-size:13px;"> ماه {{ $issue->month }}</span><span style="padding:4px; font-size:13px;">صفحه {{$issue->pages_number}}</span>
                                                    @if(!$loop->last)
                                                        <hr/>
                                                    @endif
                                            @endforeach
                                        </div>
                                        @else
                                        <div id="issue_{{($key+1)}}" style="display:none;">
                                            <p class="no_issue">no issue</p>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div id="article_info_container" class="col-sm-9">
                            <div class="row">
                                <div id="authors_names" class="col-sm-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>


    <!-- The Article Information -->
    <div class="modal fade" id="articleInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 1000px">
            <div class="modal-content" style="width:1000px;">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding:15px;  direction:ltr;">
                        <h3 id="article_title"></h3>
                        <div class="row">
                            <div class="col-sm-4 tac">
                                <span class="label label-primary" style="margin:4px;">DOI: </span>
                                <span id="article_DOI"></span>
                            </div>
                            <div class="col-sm-4 tac">
                                <span class="label label-primary" style="margin:4px;">IOI: </span>
                                <span id="article_IOI"></span>
                            </div>
                            <div class="col-sm-4 tac">
                                <span class="label label-primary" style="margin:4px;">ID: </span>
                                <span id="article_id"></span>
                            </div>
                        </div>
                        <hr/>
                        <div class="row" style="margin:24px;">
                            <div class="col-sm-12 tal">
                                <span class="label label-primary" style="margin:4px;">Highlight: </span>
                                <span id="article_highlight"></span>
                            </div>
                        </div><hr/>
                        <div class="row">
                            <div class="col-sm-12 tac">
                                <span class="label label-primary" style="margin:4px;">abstract: </span>
                                <span id="article_abstract"></span>
                            </div>
                        </div><hr/>
                        <div class="row" style="margin:30px;">
                            <div class="col-sm-12">
                                <table class="table table-responsive table-borderless" id="article_authors_tbl" >
                                </table>
                            </div>
                        </div>
                        <h2>Structs</h2>
                        <div class="" id="article_structs">

                        </div>
                        <div class="row" style="margin:20px 0;">
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Page Count: </span>
                                <span id="article_pageCount"></span>
                            </div>
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Page: </span>
                                <span id="article_page"></span>
                            </div>
                        </div><hr/>
                        <div class="row" style="margin:20px 0;">
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Publication Link: </span>
                                <span id="article_publication_link" style="font-size:12px;"></span>
                            </div>
                            <div class="col-sm-6 tac">
                                <span class="label label-primary" style="margin:4px;">Keywords: </span>
                                <span id="article_keyword"></span>
                            </div>
                        </div><hr/>
                        <div id="article_resources" class="col-sm-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $("#article_info_container").hide("fast");
        });

        function getIssue(event){
            $("#article_info_container").show("slow");
            $("#article_resources").empty();
            $("#article_authors_tbl").empty();
            $("#article_structs").empty();
            let issue_id = $(event).attr("issue-id");
            $.ajax({
                // lol_haha
                url : '/get/issue/' + issue_id ,
                type : 'post' ,
                data : { '_token':'{{csrf_token()}}'  } ,
                success(data){
                    $("#article_info_container").empty();
                    if( Object.entries(data).length === 0 ){
                        $("#article_info_container").append('<h5 style="color:tomato; text-align:center; margin:30px;">مقاله ای در این شماره وجود ندارد</h5>');
                        return;
                    }
                    let _token = $("#_token").val();
                    $.each(data,(key,article)=>{
                        $("#article_info_container").append('' +
                            '<div class="row" style="margin:10px;">\n' +
                            '                                <div class="col-sm-1 tac">\n' +
                            '                                    <span>'+ (key + 1) +'</span>\n' +
                            '                                </div>\n' +
                            '                                <div class="col-sm-8 tal">\n' +
                            '                                    <span>'+ article.title +'</span>\n' +
                            '                                </div>\n' +
                            '                                <div class="col-sm-3 tar">\n' +
                            '                                    <button data-toggle="modal" data-target="#articleInfo" article-id="'+ article._id +'" onclick="getArticle(this)" class="btn btn-sm btn-info">view article</button> ' +
                            '                                 <form action="/admin/publication/remove/article/'+ article._id +'" method="post" onclick="submitRemove(this)" style="display: inline-flex;"> ' +
                            '                                    <input type="hidden" name="_token" value="'+ _token +'" /> '+
                            '                                    <button class="btn_a" type="button"> ' +
                            '                                    <span class="fa fa-2x fa-remove issue_remove setting_icon"></span> ' +
                            '                                    </button> ' +
                            '                                    </form> '+
                            '                               </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="row">\n' +
                            '                                <div class="col-sm-12">\n' +
                            '                                </div>\n' +
                            '                            </div>' +
                            '');
                        let authors = JSON.parse(article.authors_info);
                        $.each(authors, (k,author)=>{
                            $("#article_info_container").append('' +
                                '<span class="author_span">'
                                + author.name +'  ' +
                                '</span><span class="left_line"></span>');
                        });
                        $("#article_info_container").append('<hr/>');
                    });
                }
            });
        }

        function changeActive(event){
            swal({
                title: "توجه",
                text: "آیا نسبت به فعال/غیرفعال کردن نشریه اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willUpdate) => {
                    if (willUpdate) {
                        $.ajax({
                            'url' : '/admin/publication/edit/active/' + $(event).attr('publication-id') ,
                            'type' : 'POST' ,
                            'data' : {'_token':'{{csrf_token()}}'} ,
                            'dataType' : 'json' ,
                            'success' : function(data){
                                if(data.message == 'success'){
                                    if(data.target == 'success'){
                                        $(event).removeClass('label-danger');
                                        $(event).addClass('label-success');
                                        $(event).html("Active");
                                    }else{
                                        $(event).removeClass('label-success');
                                        $(event).addClass('label-danger');
                                        $(event).html("Inactive");
                                    }
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
        }

        function getArticle(event){
            $("#article_resources").empty();
            $("#article_authors_tbl").empty();
            $("#article_structs").empty();
            let article_id = $(event).attr("article-id");
            $.ajax({
                url : '/admin/publication/get/article/' + article_id ,
                type : 'post' ,
                data : { '_token':'{{csrf_token()}}'  } ,
                success(data){
                    let authors = JSON.parse(data.authors_info);
                    let resources = JSON.parse(data.resource);
                    let structures = JSON.parse(data.struct);
                    $("#article_id").html(data.id);
                    $("#article_IOI").html(data.IOI);
                    $("#article_DOI").html(data.DOI);
                    $("#article_highlight").html(data.highlight);
                    $("#article_abstract").html(data.abstract);
                    $.each(authors, function(key,val){
                        $("#article_authors_tbl").append('' +
                            '<tr>' +
                            '<td>'+ val.name +'</td>' +
                            '<td>'+ val.email +'</td>' +
                            '<td>'+ val.rate +'</td>' +
                            '<td>'+ val.dependency +'</td>' +
                            '</tr>');
                    });
                    $.each(structures , function(key,val){
                        $("#article_structs").append('' +
                            '<div style="height:2px; background-color:#ff0000; margin:14px;"></div>' +
                            '<ul style="margin-left: 20px;">' +
                            '<li>'+ val.str +'</li>' +
                            '</ul>'
                        );
                        if(val.substr){
                            for(let i=0; i<val.substr.length; i++) {
                                $("#article_structs").append('' +
                                    '<ul style="list-style: disc;margin-left:55px;">' +
                                    '<li style="color:#222">' + val.substr[i] + ' </li>' +
                                    '</ul>' +
                                    '');
                            }
                        }
                    });
                    $("#article_pageCount").html(data.pageCount);
                    $("#article_page").html(data.page);
                    $("#article_publication_link").html(data.publicationLink);
                    $("#article_keyword").html(data.keywords);
                    $("#article_resources").empty();
                    $.each(resources, function(key,val){
                        $("#article_resources").append('' +
                            ' <span style="color:#4dc0b5; margin:4px;">['+ parseInt(key+1) +']</span>'+ val +'<hr/>');
                    });
                }
            });
        }

        function displayIssues(e , id){
            if ( $(e).hasClass('fa-plus') ){
                $("#issue_"+id).show("fast");
                $(e).removeClass("fa-plus");
                $(e).removeClass("green");
                $(e).addClass("fa-minus");
                $(e).addClass("red");
            }else{
                $("#issue_"+id).hide("fast");
                $(e).removeClass("fa-minus");
                $(e).removeClass("red");
                $(e).addClass("fa-plus");
                $(e).addClass("green");
            }
        }

        function submitRemove(e){
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف کاربر نشریه اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: "input",
                html: true
            })
                .then((value) => {
                    if(value=="delete"){
                        e.submit();
                    }else if(value==""){
                        swal("جهت حذف باید عبارت delete را وارد کنید");
                        return false;
                    }else{
                        swal("عبارت delete وارد نشده است!");
                        return false;
                    }
                });
        }
    </script>
@endsection