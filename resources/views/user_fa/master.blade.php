<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>ایراسیس</title>
        <link rel="stylesheet" href="/css/user_fa.css"/>
        @yield('styles')
        <script src="/js/jquery.min.js"></script>
        <script src="/js/user_farsi.js"></script>
        <script src="/js/admin/sweetalert.min.js"></script>
        <style>
            .vertical_middle{vertical-align: middle}
            .fa_input{direction: ltr !important; text-align: left !important;}
            .float-l{float:left;}
            .float-r{float:right;}
            .rtl{direction:rtl;}
            .ltr{direction:ltr;}
            .mr-2{margin:2px;}
            .mr-4{margin:4px;}
            .mr-6{margin:6px;}
            .mr-8{margin:8px;}
            .mr-10{margin:10px;}
            .mr-12{margin:12px;}
            .mr-14{margin:14px;}
            .pd-2{padding:2px;}
            .pd-4{padding:4px;}
            .pd-6{padding:6px;}
            .pd-8{padding:8px;}
            .pd-10{padding:10px;}
            .pd-12{padding:12px;}
            .pd-14{padding:14px;}
            .tac{text-align:center;}
            .tar{text-align: right;}
            .tal{text-align:left;}
            .btn_purple{  background-color:#993365 !important;  color:#ffffff !important;}
            .btn_purple:hover{  background-color:#993365 !important;  transition: all .2s;  }
            .btn_purple:focus{ outline: 2px !important ; outline-color: #993365;  }
            .btn_purple:focus-within{ outline: 2px #993365 !important; }
            .btn_purple::-moz-focus-inner{ outline: 2px #993365 !important;  }
            .btn_purple::-moz-focus-outer{ outline: 2px #993365 !important;  }
            .btn_purple:-o-prefocus{ outline: 2px #993365 !important; }
            .white{color:#fff !important;}
            #progressbar{ position: fixed; top:28%; left:41.5%; z-index: 999; display: none; }
        </style>
    </head>
    <body>
        <img src="/img/user/loading.gif" id="progressbar"/>
        @include('sweet::alert')
        @include('user_fa.section.header')
            @yield("content")
        @include('user_fa/section/footer')
            @yield('script')
    </body>
    <script src="/js/persian-date.js"></script>
    <script src="/js/persian-datepicker.js"></script>
    <script src="/js/tageditor/jquery.caret.min.js"></script>
    <script src="/js/tageditor/jquery.tag-editor.min.js"></script>
<script>
    $(document).ready(function(){
        $("#close_btn").hide();
        $(".searchdiv").hide()
    });
    $("#btn_present_analyze").click(function(){
        $(this).addClass("btn-success");
        $(this).removeClass("btn-warning");

        $("#btn_conf_notification").removeClass("btn-success");
        $("#btn_publications").removeClass("btn-success");

        $("#btn_conf_notification").addClass("btn-warning");
        $("#btn_publications").addClass("btn-warning");


        $("#journal_wrapper").show("slow");
        $("#search_wrapper").hide();
        $("#conf_noticification_wrapper").hide();

    });


    $("#btn_conf_notification").click(function(){
        $(this).addClass("btn-success");
        $(this).removeClass("btn-warning");

        $("#btn_present_analyze").removeClass("btn-success");
        $("#btn_publications").removeClass("btn-success");

        $("#btn_present_analyze").addClass("btn-warning");
        $("#btn_publications").addClass("btn-warning");


        $("#conf_noticification_wrapper").show("slow");
        $("#search_wrapper").hide();

    });


    $("#btn_publications").click(function(){
        $(this).addClass("btn-success");
        $(this).removeClass("btn-warning");

        $("#btn_conf_notification").removeClass("btn-success");
        $("#btn_present_analyze").removeClass("btn-success");

        $("#btn_conf_notification").addClass("btn-warning");
        $("#btn_present_analyze").addClass("btn-warning");


        $("#search_wrapper").show("slow");
        $("#conf_noticification_wrapper").hide();
        $("#journal_wrapper").hide();

    });


    $(".readmore").click(function () {
        let display = $(".searchdiv").css('display');
        if(display == "none"){
            $(".searchdiv").show("fast");
        }else{
            $(".searchdiv").hide("fast");
        }
    });
    $("#register_button").click(function(){
        let email = $("#email").val();
        let name = $("#name").val();
        let family = $("#family").val();
        let melicode = $("#melicode").val();
        let password = $("#password").val();
        let password2 = $("#password2").val();
        let captcha = $("#captcha").val();
        $.ajax({
            'url' : '{{ route("user.fa.register") }}' ,
            'method' : 'POST',
            'data' : {_token:'{{csrf_token()}}' , email,name,family,melicode,password,password2,captcha},
            'dataType' : 'json',
            'success' : function(data){
                let errs_list = $("#err_list");
                errs_list.empty();
                if(data.err){
                    document.documentElement.scrollTop = 0;
                    errs_list.show("fast");
                    for (let key in data.err) {
                        $("#err_list").append('<li>'+data.err[key]+'</li>');
                    }
                    $("#captcha_container img").trigger("click");
                    setTimeout(function(){
                        errs_list.hide("slow");
                    },4000);
                    setTimeout(function(){
                        errs_list.hide("slow");
                    },4000);
                    return false;
                }
                if(data.message = "success"){
                    swal("", "Successfully register", "success");
                    setTimeout(function(){
                        location.reload();
                    },2000);
                }else if(data.message="fail"){
                    errs_list.show("fast");
                    $("#err_list").append('<li>خطا در ثبت نام، لطفا مجددا تلاش کنید.</li>');
                }
            }
        });
    });
</script>
</html>
