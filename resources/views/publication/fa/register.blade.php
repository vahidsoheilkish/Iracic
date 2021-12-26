@extends('user_fa/master')

@section('styles')
    <style>
        .star_field{vertical-align: -2px;margin: 4px;}
        input[type=text]{direction: rtl; text-align: right}
    </style>
@endsection

@section('content')

    <div class="container register-form">
        <div class="row">
            <div class="col-12 col-lg-8 order-sm-first order-lg-first">
                <div class="card card-register mt-5">
                    <div class="card-header" style="background-color: #e4606d">
                        <h5 class="text-center text-white">ثبت نام کاربر نشریه</h5>
                    </div>
                    <div class="card-body">
                        @include('message.errors')
                        <form action="{{ route('publication.register.fa') }}" method="post" class="form-horizontal" id="" novalidate>
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
                            <button type="submit" class="btn btn-sm mx-auto d-block mt-3 text-white rounded-0 font-weight-bold"  style="background-color: #e4606d">ثبت نام</button>
                        </form>
                     </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 order-sm-last order-lg-last">
                <div class="card card-explain mt-5">
                    <div class="card-header" style="background-color: #e4606d">
                        <h5 class="text-center text-white">توضیحات</h5>
                    </div>
                    <div class="card-body">
                        <p>
                            <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua
                        </p>
                        <ul>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection