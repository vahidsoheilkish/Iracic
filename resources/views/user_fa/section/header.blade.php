<!--menu-->
<div class="container-fluid pl-0 pr-0">
    <nav class="nav-menu">
        <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i></a>
        <ul class="menu">
            <li><a class="homer font-weight-bold" href="#"><i class="fa fa-home"></i> صفحه اصلی</a>
            </li>
            <li><a  href="#"><i class="fa fa-chevron-down"></i> محصولات</a>
                <ul class="sub-menu">
                    <li><a href="#">محصولات 1</a></li>
                    <li><a href="#">محصولات 2</a></li>
                    <li><a href="#">محصولات 3</a></li>
                    <li><a href="#">محصولات 4</a></li>
                </ul>
            </li>
            <li><a  href="#"><i class="fa fa-chevron-down"></i> خدمات</a>
                <ul class="sub-menu">
                    <li><a href="#">خدمات 1</a></li>
                    <li><a href="#">خدمات 2</a></li>
                    <li><a href="#">خدمات 3</a></li>
                </ul>
            </li>
            <li><a  href="fa/about"><i class="fa fa-user"></i> درباره ما</a></li>
            <li><a  href="#"><i class="fa fa-picture-o"></i> وبلاگ</a></li>
            <li><a  href="#"><i class="fa fa-envelope"></i> تماس با ما</a></li>
            <li><a  href="#"><i class="fa fa-sitemap"></i> ارتباط با ما</a></li>
            <li class="pull-left topsocialmedia">

                <i class="fa fa-instagram"></i>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-pinterest-square"></i>
                <i class="fa fa-telegram"></i>
            </li>
        </ul>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-3 mt-1">
            <div class="row pull-right">
                <ul class="enter-modal" data-wow-duration="1s">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#registerModal">عضویت<i class="fa fa-user-plus pr-2"></i></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#loginModal">ورود<i class="fa fa-lock pr-2"></i></a>
                    </li>
                </ul>
                <div class="container">
                    <div class="row">
                        <div class="modal fade" id="registerModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">ثبت نام</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <form action="{{ route('user.register')}}" method="post" id="register_form" class="w-100" style="font-family: iransans;">
                                                    @csrf
                                                    <ul id="err_list" class="alert alert-danger tar" style="display: none;">
                                                    </ul>
                                                    <div class="form-group-sm tar">
                                                        <label for="email" style="margin:10px;">ایمیل<span style="font-size:12px;"> (نام کاربری)</span></label>
                                                        <input type="text" id="email" name="email" class="form-control" required />
                                                    </div>
                                                    <div class="row form-group tar">
                                                        <div class="form-group-sm col-sm-6">
                                                            <label for="name" style="margin:10px; font-size:13px;">نام</label>
                                                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" required />
                                                        </div>
                                                        <div class="form-group-sm col-sm-6">
                                                            <label for="family" style="margin:10px; font-size:13px;">نام خانوادگی</label>
                                                            <input type="text" id="family" name="family" value="{{old('family')}}" class="form-control" required />
                                                        </div>
                                                    </div> <hr/>
                                                    <div class="row form-group-sm tal">
                                                        <div class="col-sm-4 tac">
                                                            <label for="melicode" style="margin:10px; font-size:14px;">کدملی</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="melicode" name="melicode" value="{{old('melicode')}}" class="form-control" required />
                                                        </div>
                                                    </div><hr/>
                                                    <div class="row form-group-sm tal">
                                                        <div class="col-sm-4 tac">
                                                            <label for="password" style="margin:10px; font-size:13px;">رمز عبور</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="password" name="password" value="" class="form-control" required/>
                                                        </div>
                                                    </div><hr/>
                                                    <div class="row form-group-sm tal">
                                                        <div class="col-sm-4 tac">
                                                            <label for="password2" style="margin:10px; font-size:13px;">تاییده رمز عبور</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="password2" name="password2" class="form-control" required/>
                                                        </div>
                                                    </div><hr/>
                                                    <div class="form-group-sm row">
                                                        <div class="col-sm-4 tac">
                                                            <label for="captcha" style="font-size:13px;">کد امنیتی</label>
                                                        </div>
                                                        <div class="col-sm-8 tac" id="captcha_container">
                                                            <input type="text" id="captcha" name="captcha" class="form-control" required placeholder="کد امنیتی را وارد کنید" style="margin:5px 0;">
                                                            @captcha
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <button type="button" id="register_button" class="btn modalbTn">ثبت نام</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="loginModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">ورود</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <form action="/login" method="post" class="w-100" style="font-family: iransans;">
                                                    @csrf
                                                    @include('message.errors')
                                                    <div class="form-group">
                                                        <label for="email">ایمیل</label>
                                                        <input type="text" class="form-control" name="email" id="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">رمز عبور</label>
                                                        <input type="password" class="form-control" name="password" id="password" required>
                                                    </div><br>
                                                    <div class="form-group">
                                                        <label for="captcha">کد امنیتی</label>
                                                        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="کد امنیتی را وارد کنید">
                                                        @captcha
                                                    </div>
                                                    <button type="submit" class="btn modalbTn">ورود</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <ul class="top-buttons">
                        <li><a href="#">مجلات و کنفرانس ها</a></li>
                        <li><a href="#">پژوهشگران</a></li>
                        <li><a href="#">همایش های معتبر ایراسیس</a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="row">
                        <div class="col-12 col-lg-8">

                        </div>
                        <div class="col-12 col-lg-4 text-left">
                            <a class="btn register-conf text-white mt-2">ثبت مجله و کنفرانس</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3 mt-1">
            <div class="logo pull-left">
                <a href="#"><img src="/img/user/logo.png"></a>
            </div>
        </div>
    </div>
</div>