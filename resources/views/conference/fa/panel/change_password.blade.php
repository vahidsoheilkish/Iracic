@extends('conference.fa.panel.master')

@section('user')
@endsection

@section('content')
    <div class="row" style="margin:auto">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h4 class="tar">تغییر رمز عبور</h4>
            <hr/>
            <form action="{{ route('conference.notice.change.pass.fa') }}" method="post" class="tar">
                @include('message.errors')
                @csrf
                {{ method_field('PATCH')}}
                <div class="form-group">
                    <label for="old_password">رمز قبلی</label>
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
                    <button type="submit" class="btn btn-success">تغییر رمز عبور</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_change_password')").removeClass('active');
        });
    </script>
@endsection