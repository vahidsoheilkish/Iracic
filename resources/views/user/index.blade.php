@extends('user/master')
@section('styles')
    <style>
        .section-p{min-height:550px; margin-bottom:30px;}
        #err_list li{font-size:13px;}
    </style>
@endsection

@section("content")
    <div class="container-fluid slider mt-2">
        <div class="row">
            <div id="mycarousel" class="carousel slide" data-ride="carousel">
                <ul class="carousel-indicators">
                    <li data-target="#mycarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#mycarousel" data-slide-to="1"></li>
                    <li data-target="#mycarousel" data-slide-to="2"></li>
                </ul>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/img/user/carousel/seminar3.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Welcome to the Iracic Scientific Database</h3>
                            <p>The Iracic team is ready to inform you dear students</p>
                            <a href="#" class="btn btn-light" style="border-radius: 0">Read More</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="/img/user/carousel/seminar3.jpg" class="img-fluid">
                        <div class="carousel-caption">
                            <h3>Welcome to the Iracic Scientific Database</h3>
                            <p>The Iracic team is ready to inform you dear students</p>
                            <a href="#" class="btn btn-light" style="border-radius: 0">Read More</a>
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
    <div class="container-fluid shadow-lg" style="margin-top:35px">
        <div class="row">
            <div class="col-12 col-lg-3 border">
                <div id="sample-collapse2">
                    <button class="btn sidenav-button w-100">select by filters</button>
                    <div class="box-filters">
                        <p>Done Filters<a href="#" class="pull-right rounded text-white">Delete</a></p>
                        <div class="border rounded m-2">
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                            <button class="btn btn-light border p-1 rounded"><i class="fa fa-close"></i>field</button>
                        </div>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse14" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3 icon" onclick="myFunction(this)"></i>language</button>
                        </div>
                        <div class="collapse show" id="collapse14" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio44" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio44">English</label><span class="pull-right">2100</span>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio45" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio45">Persian</label><span class="pull-right">856</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse15" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Publication Year</button>
                        </div>
                        <div class="collapse show" id="collapse15" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox38" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox38">1398</label><span class="pull-right">200</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox39" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox39">1397</label><span class="pull-right">47</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox40" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox40">1396</label><span class="pull-right">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox41" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox41">1395</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox42" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox42">1394</label><span class="pull-right">52</span>
                                </div>
                                <a class="badge badge-secondary text-white" data-toggle="modal" data-target="#myModal"> more</a>
                                <div class="modal year-modal" id="myModal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Publication Year</h4>
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
                                                <button type="submit" class="btn btn-secondary">Select</button>
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
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Researchers</button>
                        </div>
                        <div class="collapse show" id="collapse16" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox45" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox45">Reza Rezai</label><span class="pull-right">45</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox46" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox46">Reza Rezai</label><span class="pull-right">35</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox47" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox47">Reza Rezai</label><span class="pull-right">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox48" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox48">Reza Rezai</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox49" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox49">Reza Rezai</label><span class="pull-right">52</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse16" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Research Topics</button>
                        </div>
                        <div class="collapse show" id="collapse16" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox45" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox45">topic 1</label><span class="pull-right">45</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox46" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox46">topic 2</label><span class="pull-right">35</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox47" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox47">topic 3</label><span class="pull-right">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox48" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox48">topic 4</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox49" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox49">topic 5</label><span class="pull-right">52</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse17" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Group</button>
                        </div>
                        <div class="collapse show" id="collapse17" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox52" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox52">Engineering</label><span class="pull-right">1700</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox53" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox53">Science</label><span class="pull-right">35</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox54" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox54">Humanity</label><span class="pull-right">100</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox55" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">natural Science</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">natural Science</label><span class="pull-right">150</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse18" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>field</button>
                        </div>
                        <div class="collapse" id="collapse18" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">Electrical and Computer Engineering</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">Earth Sciences</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">Language Studies</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">Political Science and International Relations</label><span class="pull-right">150</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox55">Biochemistry, Genetics and Molecular Biology</label><span class="pull-right">150</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pl-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse21" data-toggle="collapse">
                            <button class="btn  btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Archive Type</button>
                        </div>
                        <div class="collapse show" id="collapse21" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox61" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox61">Journals</label><span class="pull-right">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox62" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox62">Conferences</label><span class="pull-right">210</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse21" data-toggle="collapse">
                            <button class="btn  btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Article Type</button>
                        </div>
                        <div class="collapse show" id="collapse21" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox61" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox61">Abstract</label><span class="pull-right">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox62" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox62">Complete</label><span class="pull-right">210</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse22" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Publisher</button>
                        </div>
                        <div class="collapse show" id="collapse22" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox63" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox63">Tehran University</label><span class="pull-right">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox64" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox64">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse23" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Access Type</button>
                        </div>
                        <div class="collapse show" id="collapse23" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox65" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox65">Free</label><span class="pull-right">52</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox66" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox66">No Free</label><span class="pull-right">210</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse24" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Conferences and Journals</button>
                        </div>
                        <div class="collapse show" id="collapse24" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">Humanity Journals</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">Humanity Journals</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">Humanity Journals</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">Humanity Journals</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox67" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox67">Humanity Journals</label><span class="pull-right">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse25" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Universities</button>
                        </div>
                        <div class="collapse show" id="collapse25" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox68" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox68">Tehran University</label><span class="pull-right">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
                                <div class="form-group mt-3 searchdiv">
                                    <input type="text" class="text-center input-group-sm"><i class="fa fa-search pt-2 pr-2"></i>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="card analys-card">
                        <div class="card-header" data-target="#collapse26" data-toggle="collapse">
                            <button class="btn btn-block text-left"><i class="fa fa-chevron-right pr-3" onclick="myFunction(this)"></i>Country</button>
                        </div>
                        <div class="collapse show" id="collapse26" data-parent="#sample-collapse2">
                            <div class="card-body pt-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox69" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox69">Iran</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox70" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox70">American</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox71" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox71">American</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox71" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox71">American</label><span class="pull-right">210</span>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="customcheckbox71" name="customcheckbox" class="custom-control-input">
                                    <label class="custom-control-label" for="customcheckbox71">American</label><span class="pull-right">210</span>
                                </div>
                                <a class="badge readmore badge-secondary text-white"> more</a>
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
                            <input type="text" id="search-bar" placeholder="Search in the title of Iracic Articles">
                            <a href="#" class="btn rounded-0 search-icon"><i class="fa fa-search text-white pt-1"></i></a><span><a href="#">Advanced Search</a></span>
                        </form>
                    </div>
                    <hr>
                    <div class="row sort mt-4" style="background-color: #ffffff;">
                        <div class="col-12 col-lg-7">
                            <div class="row pl-4">
                                <p class="pt-3 pl-2 font-weight-bold text-secondary"> Sort By:</p>
                                <div class="select-sort">
                                    <select name="slct" id="slct">
                                        <option selected>Release date</option>
                                        <option value="1">publication</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-5">
                            <div class="row pt-2">
                                <p class="pt-2 pr-1">page</p>
                                <select class="choose">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                                <p class="pt-2 pl-2">from 5</p>
                                <p class="pull-left font-weight-bold pr-2 pt-2 text-secondary"><i class="fa fa-check text-info pl-1"></i>Results 1 to 2 of 1</p>
                            </div>
                        </div>
                    </div>
                    <div class="row analyse-publication">
                        <div class="pt-1">
                            <ul class="pr-1">
                                <li><a href="#" class="title-caption">Studying the role of supply chain management on firm sustainability promotion</a><span class="font-weight-bold  p-1 mr-2 text-secondary"><i class="fa fa-file pr-1"></i>Abstract</span></li>
                                <li>Ali Rezaei, Mohsen Mohammadi, Reza Karimi</li>
                                <li>Journal of Ecology</li>
                                <li><i><span class="border-right">Volume: 10, Issue: 12, December 1398</span><span class="border-right">page number: 1- 20</span><span> citiation: 200</span><span> References: 100</span></i></li>
                                <li>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row analyse-publication pt-2">
                        <div>
                            <ul class="pr-1">
                                <li><a href="#" class="title-caption">The Impact of Corporate Governance Mechanisms on Earnings Management and Corporate Responsibility Reporting of Listed Companies in Tehran Stock Exchange</a><span class="font-weight-bold  p-1 mr-2 text-secondary"><i class="fa fa-file pr-1"></i>Full article</span></li>
                                <li>Ali Rezaei, Mohsen Mohammadi, Reza Karimi</li>
                                <li>Conference</li>
                                <li><i><span class="border-right">Volume: 10, Iran, University of Tehran, June 19,
                            </span><span class="border-right">page number: 1- 200</span><span> citiation: 200</span><span> References: 100</span></i></li>
                            </ul>
                        </div>
                    </div>
                    <!--pagination-->
                    <div class="row">
                        <nav class="pagination-container">
                            <div class="pagination-analyse">
                                <a class="pagination-newer">previous</a>
                                <span class="pagination-inner">
                            <a href="#">1</a>
                            <a class="pagination-active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
				        </span>
                                <a class="pagination-older" >next</a>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-lg-2 border">
                    <button class="btn sidenav-button w-100">Newest Conferences</button>
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
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="conference-deatil.html" target="_blank"><i class="fa fa-arrow-right"></i>National Conference on New Ideas and Applied Research in Humanities</a>
                                            <br>
                                            <span>Iran, University of Tehran, June 19,2019</span>
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
                                            <a class="nav-item nav-link active" id="pop1-tab" data-toggle="tab" href="#pop1" role="tab" aria-controls="pop1" aria-selected="true">?????????? ?? ?????????????? ????</a>
                                            <a class="nav-item nav-link" id="pop2-tab" data-toggle="tab" href="#pop2" role="tab" aria-controls="pop2" aria-selected="false">??????????????????</a>
                                            <a class="nav-item nav-link" id="pop3-tab" data-toggle="tab" href="#pop3" role="tab" aria-controls="pop3" aria-selected="false">?????????? ?????? ????????????</a>
                                            <a class="nav-item nav-link" id="pop4-tab" data-toggle="tab" href="#pop4" role="tab" aria-controls="pop3" aria-selected="false">??????????????????</a>
                                            <a class="nav-item nav-link" id="pop5-tab" data-toggle="tab" href="#pop5" role="tab" aria-controls="pop3" aria-selected="false">????????????</a>
                                            <a class="nav-item nav-link" id="pop6-tab" data-toggle="tab" href="#pop6" role="tab" aria-controls="pop3" aria-selected="false">????????????</a>
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="pop1" role="tabpanel" aria-labelledby="pop1-tab">
                                            <div class="pt-3"></div>
                                            <div class="table-responsive">
                                                <table class="table table-analys table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">????????</th>
                                                        <th scope="col">?????????? ?????????? ?? ?????????????? ????</th>
                                                        <th scope="col"> ???? ????????????</th>
                                                        <th scope="col">???????? ??????????<span>1397</span></th>
                                                        <th scope="col"> ??????????????????<span>1397</span></th>
                                                        <th scope="col">??????????</th>
                                                        <th scope="col">????????</th>
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
                                                                <a href="#"> ????????????? ?????????? ?????? ???????????? ?? ?????????? ?????????? ?????? ????????????????????????????????: ???????? ???? ?? ???????? ????  ????????????? ?????????? ?????? ???????????? ?? ?????????? ?????????? ?????? ????????????????????????????????: ???????? ???? ?? ???????? ????</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>??????????????</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">??????????</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">?????????????? ??????????</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>30</td>
                                                        <td>11.2</td>
                                                        <td>100</td>
                                                        <td><span class="noQ cross" data-toggle="tooltip" title="" data-placement="top" data-original-title="???????????? ???????? ??????????: ???????????? ?????????? ???????? ?????????? ??????">Q</span></td>
                                                        <td>?????????????? ??????????</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">2</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/journal/journal-2.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#"> ?????????? ?? ???????????? ???? ???????? ?? ?????????? ??????????</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>??????????</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">??????????</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">?????????????? ??????????</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>20</td>
                                                        <td>12</td>
                                                        <td>200</td>
                                                        <td><button class="btn Q1-btn">Q1</button></td>
                                                        <td>?????????????? ?????????? ????????</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">3</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/journal/journal-2.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">?????????? ?????????? ?? ???????????? ???? ???????? ?? ?????????? ??????????</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>??????????</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">??????????</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">?????????????? ??????????</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>24</td>
                                                        <td>20</td>
                                                        <td>400</td>
                                                        <td><button class="btn Q4-btn">Q4</button></td>
                                                        <td>?????????????? ??????????</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">4</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/conference/poster1.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">????????????? ?????????? ?????? ???????????? ?? ?????????? ?????????? ?????? ????????????????????????????????: ???????? ???? ?? ???????? ????</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>??????????????</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">??????????</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">?????????????? ??????????</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>12</td>
                                                        <td>23</td>
                                                        <td>600</td>
                                                        <td><span class="noQ cross" data-toggle="tooltip" title="" data-placement="top" data-original-title="???????????? ???????? ??????????: ???????????? ?????????? ???????? ?????????? ??????">Q</span></td>
                                                        <td>?????????????? ???????? ?????????????? ??????????</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">5</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/journal/journal-2.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">?????????? ?????????? ?? ???????????? ???? ???????? ?? ?????????? ??????????</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>??????????</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">??????????</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">?????????????? ??????????</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>14</td>
                                                        <td>25</td>
                                                        <td>250</td>
                                                        <td><button class="btn Q4-btn">Q4</button></td>
                                                        <td>?????????????? ???????? ?????????? ??????????</td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">6</td>
                                                        <td class="row analys-archive">
                                                            <div class="col-1">
                                                                <img src="img/conference/poster1.jpg">
                                                            </div>
                                                            <div class="col-11 text-right">
                                                                <a href="#">????????????? ?????????? ?????? ???????????? ?? ?????????? ?????????? ?????? ????????????????????????????????: ???????? ???? ?? ???????? ????</a>
                                                                <ul class="Dependency pr-2">
                                                                    <li><i class="fa fa-arrow-left"></i>??????????????</li>
                                                                    <li><img class="flag-img" src="img/flag.jpg">??????????</li>
                                                                    <li><img class="flag-img" src="img/university/tehranuni.png">?????????????? ??????????</li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                        <td>32</td>
                                                        <td>18</td>
                                                        <td>350</td>
                                                        <td><span class="noQ cross" data-toggle="tooltip" title="" data-placement="top" data-original-title="???????????? ???????? ??????????: ???????????? ?????????? ???????? ?????????? ??????">Q</span></td>
                                                        <td>?????????????? ????????????</td>
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
                                                        <th scope="col">????????</th>
                                                        <th scope="col">?????? ??????????????</th>
                                                        <th scope="col">??????????????</th>
                                                        <th scope="col">??????</th>
                                                        <th scope="col">????????</th>
                                                        <th scope="col">????????????</th>
                                                        <th scope="col"> ????????????????</th>
                                                        <th scope="col">???????? H</th>
                                                        <th scope="col">???????? G</th>
                                                        <th scope="col">????????????????????</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td scope="row">1</td>
                                                        <td class="row analys-archive">
                                                            <ul>
                                                                <li><img src="img/author/author1.jpg"></li>
                                                                <li class="author-name"><p>??????????????? ????????</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>?????????????? ??????????</td>
                                                        <td>??????????</td>
                                                        <td>??????????</td>
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
                                                                <li class="author-name"><p>??????????????? ????????</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>?????????????? ??????????</td>
                                                        <td>??????????</td>
                                                        <td>??????????</td>
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
                                                                <li class="author-name"><p>??????????????? ????????</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>?????????????? ??????????</td>
                                                        <td>??????????</td>
                                                        <td>??????????</td>
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
                                                                <li class="author-name"><p>??????????????? ????????</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>?????????????? ??????????</td>
                                                        <td>??????????</td>
                                                        <td>??????????</td>
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
                                                                <li class="author-name"><p>??????????????? ????????</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>?????????????? ??????????</td>
                                                        <td>??????????</td>
                                                        <td>??????????</td>
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
                                                                <li class="author-name"><p>??????????????? ????????</p></li>
                                                            </ul>
                                                        </td>
                                                        <td>?????????????? ??????????</td>
                                                        <td>??????????</td>
                                                        <td>??????????</td>
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