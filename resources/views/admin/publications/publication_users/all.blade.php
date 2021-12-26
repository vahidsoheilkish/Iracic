@extends('admin.master')
@section('styles')
    <style>
        #all_publication_user_tbl th,td{  text-align: center; overflow-y: scroll; margin:0; padding:10px 4px !important; vertical-align: middle; }
        #all_publication_user_tbl td{ font-size:13px;  }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer; box-shadow: 0 0 10px #ddd; border-radius: 8px; transition: all .3s;}
        .form_remove{vertical-align: -2px; display: inline;}
        .form_remove:hover{}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: ltr}
        .swal-text{direction: ltr}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ route('admin.publication.new.user') }}" class="btn btn-primary">
                                <span class="fa fa-plus" style="vertical-align: middle;"></span>
                                کاربر نشریه جدید
                            </a>
                        </div>
                        <div class="col-sm-6 tar">
                            <h2>لیست کاربران نشریه</h2>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="all_publication_user_tbl" class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>وب سایت</th>
                                    <th>ISSN</th>
                                    <th style="color:tomato;">ویرایش</th>
                                    <th style="color:tomato;">ثبت نشریه</th>
                                </tr>
                                @foreach($publication_users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td><button class="btn btn-sm btn-outline-success" data-web="{{$user->website}}" onclick="webLink(this)">لینک وب سایت</button></td>
                                        <td>{{ $user->ISSN }}</td>
                                        <td>
                                            {{--<form action="{{ route('admin.publication.users.remove' , ['publicationUser'=>$user->id]) }}" method="post" class="form_remove">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<button type="submit" class="btn_a" id="publication_remove"><i class="fa fa-2x fa-remove" style="color:#ff0f30; vertical-align:middle"></i></button>--}}
                                            {{--</form>--}}
                                            <a href="{{ route('admin.publication.users.edit' , ['publicationUser'=>$user->id]) }}" id="publication_edit" style="vertical-align:middle;"><i class="fa fa-2x fa-edit" style="color:#00aced; vertical-align:-10px;"></i></a>
                                        </td>
                                        <td>
                                            @if(!isset($user->publication->id))
                                                <a href="{{ route('admin.publication.new.publication' ,['user'=>$user->id]) }}" class="btn btn-warning btn-sm" style="vertical-align:middle;">ثبت نشریه</a>
                                            @else
                                                <span class="alert alert-danger" style="padding:2px;">نشریه قبلا ثبت شده است</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tac" style="margin:30px auto;">
                            {!! $publication_users->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function webLink(event){
            swal($(event).attr('data-web'));
        }
        $(".form_remove").submit(function(e){
            let form = this;
            e.preventDefault();
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