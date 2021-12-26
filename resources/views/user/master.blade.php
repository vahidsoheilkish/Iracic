<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iracic</title>
    <link rel="stylesheet" href="/css/user_en.css"/>
    @yield('styles')
    <script src="/js/jquery.min.js"></script>
    <script src="/js/user_farsi.js"></script>
    <style>
        #progressbar{ position: fixed; top:28%; left:41.5%; z-index: 999; display: none; }
        .tac{text-align: center;}
        .tar{text-align: right;}
        .tal{text-align: left;}
        .rtl{direction: rtl;}
        .ltr{direction: ltr;}
        .link_a{color:#f1f1f1;}
        .link_a:hover{color:#e0e0e0;}
    </style>
</head>
<body>
<img src="/img/user/loading.gif" id="progressbar"/>
@include('sweet::alert')
@include('user.section.header')
@yield("content")
@include('user/section/footer')
<script src="/js/persian-date.js"></script>
<script src="/js/persian-datepicker.js"></script>
<script src="/js/tageditor/jquery.caret.min.js"></script>
<script src="/js/tageditor/jquery.tag-editor.min.js"></script>
<script src="/js/admin/sweetalert.min.js"></script>
@yield('script')
</body>
<script>
    $("#register_button").click(function(){
        let email = $("#email").val();
        let name = $("#name").val();
        let family = $("#family").val();
        let melicode = $("#melicode").val();
        let password = $("#password").val();
        let password2 = $("#password2").val();
        let captcha = $("#captcha").val();
        $.ajax({
            'url' : '/user/register' ,
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