@extends('user/master')

@section('styles')
    <style>
        #login_container{margin:20px; border-radius:10px; box-shadow:0 0 13px #ccc;}
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8 col-sm-offset-2">
            <div id="login_container" class="card">
                <div class="card-body">
                    <form action="/login" method="post" class="w-100">
                        @csrf
                        @include('message.errors')
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" required placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required placeholder="Enter your password">
                        </div><br>
                        <div class="form-group">
                            <label for="captcha">Security key</label>
                            <input type="text" id="captcha" name="captcha" class="form-control" required placeholder="Enter security key" style="margin:6px 0;">
                            @captcha
                        </div>
                        <button type="submit" class="btn modalbTn">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
