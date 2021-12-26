@extends('admin.master')
@section('styles')
    <style>
        #all_conference_user_tbl th,td{  text-align: center; overflow-y: scroll; margin:0; padding:10px 4px !important; vertical-align: middle;w }
        #all_conference_user_tbl td{ font-size:13px;  }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer; box-shadow: 0 0 10px #ddd; border-radius: 8px; transition: all .3s;}
        .form_remove{vertical-align: -2px; display: inline;}
        .form_remove:hover{}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
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
                            <a href="{{ route('admin.conference.new.user') }}" class="btn btn-primary">
                                <span class="fa fa-plus" style="vertical-align: middle;"></span>
                                کاربر کنفرانس جدید
                            </a>
                        </div>
                        <div class="col-sm-6 tar">
                            <h2>لیست کاربران نشریه</h2>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="all_conference_user_tbl" class="table table-bordered">
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th>کدملی</th>
                                    <th>شماره تماس</th>
                                    <th style="color:tomato;">ویرایش کنفرانس</th>
                                    <th style="color:tomato;">ثبت کنفرانس</th>
                                </tr>
                                @foreach($conference_users as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1  }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->lastname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->codemeli }}</td>
                                        <td>{{ $user->tell }}</td>
                                        <td>
                                            {{--<form action="{{ route('admin.conference.users.remove' , ['conferenceUser'=>$user->id]) }}" method="post" class="form_remove">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--<button type="submit" class="btn_a" id="publication_remove"><i class="fa fa-2x fa-remove" style="color:#ff0f30; vertical-align:middle"></i></button>--}}
                                            {{--</form>--}}
                                            <a href="{{ route('admin.conference.users.edit' , ['conferenceUser'=>$user->id]) }}"><i class="fa fa-2x fa-edit" style="color:#00aced; vertical-align:-10px;"></i></a>
                                        </td>
                                        <td>
                                            @if(isset($user->conference->_id))
                                                <p class="alert alert-danger">کنفرانس قبلا ثبت شده است</p>
                                            @else
                                                <a href="{{ route('admin.create.conference' , ['user'=>$user->id] ) }}" class="btn btn-warning btn-sm">ثبت کنفرانس</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="tac" style="margin:30px auto;">
                            {!! $conference_users->render() !!}
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
        $(".form_remove").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف کاربر کنفرانس اطمینان دارید ؟",
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