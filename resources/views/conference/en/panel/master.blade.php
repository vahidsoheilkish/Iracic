<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Conference dashboard</title>
    <link rel="stylesheet" href="/css/publication_conference_panel.css"/>
    <link rel="stylesheet" href="/css/panel/dashboard_en.css"/>
    <link rel="stylesheet" href="/css/admin/sweetalert.css"/>
    <link rel="stylesheet" href="/css/persian-datepicker.css"/>
    <link rel="stylesheet" href="/css/jquery.tag-editor.css"/>
    <link rel="stylesheet" href="/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/css/persian-datepicker.css"/>
    <link rel="stylesheet" href="/css/select2.min.css"/>
    @yield('styles')
    <style>
        #progressbar{ position: fixed; top:28%; left:41.5%; z-index: 999; display: none; }
        .tac{text-align: center;}
        .tar{text-align: right;}
        .tal{text-align: left;}
        .rtl{direction: rtl;}
        .ltr{direction: ltr;}
        #pnl_logo{width:100px;}
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
<img src="/img/user/loading.gif" id="progressbar"/>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0 tal" href="/">
        <img src="/img/user/logo.png" id="pnl_logo"/>
    </a>
    {{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <form action="{{ route('conference.notice.logout') }}" method="post" style="display: inline;">
                @csrf
                <input type="submit" value="Sign out" class="btn btn-danger btn-sm"/>
            </form>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a id="menu_dashboard" class="nav-link active" href="{{route('conference.notice.dashboard')}}">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    @if(!isset($user->conference->_id))
                        <li class="nav-item">
                            <a id="menu_journal_register" class="nav-link active" href="{{ route('conference.notice.create') }}">
                                <span data-feather="file"></span>
                                Conference Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item" style="color:tomato;">
                            <del>
                                <p id="menu_journal_register" class="nav-link active">
                                    <span data-feather="file"></span>
                                    Conference Register
                                </p>
                            </del>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a id="menu_volume_register" class="nav-link active" href="{{ route('conference.notice.create.volume') }}">
                            <span data-feather="file"></span>
                            Submit volume
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="menu_list" class="nav-link active" href="{{ route('conference.notice.conferences.list')  }}">
                            <span data-feather="shopping-cart"></span>
                            Conferences list
                        </a>
                    </li>
                </ul>
                {{--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">--}}
                    {{--<span>Saved reports</span>--}}
                    {{--<a class="d-flex align-items-center text-muted" href="#">--}}
                        {{--<span data-feather="plus-circle"></span>--}}
                    {{--</a>--}}
                {{--</h6>--}}
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a id="menu_notification" class="nav-link active" href="{{ route('conference.notice.notifications') }}">
                            <span data-feather="file-text"></span>
                            Notifications
                            <span class="badge badge-danger tac" style="padding:6px;vertical-align: middle;">{{ $notifications_unseen }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="menu_change_password" class="nav-link active" href="{{ route('conference.notice.change.pass.form') }}">
                            <span data-feather="file-text"></span>
                            Change password
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="margin-top:40px;">
            @yield('content')
        </main>
    </div>
</div>
<script src="/js/panel/jquery-3.4.1.min.js"></script>
<script src="/js/panel/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="/js/panel/feather.min.js"></script>
<script src="/js/panel/Chart.min.js"></script>
<script src="/js/panel/dashboard.js"></script>
<script src="/js/common.js"></script>
<script src="/js/admin/sweetalert.min.js"></script>
<script src="/js/persian-date.js"></script>
<script src="/js/persian-datepicker.js"></script>
<script src="/js/tageditor/jquery.caret.min.js"></script>
<script src="/js/tageditor/jquery.tag-editor.min.js"></script>
<script src="/js/persian-date.js"></script>
<script src="/js/persian-datepicker.js"></script>
<script src="/js/select2.min.js"></script>
@yield('script')
@include('sweet::alert')
</body>
</html>