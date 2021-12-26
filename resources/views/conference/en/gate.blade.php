@extends('user.master')
@section('styles')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 order-sm-first order-lg-first col-lg-4">
                <div class="card card-login mt-5">
                    <div class="card-header text-white">
                        <h5 class="text-center">
                            Login to conference panel
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('message.en.errors')
                        <form action="{{ route('conference.notice.login') }}" method="post" novalidate>
                            @csrf
                            <h4 class="text-left text-info border-bottom pb-3">Login Form</h4>
                            <div class="form-group">
                                <label for="email" style="margin:6px;">Email</label>
                                <input type="text" name="email" id="email" class="form-control" required placeholder="Enter your email address" value="{{ old('email') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="password" style="margin:6px;">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Please enter your password" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="captcha">Security key</label>
                                <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security key">
                                @captcha
                            </div>
                            <div class="form-group tal">
                                <button type="submit" class="btn btn-info">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 order-sm-last order-lg-last col-lg-8">
                <div class="card card-Description mt-5">
                    <div class="card-header text-white">
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
                        <a href="{{ route('conference.notice.registerForm') }}"><button class="btn mx-auto d-block rounded-0 text-white">Register</button></a>
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