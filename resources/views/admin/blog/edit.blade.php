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
        .img_blog{height:250px; border-radius: 10px; box-shadow: 0 0 6px #ccc;}
        .select2-selection__choice{color:#222 !important;}
        .select2-selection__choice__remove{color:#ff0f30 !important;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <div class="form-group row" style="border-bottom:1px solid #222;">
                            <h6> ویرایش پست <span style="color:#ff0f30">{{ $post->title }}</span></h6>
                        </div>
                        <hr/>
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            @include('message.errors')
                            <form action="{{ route('admin.blog.update' , ['post'=>$post->id]) }}" method="post" novalidate>
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input id="title" type="text" class="form-control" name="title" required value="{{ $post->title }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="body">متن</label>
                                    <textarea id="body" name="body" class="form-control" required>{{ $post->body }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tags">تگ ها</label>
                                    <select id="tags" name="tags[]" class="form-control" multiple>
                                        @foreach($cats as $cat)
                                            <option value="{{$cat->id}}" {{ in_array($cat->id , $post->categories()->pluck('id')->toArray()) ? 'selected=selected' : '' }} >{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="tac" style="margin:40px 0;">
                                    <img class="img_blog" src="{{ '/upload/post/'.$post->imgUrl }}"/>
                                </div>
                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-warning">ویرایش پست</button>
                                </div>
                            </form>
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
                <div class="modal-header rtl">
                </div>
                <div class="modal-body rtl">
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        CKEDITOR.replace( 'body' );
        $("#tags").select2();
    </script>
@endsection