@extends('user_fa/master')
@section('styles')
    <style>
        .section-p{min-height:550px; margin-bottom:30px;}
        .group_l{color:#222;}
        .group_l:hover{color:#626262; text-decoration:none; transition: .3s;}
        #err_list li{font-size:13px;}
    </style>
@endsection
@section("content")
    <!--slider-->
    <div class="container-fluid slider">
        <div class="row">
            <div id="mycarousel" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#mycarousel" data-slide-to="1"></li>
                    <li data-target="#mycarousel" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/carousel/seminar3.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>به پایگاه اطلاعات علمی ایراسیس خوش آمدید</h3>
                            <p>تیم ایراسیس آماده اطلاع رسانی به شما دانشجویان عزیز می باشد </p>
                            <a href="#" class="btn btn-light" style="border-radius: 0">بیشتر بخوانید</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/carousel/seminar3.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>به پایگاه اطلاعات علمی ایراسیس خوش آمدید</h3>
                            <p>تیم ایراسیس آماده اطلاع رسانی به شما دانشجویان عزیز می باشد </p>
                            <a href="#" class="btn btn-light" style="border-radius: 0">بیشتر بخوانید</a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#mycarousel" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#mycarousel" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid shadow-lg" style="margin-top: 55px">
        <div class="row">
            <div class="col-12 col-lg-3 border">
                <div id="sample-collapse2">
                    <button class="btn sidenav-button w-100"> براساس فیلترها انتخاب کنید</button>
                    <div class="box-filters">
                        <p>فیلترهای اعمال شده<a href="#" class="pull-left rounded">حذف</a></p>
                        <div class="border rounded m-2">
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>رشته</button>
                        </div>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse14" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3 icon" onclick="myFunction(this)"></i>زبان</button>
                        </div>
                        <div class="collapse show" id="collapse14" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio44" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio44">انگلیسی</label><span class="pull-left">2100</span>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio45" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio45">فارسی</label><span class="pull-left">856</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse15" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i> سال انتشار</button>
                        </div>
                        <div class="collapse show" id="collapse15" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox38" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox38">1398</label><span class="pull-left">200</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox39" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox39">1397</label><span class="pull-left">47</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox40" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox40">1396</label><span class="pull-left">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox41" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox41">1395</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox42" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox42">1394</label><span class="pull-left">52</span>
                                </div>
                                <a class="badge badge-secondary text-white" data-toggle="modal" data-target="#myModal"> بیشتر</a>
                                <div class="modal year-modal" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">سال انتشار</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <ul class="year-analyse">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox72" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox72">1398</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox73" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox73">1397</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox74" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox74">1396</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox75" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox75">1395</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox76" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox76">1394</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox77" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox77">1393</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox78" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox78">1392</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox79" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox79">1391</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox80" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox80">1390</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-3">
                                                        <ul class="year-analyse">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox81" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox81">1389</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox82" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox82">1388</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox83" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox83">1387</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox84" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox84">1386</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox85" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox85">1385</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox86" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox86">1384</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox87" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox87">1383</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox88" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox88">1382</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox89" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox89">1381</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-3">
                                                        <ul class="year-analyse">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox90" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox90">1380</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox91" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox91">1379</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox92" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox92">1378</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox93" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox93">1377</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox94" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox94">1376</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox95" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox95">1375</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox96" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox96">1374</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox97" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox97">1373</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox98" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox98">1372</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-3">
                                                        <ul class="year-analyse">
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox99" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox99">1371</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox100" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox100">1370</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox101" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox101">1369</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox102" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox102">1368</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox103" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox103">1367</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox104" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox104">1366</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox105" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox105">1365</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox106" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox106">1364</label>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input type="checkbox" id="customcheckbox107" name="customcheckbox" class="custom-control-input">
                                                                    <label class="custom-control-label" for="customcheckbox107">1363</label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary">انتخاب</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse16" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>پژوهشگران</button>
                        </div>
                        <div class="collapse show" id="collapse16" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox45" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox45">محمد اسداللهی</label><span class="pull-left">45</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox46" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox46">رضا محمدی</label><span class="pull-left">35</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox47" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox47">علی رضایی</label><span class="pull-left">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox48" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox48">محمد کریمی</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox49" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox49">رضا محمدی</label><span class="pull-left">52</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse16" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>موضوعات پژوهشی</button>
                        </div>
                        <div class="collapse show" id="collapse16" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox45" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox45">موضوع 1</label><span class="pull-left">45</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox46" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox46">موضوع 2</label><span class="pull-left">35</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox47" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox47">موضوع 3</label><span class="pull-left">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox48" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox48">موضوع 4</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox49" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox49">موضوع 5</label><span class="pull-left">52</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse17" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>گروه</button>
                        </div>
                        <div class="collapse show" id="collapse17" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox52" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox52">فنی و مهندسی</label><span class="pull-left">1700</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox53" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox53">علوم پایه</label><span class="pull-left">35</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox54" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox54">علوم انسانی</label><span class="pull-left">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox55" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">علوم طبیعی</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">علوم طبیعی</label><span class="pull-left">150</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse18" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>رشته</button>
                        </div>
                        <div class="collapse" id="collapse18" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">مهندسی برق و کامپیوتر</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">علوم زمین</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">مطالعات زبان</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">علوم سیاسی و روابط بین الملل</label><span class="pull-left">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">بیوشیمی، ژنتیک و بیولوژی مولکولی</label><span class="pull-left">150</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse21" data-toggle="collapse">
                            <button class="btn  btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>نوع آرشیو</button>
                        </div>
                        <div class="collapse show" id="collapse21" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox61" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox61">مجلات</label><span class="pull-left">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox62" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox62">کنفرانس ها</label><span class="pull-left">210</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse21" data-toggle="collapse">
                            <button class="btn  btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>نوع مقالات</button>
                        </div>
                        <div class="collapse show" id="collapse21" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox61" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox61">چکیده</label><span class="pull-left">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox62" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox62">کامل</label><span class="pull-left">210</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse22" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>ناشر</button>
                        </div>
                        <div class="collapse show" id="collapse22" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox63" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox63">دانشگاه تهران</label><span class="pull-left">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">ایراسیس</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">ایراسیس</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">ایراسیس</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">ایراسیس</label><span class="pull-left">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse23" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>نوع دسترسی</button>
                        </div>
                        <div class="collapse show" id="collapse23" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox65" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox65">دسترسی آزاد</label><span class="pull-left">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox66" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox66">حق اشتراک</label><span class="pull-left">210</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse24" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>مجلات و کنفرانس ها</button>
                        </div>
                        <div class="collapse show" id="collapse24" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">مجله علوم انسانی</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">مجله علوم انسانی</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">مجله علوم انسانی</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">مجله علوم انسانی</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">مجله علوم انسانی</label><span class="pull-left">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse25" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>دانشگاهها</button>
                        </div>
                        <div class="collapse show" id="collapse25" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">دانشگاه علم و صنعت</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">دانشگاه علم و صنعت</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">دانشگاه علم و صنعت</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">دانشگاه علم و صنعت</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">دانشگاه علم و صنعت</label><span class="pull-left">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse26" data-toggle="collapse">
                            <button class="btn btn-block text-right"><i class="fa fa-chevron-left pl-3" onclick="myFunction(this)"></i>کشور</button>
                        </div>
                        <div class="collapse show" id="collapse26" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox69" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox69">ایران</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox70" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox70">آمریکا</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox71" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox71">استرالیا</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox71" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox71">استرالیا</label><span class="pull-left">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox71" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox71">استرالیا</label><span class="pull-left">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> بیشتر</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <div id="search_wrapper" style="display: contents">
                <div class="col-12 col-lg-7 border">
                    <div class="row pb-3">
                        <form class="search-container text-left">
                            <input type="text" id="search-bar" placeholder="جستجو در عنوان مقالات ایراسیس">
                            <a href="#" class="btn rounded-0 search-icon"><i class="fa fa-search text-white pt-1"></i></a><span><a href="#">جستجوی پیشرفته</a></span>
                        </form>
                    </div>
                    <hr>
                    <div class="row sort mt-4" style="background-color: #ffffff;">
                        <div class="col-12 col-lg-7">
                            <div class="row">
                                <p class="pt-3 pr-3 font-weight-bold text-secondary"> مرتب سازی براساس :</p>
                                <div class="select-sort">
                                    <select name="slct" id="slct">
                                        <option selected>تاریخ انتشار</option>
                                        <option value="1">تعداد استنادها</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="row pt-2">
                                <p class="pt-2 pl-1">صفحه</p>
                                <select class="choose">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <p class="pt-2 pr-1">از 5</p>
                                <p class="pull-left font-weight-bold pr-2 pt-2 text-secondary"><i class="fa fa-check text-info pl-1"></i>نتایج ۱۰۱ تا ۲۰۰ از مجموع ۴۸۹</p>
                            </div>
                        </div>
                    </div>
                    <div class="row analyse-publication">
                        <div class="pt-1">
                            <ul class="pr-1">
                                <li><a href="#" class="title-caption">مطالعه و بررسی نقش مدیریت زنجیره تامین بر ارتقاء پایداری شرکت</a><span class="font-weight-bold  p-1 mr-2 text-secondary"><i class="fa fa-file"></i>چکیده</span></li>
                                <li>علی رضایی، محسن محمدی، رضا کریمی</li>
                                <li>مجله بوم شناسی</li>
                                <li><i><span class="border-left">دوره: 10، شماره: 12، دی 1398</span><span class="border-left">شماره صفحه: 1- 20</span><span> استنادها: 200</span><span> منابع: 100</span></i></li>
                                <li>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row analyse-publication pt-2">
                        <div>
                            <ul class="pr-1">
                                <li><a href="#" class="title-caption">تأثير مکانيزم‌هاي راهبري شرکتي بر مديريت سود و گزارشگري مسئوليت اجتماعي شرکت‌هاي پذيرفته شده دربورس اوراق بهادارتهران</a><span class="font-weight-bold  p-1 mr-2 text-secondary"><i class="fa fa-file"></i>مقاله کامل</span></li>
                                <li>علی رضایی، محسن محمدی، رضا کریمی</li>
                                <li>کنفرانس</li>
                                <li><i><span class="border-left">دوره: 10 , ایران, دانشگاه تهران, 13 خرداد 1398</span><span class="border-left">شماره صفحه: 1- 200</span><span> استنادها: 200</span><span> منابع: 100</span></i></li>
                            </ul>
                        </div>
                    </div>
                    <!--pagination-->
                    <div class="row">
                        <nav class="pagination-container">
                            <div class="pagination-analyse">
                                <a class="pagination-newer">قبل</a>
                                <span class="pagination-inner">
                            <a href="#">1</a>
                            <a class="pagination-active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
				        </span>
                                <a class="pagination-older" >بعد</a>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-lg-2 border">
                    <button class="btn sidenav-button w-100"> جدیدترین کنفرانس ها</button>
                    <div class="">
                        <div class="Advertising">
                            <img src="img/ad/images.jpg">
                        </div>
                        <div class="Advertising">
                            <img src="img/ad/21_ADD.jpg" >
                        </div>
                        <div class="Advertising">
                            <img src="img/ad/884b7c4e-9ff4-4932-99aa-00503f64bb48.jpg">
                        </div>
                        <div>
                            <ul class="notice-conf">
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-left"></i>کنفرانس ملی ایده های نوین و پژوهش های کاربردی در علوم انسانی</a>
                                            <br>
                                            <span>ایران, دانشگاه تهران, 13 خرداد 1398</span>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end of search wrapper -->
                <div class="col-9 border-dark" id="journal_wrapper">
                    <section class=" ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 text-center ">
                                    <nav class="nav-justified ">
                                        <div class="nav nav-tabs2 " id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">مجلات و کنفرانس ها</a>
                                            <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">پژوهشگران</a>
                                            <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">زمینه های پژوهشی</a>
                                            <a class="nav-item nav-link" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop3" aria-selected="false">دانشگاهها</a>
                                            <a class="nav-item nav-link" id="pop5-tab" data-toggle="tab" href="#pop5" role="tab" aria-controls="pop3" aria-selected="false">مقالات</a>
                                            <a class="nav-item nav-link" id="pop6-tab" data-toggle="tab" href="#pop6" role="tab" aria-controls="pop3" aria-selected="false">کشورها</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                                            <div class="pt-3"></div>
                                            <div class="table-responsive">
                                                <table class="table table-analys table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">عنوان مجلات و کنفرانس ها</th>
                                                        <th scope="col"> کل مقالات</th>
                                                        <th scope="col">ضریب تاثیر<span>1397</span></th>
                                                        <th scope="col"> استنادهای<span>1397</span></th>
                                                        <th scope="col">کیفیت</th>
                                                        <th scope="col">ناشر</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td scope="row">1</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/conference/poster1.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#"> ​اولین کنگره بین المللی و دومین کنگره ملی بیوالکترومغناطیس: فرصت ها و چالش ها  ​اولین کنگره بین المللی و دومین کنگره ملی بیوالکترومغناطیس: فرصت ها و چالش ها</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>کنفرانس</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">ایران</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">دانشگاه تهران</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>30</td>
                                                        <td>11.2</td>
                                                        <td>100</td>
                                                        <td><span class="noQ cross" data-toggle="tooltip" title="" data-placement="top" data-original-title="نشریات فاقد کیفیت: نشریات دارای ضریب تاثیر صفر">Q</span></td>
                                                        <td>دانشگاه تهران</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">2</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/journal/journal-2.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#"> پژوهش و نوآوری در علوم و صنایع غذایی</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>نشریه</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">ایران</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">دانشگاه تهران</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>20</td>
                                                        <td>12</td>
                                                        <td>200</td>
                                                        <td><button class="btn Q1-btn">Q1</button></td>
                                                        <td>دانشگاه بوعلی سینا</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">3</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/journal/journal-2.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">نشریه پژوهش و نوآوری در علوم و صنایع غذایی</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>نشریه</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">ایران</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">دانشگاه تهران</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>24</td>
                                                        <td>20</td>
                                                        <td>400</td>
                                                        <td><button class="btn Q4-btn">Q4</button></td>
                                                        <td>دانشگاه شیراز</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">4</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/conference/poster1.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">​اولین کنگره بین المللی و دومین کنگره ملی بیوالکترومغناطیس: فرصت ها و چالش ها</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>کنفرانس</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">ایران</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">دانشگاه تهران</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>12</td>
                                                        <td>23</td>
                                                        <td>600</td>
                                                        <td><span class="noQ cross" data-toggle="tooltip" title="" data-placement="top" data-original-title="نشریات فاقد کیفیت: نشریات دارای ضریب تاثیر صفر">Q</span></td>
                                                        <td>دانشگاه علوم تحقیقات زنجان</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">5</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/journal/journal-2.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">نشریه پژوهش و نوآوری در علوم و صنایع غذایی</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>نشریه</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">ایران</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">دانشگاه تهران</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>14</td>
                                                        <td>25</td>
                                                        <td>250</td>
                                                        <td><button class="btn Q4-btn">Q4</button></td>
                                                        <td>دانشگاه شهید بهشتی تهران</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">6</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/conference/poster1.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">​اولین کنگره بین المللی و دومین کنگره ملی بیوالکترومغناطیس: فرصت ها و چالش ها</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>کنفرانس</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">ایران</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">دانشگاه تهران</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>32</td>
                                                        <td>18</td>
                                                        <td>350</td>
                                                        <td><span class="noQ cross" data-toggle="tooltip" title="" data-placement="top" data-original-title="نشریات فاقد کیفیت: نشریات دارای ضریب تاثیر صفر">Q</span></td>
                                                        <td>دانشگاه اصفهان</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pop2" role="tabpanel" aria-labelledby="pop2-tab">
                                            <div class="pt-3"></div>
                                            <div class="table-responsive">
                                                <table class="table authors-analys table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">ردیف</th>
                                                        <th scope="col">نام نویسنده</th>
                                                        <th scope="col">وابستگی</th>
                                                        <th scope="col">شهر</th>
                                                        <th scope="col">کشور</th>
                                                        <th scope="col">مقالات</th>
                                                        <th scope="col"> استنادها</th>
                                                        <th scope="col">شاخص H</th>
                                                        <th scope="col">شاخص G</th>
                                                        <th scope="col">خوداستنادی</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td scope="row">1</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>​علیرضا محبی</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>دانشگاه تهران</td>
                                                        <td>تهران</td>
                                                        <td>ایران</td>
                                                        <td>280</td>
                                                        <td>1800</td>
                                                        <td>12</td>
                                                        <td>103</td>
                                                        <td>%24</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">2</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>​علیرضا محبی</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>دانشگاه تهران</td>
                                                        <td>تهران</td>
                                                        <td>ایران</td>
                                                        <td>280</td>
                                                        <td>1800</td>
                                                        <td>12</td>
                                                        <td>103</td>
                                                        <td>%24</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">3</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>​علیرضا محبی</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>دانشگاه تهران</td>
                                                        <td>تهران</td>
                                                        <td>ایران</td>
                                                        <td>280</td>
                                                        <td>1800</td>
                                                        <td>12</td>
                                                        <td>103</td>
                                                        <td>%24</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">4</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>​علیرضا محبی</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>دانشگاه تهران</td>
                                                        <td>تهران</td>
                                                        <td>ایران</td>
                                                        <td>280</td>
                                                        <td>1800</td>
                                                        <td>12</td>
                                                        <td>103</td>
                                                        <td>%24</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">5</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>​علیرضا محبی</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>دانشگاه تهران</td>
                                                        <td>تهران</td>
                                                        <td>ایران</td>
                                                        <td>280</td>
                                                        <td>1800</td>
                                                        <td>12</td>
                                                        <td>103</td>
                                                        <td>%24</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">6</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>​علیرضا محبی</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>دانشگاه تهران</td>
                                                        <td>تهران</td>
                                                        <td>ایران</td>
                                                        <td>280</td>
                                                        <td>1800</td>
                                                        <td>12</td>
                                                        <td>103</td>
                                                        <td>%24</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="pop3" role="tabpanel" aria-labelledby="pop3-tab">
                                            <div class="pt-3"></div>
                                            kjdkkdkkdk111

                                        </div>
                                        <div class="tab-pane fade" id="pop4" role="tabpanel" aria-labelledby="pop4-tab">
                                            <div class="pt-3"></div>
                                            kjdkkdkkdk2222

                                        </div>
                                        <div class="tab-pane fade" id="pop5" role="tabpanel" aria-labelledby="pop5-tab">
                                            <div class="pt-3"></div>
                                            kjdkkdkkdk33333

                                        </div>
                                        <div class="tab-pane fade" id="pop6" role="tabpanel" aria-labelledby="pop6-tab">
                                            <div class="pt-3"></div>
                                            kjdkkdkkdk44444
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection