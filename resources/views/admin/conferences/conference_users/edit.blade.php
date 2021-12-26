@extends('admin.master')
@section('styles')
    <style>
        #all_publications_tbl th,td{  text-align: center;  }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer; box-shadow: 0 0 10px #ddd; border-radius: 8px; transition: all .3s;}
        .form_remove{vertical-align: -2px; display: inline;}
        .form_remove:hover{}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h4 class="alert alert-info tac" style="margin-right:50px;">ویرایش کاربر کنفرانس {{$conferenceUser->name}}</h4>
                        <div class="col-sm-11" style="margin:0 auto;">
                            @include('message.errors')
                            <form action="{{ route('admin.conference.users.update' , ['conferenceUser'=>$conferenceUser->id]) }}" method="post" class="form-horizontal">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-group">
                                    <label for="name" style="margin:6px;">نام</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="نام نشریه را وارد کنید" required value="{{ $conferenceUser->name }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" style="margin:6px;">نام خانوادگی</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="نام خانوادگی را وارد کنید" required value="{{ $conferenceUser->lastname }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="email" style="margin:6px;">آدرس پست الکترونیکی</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="test@gmail.ir آدرس پست الکترونیکی" required value="{{ $conferenceUser->email }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="codemeli" style="margin:6px;">کد ملی</label>
                                    <input type="text" name="codemeli" id="codemeli" class="form-control" placeholder="کد ملی" required value="{{ $conferenceUser->codemeli }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="tell" style="margin:6px;">شماره تماس</label>
                                    <input type="text" name="tell" id="tell" class="form-control" placeholder="شماره تماس" required value="{{ $conferenceUser->tell }}"/>
                                </div>
                                <hr/>
                                <div class="form-group tal" style="margin:4px;">
                                    <input type="submit" value="ویرایش اطلاعات کاربر کنفرانس" class="btn btn-primary"/>
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
@endsection

@section('scripts')
    <script>
    </script>
@endsection