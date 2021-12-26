@extends('publication.fa.dashboard.master')

@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8" style="padding:30px; margin:20px auto !important; border-radius:10px; box-shadow:0 0 5px #000">
                <h3 class="tar" style="color:tomato;">تغییر رمز عبور</h3>
                <hr/>
                @include('message.errors')
                <form action="{{ route('publication.change.password.fa') }}" method="post" class="form-horizontal tar ltr" id="" novalidate>
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="form-group">
                        <label for="old_password">رمز عبور قبلی</label>
                        <input type="password" id="old_password" name="old_password" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="password">رمز جدید</label>
                        <input type="password" id="password" name="password" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="password2">تکرار رمز جدید</label>
                        <input type="password" id="password2" name="password2" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="captcha">کد امنیتی</label>
                        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security key">
                        @captcha
                    </div>
                    <div class="form-group" style="text-align: left">
                        <button type="submit" class="btn btn-success">تغییر رمز</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p id="result"></p>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_change_password')").removeClass('active');
        });
    </script>
@endsection