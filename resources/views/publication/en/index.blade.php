@extends('user/master')
@section('style')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 order-sm-first order-lg-first col-lg-4">
                <div class="card card-login mt-5">
                    <div class="card-header text-white" style="background-color: #e4606d">
                        <h5 class="text-center">
                            Login to the publication panel
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('message/success')
                        @include('message.en.errors')
                        @include('message/fail')
                        <form action="{{ route('publication.login') }}" method="post" class="form-horizontal" id="publication_login_container" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-control rounded-0" required placeholder="Enter your email here" value="{{ old('email') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" name="password" id="password" class="form-control rounded-0" required placeholder="Enter your password here" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="captcha">Security key:</label>
                                <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Input security code here" style="margin:6px 0;">
                                @captcha
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn mx-auto d-block rounded-0 text-white" style="background-color: #e4606d">LogIn</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 order-sm-last order-lg-last col-lg-8">
                <div class="card card-Description mt-5">
                    <div class="card-header text-white" style="background-color: #e4606d">
                        <h5 class="text-center">Description</h5>
                    </div>
                    <div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas purus viverra</p>
                        <ul>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing eli</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing eli</li>
                        </ul>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Egestas purus viverra
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('publication.registerForm') }}" class="btn mx-auto d-block rounded-0 text-white" style="background-color: #e4606d">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
    </script>
@endsection