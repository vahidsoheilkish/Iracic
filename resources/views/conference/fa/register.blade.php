@extends('user_fa.master')
@section('styles')
@endsection

@section('content')

    <div class="container register-form">
        <div class="row">
            <div class="col-12 col-lg-4 order-sm-first order-lg-last">
                <div class="card card-explain mt-5">
                    <div class="card-header">
                        <h5 class="text-center text-white">توضیحات</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <br>پس از ثبت نام ایمیلی حاوی لینک فعالسازی برای شما ارسال می شود ، شما باید بر روی لینک موجود در ایمیل کلیک کنید تا اکانت شما فعال شود و بتوانید از طریق صفحه ورود وارد سایت شوید .
                            در صورتی که پس از ثبت نام ایمیلی حاوی لینک فعالسازی برای شما ارسال نشده ، اینجا کلیک کنید .
                        </p>
                        <ul>
                            <p> در هیچ یک از موارد زیر احتیاج به ثبت نام مجدد نیست !</p>
                            <li>در صورتی که رمز عبور خود را فراموش کرده اید ، جهت ارسال رمز عبور جدید اینجا کلیک کنید .</li>
                            <li>در صورتی که پس از ثبت نام ایمیلی حاوی لینک فعالسازی به شما ارسال نشده ، اینجا کلیک کنید .</li>
                            <li>جهت ارسال بیش از یک همایش نیاز به ثبت نام مجدد نیست !</li>
                            <li>در صورتی که در هنگام ثبت نام مشخصات خود را اشتباه وارد کردید ، میتوانید با ورود به سیستم آنها را ویرایش کنید. </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 order-sm-last order-lg-first">
                <div class="card card-register mt-5">
                    <div class="card-header">
                        <h5 class="text-center text-white">ثبت نام کاربر کنفرانس</h5>
                    </div>
                    <div class="card-body">
                        @include('message.errors')
                        <form action="{{ route('conference.notice.register.fa') }}" method="post" style="padding: 12px;" novalidate>
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
                                <button type="submit" class="btn btn-sm mx-auto d-block mt-3 text-white rounded-0 font-weight-bold">ثبت نام</button>
                            </div>
                        </form>
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