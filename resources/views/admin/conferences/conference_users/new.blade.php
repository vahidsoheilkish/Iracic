@extends('admin.master')
@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h4 class="alert alert-info tac" style="margin-right:50px;">
                            کاربر کنفرانس جدید
                            <span class="fa fa-plus" style="vertical-align: middle"></span>
                        </h4>
                        <div class="col-sm-11" style="margin:0 auto;">
                            @include('message.errors')
                            @csrf
                            {{ method_field('PATCH') }}
                            <form action="{{ route('admin.conference.new.user.store') }}" method="post" style="padding: 12px;" novalidate>
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-6">
                                        <label for="name" style="margin:6px;">نام</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required value="{{ old('name') }}"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="family" style="margin:6px;">نام خانوادگی</label>
                                        <input type="text" name="family" id="family" class="form-control" placeholder="Enter family" required value="{{ old('family') }}"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="email" style="margin:6px;">پست الکترونیکی</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email address test@gmail.com" required value="{{ old('email') }}"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="codemeli" style="margin:6px;">کد ملی</label>
                                        <input type="text" name="codemeli" id="codemeli" class="form-control" placeholder="Required code meli" required value="{{ old('codemeli') }}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <label for="tell" style="margin:6px;">موبایل</label>
                                        <input type="text" name="tell" id="tell" class="form-control" placeholder="Enter phone number" required value="{{ old('tell') }}"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password" style="margin:6px;">کلمه عبور</label>
                                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required value=""/>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="password_confirmation" style="margin:6px;">تکرار کلمه عبور</label>
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password" required value=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="captcha">کد امنیتی</label>
                                        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security key">
                                        @captcha
                                    </div>
                                </div>
                                <div class="form-group tac" style="margin:12px;">
                                    <button type="submit" class="btn btn-success">ثبت نام</button>
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