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
                            کاربر نشریه جدید
                            <span class="fa fa-plus" style="vertical-align: middle"></span>
                        </h4>
                        <div class="col-sm-11" style="margin:0 auto;">
                            @include('message.errors')
                            @csrf
                            <form action="{{ route('admin.publication.new.user.store') }}" method="post" class="form-horizontal" id="" novalidate>
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="name"><i class="text-danger star_field">*</i>نام نشریه :</label>
                                        <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Enter publication name" required value="{{ old('name') }}"/>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="website"><i class="text-danger star_field">*</i>وب سایت نشریه :</label>
                                        <input type="text" name="website" id="website" class="form-control rounded-0" placeholder="Enter publication website" required value="{{ old('website') }}"/>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="ISSN"><i class="text-danger star_field">*</i>ISSN :</label>
                                        <input type="text" name="ISSN" id="ISSN" class="form-control rounded-0" placeholder="ISSN" required value="{{ old('ISSN') }}"/>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="email"><i class="text-danger star_field">*</i>پست الکترونیکی نشریه :</label>
                                        <input type="text" name="email" id="email" class="form-control rounded-0" placeholder="Enter email address" required value="{{ old('email') }}"/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="password"><i class="text-danger star_field">*</i>رمزعبور :</label>
                                        <input type="password" name="password" id="password" class="form-control fa_input" placeholder="Enter password at least 6 character" required value=""/>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password"><i class="text-danger star_field">*</i>تاییدیه رمزعبور :</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control fa_input" placeholder="Enter confirm password" required value=""/>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="captcha"><i class="text-danger star_field">*</i>Captcha Code :</label>
                                        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security key">
                                        @captcha
                                    </div>
                                </div>
                                <div class="tal">
                                    <button type="submit" class="tac btn btn-success">ثبت نام</button>
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