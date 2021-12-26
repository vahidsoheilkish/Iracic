@extends('admin.master')
@section('styles')
    <style>
        #tbl_articles th,td{  text-align: center;  }
        #tbl_articles td{  font-size: 14px; }
        #tbl_articles th{  font-size: 14px; }
        .icon_plus{color:#ff394f;}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .volumes_row{display: none;}
        .red{color:#ff394f}
        .green{color: #0ac282}
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer}
        .remove_icon{position: relative; left:3px;}
        .setting_text{text-align: left;}
        .issue_remove{color:#ff394f}
        .issue_remove:hover{color:darkorange; transition: .3s}
        .add_article_icon{vertical-align: -13px; color: rgba(27, 152, 9, 0.98);}
        .add_article_icon:hover{color: #c8c100; transition: .3s;}
        .issue_edit_icon{vertical-align:-1px}
        .issue_edit_icon:hover{}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        .active_publication{font-size:12px; font-family: Arial; font-weight: bolder; vertical-align: 8px; }
        .active_publication:hover{cursor: pointer; color:#222 !important; background: #f1c40f !important; }
        #article_view{vertical-align: 3px; color:#007bff; }
        #article_view:hover{cursor: pointer; color:#646464; transition: .3s }
        .article_image{width:150px; border-radius:10px;margin:10px;}
        .article_file_container{margin:8px auto; background-color: #f1f1f1; border-radius:10px; padding:10px; }
        #progressbar{ position: absolute; top:80%; left:43%; display: none; }
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <div class="col-sm-4">
                            <h2 class="alert alert-primary tac">مقاله های کنفرانس
                            </h2>
                        </div>
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 tal">
                            <a href="{{ route('admin.conference.create.article' , ['group'=>$volume->conference->group_id , 'major'=>$volume->conference->major_id, 'volume'=>$volume->_id]) }}" class="btn btn-danger btn-sm">ثبت مقاله در این دوره</a>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-11">
                            <table id="tbl_articles" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>چکیده</th>
                                    <th>else</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($articles as $article)
                                    <tr>
                                        <?php
                                            $abstract = json_decode($article->abstract);
                                        ?>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->title }}</td>
                                        {{--<td>{{ $article->abstract }}</td>--}}
                                        <td>...</td>
                                        <td>
                                            <span id="article_view" data-toggle="modal" data-target="#articleInfo" article-id="{{$article->id}}" onclick="getArticle(this)" class="fa fa-2x fa-eye setting_icon"></span>
                                            <a href="{{ route('conference.article.edit',['article'=>$article->id]) }}">
                                                <span class="fa fa-2x fa-edit issue_edit_icon setting_icon"></span>
                                            </a>
                                            <form action="{{ route('conference.article.remove',['article'=>$article->id]) }}" method="post" class="form_remove" style="display: inline-flex;">
                                                @csrf
                                                <button class="btn_a" type="submit">
                                                    <span class="fa fa-2x fa-remove issue_remove setting_icon"></span>
                                                </button>
                                            </form>
                                            @if($article->active == 0)
                                                <span class="label label-danger active_publication" conference-id="{{ $article->volume->conference->id }}" article-id="{{$article->id}}" onclick="changeActive(this)">Inactive</span>
                                            @else
                                                <span class="label label-success active_publication" conference-id="{{ $article->volume->conference->id }}" article-id="{{$article->id}}" onclick="changeActive(this)">active</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
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
                                <span class="label label-primary" style="margin:4px;">Abstract: </span>
                                <span id="article_abstract_en"></span>
                            </div>
                        </div><hr/>
                        <div class="row" style="margin:30px;">
                            <div class="col-sm-12">
                                <table class="table table-responsive table-borderless" id="article_authors_tbl" >
                                    <tr>
                                        <th class="tac">Name</th>
                                        <th class="tac">Email</th>
                                        <th class="tac">Rate</th>
                                        <th class="tac">Dependency</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <h2>Structs</h2>
                        <div class="" id="article_structs">

                        </div><hr/>
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
    <img id="progressbar" src="/img/admin/progressbar.gif" />
@endsection


@section('scripts')
    <script>
        $(".form_remove").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف مقاله اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: "input",
                html: true
            })
                .then((value) => {
                    if(value=="delete"){
                        form.submit();
                    }else if(value==""){
                        swal("جهت حذف باید عبارت delete را وارد کنید");
                        return false;
                    }else{
                        swal("عبارت delete وارد نشده است!");
                        return false;
                    }
                });
        });

        function changeActive(event){
            swal({
                title: "توجه",
                text: "آیا نسبت به فعال/غیرفعال کردن مقاله اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willUpdate) => {
                    if (willUpdate) {
                        $("#tbl_articles").css('display','none');
                        $("#progressbar").css('display','block');
                        $.ajax({
                            'url' : '/admin/conference/article/edit/active/' + $(event).attr('conference-id')  + '/' + $(event).attr('article-id') ,
                            'type' : 'POST' ,
                            'data' : {'_token' : '{{ csrf_token() }}'} ,
                            'dataType' : 'json' ,
                            'success' : function(data){
                                switch(data.message){
                                    case 'success_active' :
                                        $(event).removeClass('label-danger');
                                        $(event).addClass('label-success');
                                        $(event).html("Active");
                                        break;

                                    case 'success_deactive' :
                                        $(event).removeClass('label-success');
                                        $(event).addClass('label-danger');
                                        $(event).html("Inactive");
                                    break;
                                    case 'fail':
                                        swal({
                                            title: "خطا",
                                            text: "هنوز کنفرانس فعال نشده است، ابتدا نشریه را فعال کنید",
                                            icon: "warning",
                                        });
                                    break;

                                }
                                $("#tbl_articles").css('display','inline-table');
                                $("#progressbar").css('display','none');
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
                url : '/admin/conference/get/article/' + article_id ,
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
                    $("#article_abstract_en").html(data.abstract);
                    $.each(authors, function(key,val){
                        $("#article_authors_tbl").append('<tr>' +
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
    </script>
@endsection