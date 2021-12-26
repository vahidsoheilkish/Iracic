<!--menu-->
<div class="container-fluid pl-0 pr-0">
    <nav class="nav-menu">
        <a id="resp-menu" class="responsive-menu" href="#"><i class="fa fa-reorder"></i></a>
        <ul class="menu">
            <li><a class="homer font-weight-bold" href="#"><i class="fa fa-home"></i>HOME</a>
            </li>
            <li><a  href="#"><i class="fa fa-chevron-down"></i> Products</a>
                <ul class="sub-menu">
                    <li><a href="#">Products 1</a></li>
                    <li><a href="#">Products 2</a></li>
                    <li><a href="#">Products 3</a></li>
                    <li><a href="#">Products 4</a></li>
                </ul>
            </li>
            <li><a  href="#"><i class="fa fa-chevron-down"></i>Services</a>
                <ul class="sub-menu">
                    <li><a href="#">Services 1</a></li>
                    <li><a href="#">Services 2</a></li>
                    <li><a href="#">Services 3</a></li>
                </ul>
            </li>
            <li><a  href="/about"><i class="fa fa-user"></i>About Us</a></li>
            <li><a  href="#"><i class="fa fa-picture-o"></i> Weblog</a></li>
            <li><a  href="#"><i class="fa fa-envelope"></i>Contact Us</a></li>
            <li class="pull-right topsocialmedia">

                <i class="fa fa-instagram"></i>
                <i class="fa fa-facebook"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-pinterest-square"></i>
                <i class="fa fa-telegram"></i>
            </li>
        </ul>
    </nav>
    <div class="row">
        <div class="col-12 col-lg-2 mt-1">
            <div class="logo pull-left">
                <a href="#"><img src="/img/user/logo.png"></a>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="row">
                <div class="col-12 col-lg-10">
                    <ul class="top-buttons">
                        <li><a href="#">Journals and Conferences</a></li>
                        <li><a href="#">Researchers</a></li>
                        <li><a href="#">Valid Conferences </a></li>
                    </ul>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 col-lg-8">

                        </div>
                        <div class="col-12 col-lg-4 text-right">
                            <a class="btn register-conf mt-2">Journal Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 mt-1">
            <div class="row pull-right">
                <ul class="enter-modal" data-wow-duration="1s">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#registerModal">Register<i class="fa fa-user-plus pl-2"></i></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#loginModal">LogIn<i class="fa fa-lock pl-2"></i></a>
                    </li>
                </ul>
                <div class="container">
                    <div class="row">
                        <div class="modal fade" id="registerModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Register</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <form action="{{ route('user.register')}}" method="post" id="register_form" class="w-100" style="direction: ltr;">
                                                    @csrf
                                                    <ul id="err_list" class="alert alert-danger tal" style="display: none; list-style:disc; direction: ltr;">
                                                    </ul>
                                                    <div class="form-group-sm tal">
                                                        <label for="email" style="margin:10px;">Email<span style="font-size:12px;"> (Username)</span></label>
                                                        <input type="text" id="email" name="email" class="form-control" required />
                                                    </div>
                                                    <div class="row form-group tal">
                                                        <div class="form-group-sm col-sm-6">
                                                            <label for="name" style="margin:10px; font-size:13px;">Name</label>
                                                            <input type="text" id="name" name="name" value="{{old('name')}}" class="form-control" required />
                                                        </div>
                                                        <div class="form-group-sm col-sm-6">
                                                            <label for="family" style="margin:10px; font-size:13px;">Lastname</label>
                                                            <input type="text" id="family" name="family" value="{{old('family')}}" class="form-control" required />
                                                        </div>
                                                    </div> <hr/>
                                                    <div class="row form-group-sm tal">
                                                        <div class="col-sm-4 tac">
                                                            <label for="melicode" style="font-size:14px;">Melicode</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="melicode" name="melicode" value="{{old('melicode')}}" class="form-control" required />
                                                        </div>
                                                    </div><hr/>
                                                    <div class="row form-group-sm tal">
                                                        <div class="col-sm-4 tac">
                                                            <label for="password" style="font-size:13px;">Password</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="password" name="password" value="" class="form-control" required/>
                                                        </div>
                                                    </div><hr/>
                                                    <div class="row form-group-sm tal">
                                                        <div class="col-sm-4 tac">
                                                            <label for="password2" style="font-size:13px;">Confirm password</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="password" id="password2" name="password2" class="form-control" required/>
                                                        </div>
                                                    </div><hr/>
                                                    <div class="form-group-sm row">
                                                        <div class="col-sm-4 tac">
                                                            <label for="captcha" style="font-size:13px;">Security key</label>
                                                        </div>
                                                        <div class="col-sm-8 tac" id="captcha_container">
                                                            <input type="text" id="captcha" name="captcha" class="form-control" required placeholder="Enter security key" style="margin:5px 0;">
                                                            @captcha
                                                        </div>
                                                    </div>
                                                    <button type="button" id="register_button" class="btn modalbTn">Sign Up</button>
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
                                        <h5 class="modal-title">LogIn</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
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
                                                        <input type="text" id="captcha" name="captcha" class="form-control" required placeholder="Enter security key">
                                                        @captcha
                                                    </div>
                                                    <button type="submit" class="btn modalbTn">Log In</button>
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
    </div>
</div>