@extends('admin.master')
@section('styles')
    <style>
        #all_blog_tbl th,td{  text-align: center;  }
        #all_blog_tbl td{  font-size: 14px; }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer}
        .form_remove{vertical-align: middle; display: inline;}
        .form_remove:hover{}
        .active_publication{font-size:12px; font-family: Arial; font-weight: bolder; }
        .active_publication:hover{cursor: pointer; color:#222 !important; background: #f1c40f !important; }
        .remove_icon{position: relative; left:3px;}
        .edit_icon{line-height: 17px;}
        .submenu_option{background-color: #fff; box-shadow:0px 0px 5px #222222; padding:4px; list-style: none; position:absolute; display: none; border-radius: 4px; margin-right: -33px !important;min-width: 160px;}
        .submenu_option li {cursor:pointer; color:#222222; padding:4px 5px;text-align: right; font-size:13px;}
        .submenu_option li:hover { text-align: right; background-color: #993365; color:#fff;}
        .submenu_option a { text-decoration: none; color:#222;}
        .setting_icon{vertical-align: middle; margin:3px; min-width:20px; float:right;}
        .setting_text{text-align: left;}
        #btn_setting{font-size:12px; line-height: normal;}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        #publication_title{ padding:5px; color:#ff0f30; text-align: right; direction: rtl; font-weight:bolder }
        #publication_header{ padding:5px;  text-align: right; direction: rtl;  font-size:13px;}
        .icon_plus{color:#ff394f;}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .volumes_row{display: none;}
        .red{color:#ff394f}
        .green{color: #0ac282}
        .volume_remove{color:#ff394f}
        .volume_remove:hover{color:darkorange; transition: .3s}
        .volume_edit{vertical-align: -9px;}
        .volume_edit:hover{color:darkcyan; transition: .3s}
        .add_issue{color:forestgreen; vertical-align: middle;  margin: 0 4px;}
        .add_issue:hover{cursor: pointer; color: #c4b400; transition: .3s}
        .img_blog{height:250px;}

    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row" style="margin:20px 0;">
                        <div class="col-sm-6 tal">
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">
                            <span class="fa fa-plus vertical_middle"></span>
                                پست جدید
                            </a>
                        </div>
                        <div class="col-sm-6 tar">
                            <h2>لیست نشریات</h2>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="all_blog_tbl" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>تگ ها</th>
                                    <th>تصویر شاخص</th>
                                    <th>تعداد بازدید</th>
                                    <th>تاریخ ایجاد</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($posts as $post)
                                    <tr>
                                        @php( $loop_index = $loop->index + 1 )
                                        @php( $tags = json_encode($post->tags) )
                                        <td>{{ $loop_index }}</td>
                                        <td>{{ $post->title }}</td>
                                        <td><button data-toggle="modal" data-target="#blogBody" post-body="{{$post->body}}" onclick="viewBody(this)" class="btn btn-sm btn-info">مشاهده متن</button></td>
                                        <td><button data-toggle="modal" data-target="#blogTag" post-tags="@foreach($post->categories as $tag) @if(!$loop->last) {{ $tag->name." , " }} @else {{$tag->name}}  @endif  @endforeach" onclick="viewTag(this)"  class="btn btn-sm btn-warning">مشاهده تگ ها</button></td>
                                        <td><img class="img_blog" src="{{ '/upload/post/'.$post->imgUrl }}"/></td>
                                        <td>{{ $post->viewCount }}</td>
                                        <td>{{ $post->created_at }}</td>
                                        <td>
                                            <div style="display: inline-flex">
                                                <a href="{{ route('admin.blog.edit', ['post'=>$post->id]) }}"><span class="fa fa-2x fa-edit btn_a volume_edit" style="margin:0 4px; position: relative; top:2px"></span></a>
                                                <form class="post_delete" action="{{ route('admin.blog.delete' , ['post'=>$post->id] ) }}" method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn_a" type="submit"><span class="fa fa-2x fa-remove volume_remove" style="margin:0 4px;"></span></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tac" style="margin:30px auto;">
                            {!! $posts->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>

    <!-- modals -->
    <!-- The Blog Body Modal -->
    <div class="modal fade" id="blogBody" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ltr">
                </div>
                <div class="modal-body ltr">
                    <p id="post_body"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- The Blog Tags Modal -->
    <div class="modal fade" id="blogTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ltr">
                </div>
                <div class="modal-body ltr">
                    <p id="post_tags"></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function viewBody(e){
            let post_body = $(e).attr('post-body');
            $("#post_body").html(post_body);
        }
        function viewTag(e){
            let post_tags = $(e).attr('post-tags');
            $("#post_tags").html(post_tags);
        }

        $(".post_delete").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف پست  نشریه اطمینان دارید ؟",
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
    </script>
@endsection