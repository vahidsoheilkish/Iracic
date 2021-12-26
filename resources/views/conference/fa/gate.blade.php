@extends('user_fa.master')
@section('styles')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 order-sm-first order-lg-first col-lg-4">
                <div class="card card-login mt-5">
                    <div class="card-header text-white">
                        <h5 class="text-center">
                            ورود به پنل ثبت کنفرانس
                        </h5>
                    </div>
                    <div class="card-body">
                        @include('message.errors')
                        <form action="{{ route('conference.notice.login.fa') }}" method="post" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="email" style="margin:6px;">پست الکترونیکی</label>
                                <input type="text" name="email" id="email" class="form-control" required placeholder="Enter your email address" value="{{ old('email') }}"/>
                            </div>
                            <div class="form-group">
                                <label for="password" style="margin:6px;">رمز عبور</label>
                                <input type="password" name="password" id="password" class="form-control" required placeholder="Please enter your password" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="captcha">کد امنیتی</label>
                                <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security key">
                                @captcha
                            </div>
                            <div class="form-group tac">
                                <button type="submit" class="btn btn-info">ورود</button>
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
                        <p>این  سامانه جهت ثبت همایش ها و ارائه خدمات به آن ها راه اندازی گردیده و پس از ثبت و ارسال مدارک ، همایش درخواستی در یکی از سه گروه زیر تقسیم بندی می گردد: </p>
                        <ul>
                            <li>همایش های تحت حمایت مرکز منطقه ای اطلاع رسانی علوم و فناوری (RICEST)</li>
                            <li>همایش های تحت حمایت پایگاه استنادی علوم جهان اسلام (ISC)</li>
                        </ul>
                        <p>
                            جهت درخواست ثبت همایش می بایست در سیستم ثبت نام نمایید ! پس از ثبت نام سیستم یک ایمیل حاوی لینک فعال سازی برای شما ارسال می کند ، لطفا بر روی لینک فعال سازی کلیک نمایید تا بتوانید وارد پنل ثبت همایش شوید!
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <a href="{{ route('conference.notice.registerForm.fa') }}"><button class="btn mx-auto d-block rounded-0 text-white">ثبت نام کنید</button></a>
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