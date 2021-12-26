@extends('publication.en.dashboard.master')

@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8" style="padding:30px; margin:20px auto !important; border-radius:10px; box-shadow:0 0 5px #000">
                <h3 class="tal" style="color:tomato;">Change password</h3>
                <hr/>
                @include('message.en.errors')
                <form action="{{ route('publication.change.password') }}" method="post" class="form-horizontal" id="" novalidate>
                    @csrf
                    {{ method_field('PATCH')}}
                    <div class="form-group">
                        <label for="old_password">Old password</label>
                        <input type="password" id="old_password" name="old_password" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="password">New password</label>
                        <input type="password" id="password" name="password" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="password2">Confirm new password</label>
                        <input type="password" id="password2" name="password2" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="captcha">Security key</label>
                        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security key">
                        @captcha
                    </div>
                    <div class="form-group" style="text-align: left">
                        <button type="submit" class="btn btn-success">Change it!</button>
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