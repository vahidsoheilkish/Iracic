@extends('admin.master')
@section('styles')
    <style>
        #all_cats_tbl{text-align: center;}
        #all_cats_tbl th,td{text-align: center;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        @include('message.errors')
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <h2>لیست دسته بندی ها</h2>
                            <a href="{{ route('admin.categories.create') }}" class="tal">دسته بندی جدید</a>
                            <table id="all_cats_tbl" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                </tr>
                                @foreach($cats as $cat)
                                    <tr>
                                        <td>{{$cat->id}}</td>
                                        <td>{{$cat->name}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>

    <!-- The Conference send notification -->
    <div class="modal fade" id="sendNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h4 class="modal-title tar" id="exampleModalLabel">ارسال پیام</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body rtl">
                    @if(isset($conference))
                        <form action="{{ route('admin.conference.send.notification' , ['conferenceUser'=>$conference->conference_user->id]) }}" method="post">
                            @csrf
                            <input type="hidden" id="conference_id_notification" name="conference_user_id"/>
                            <div class="form-group">
                                <label for="message">متن پیام</label>
                                <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                            </div>
                            <div class="modal-footer rtl">
                                <button type="submit" class="btn btn-sm btn-success">ارسال پیام</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        CKEDITOR.replace('message' ,{
            contentsLangDirection: 'rtl'
        });
        $(document).ready(function(){
            $(".submenu_option").css('display','none');
            $(".submenu_option li").mouseenter(function(){
                $(this).find('a,span').each(function(){
                    $(this).css('color','#fff');
                });
            });
            $(".submenu_option li").mouseleave(function(){
                $(this).find('a,span').each(function(){
                    $(this).css('color','#222');
                });
            });

            $(".volume_update").click(function(){
                let id = $(this).attr('volume-id');
                let year = $(this).attr('volume-year');
                $("#conference_update").val(id);
                $("#volume_year").val(year);
            });

            $("#volume_update").click(function(){
                let id = $("#conference_update").val();
                let year = $("#volume_year").val();
                let _csrf = $("#_csrf").val();
                $.ajax({
                    'url' : '/admin/conference/volume/update/'+id ,
                    'method' : 'post',
                    'data' : {'_token': _csrf , 'year' : year , 'id' : id} ,
                    'dataType' : 'json' ,
                    'success' : function(data){
                        if(data.message=='success'){
                            swal("ویرایش شد", "سال دوره به "+data.year+" تغییر کرد", "success");
                            setTimeout(function(){
                                location.reload();
                            },1500);
                        }
                    }
                });
            });

        });

        function openNotificationModal(e){
            let id = $(e).attr('conference-id');
            let title = $(e).attr('conference-title');
            $("#conference_id_notification").val(id);
            $("#conference_title").html(title);

        }

        function openSetting(e){
            let parent = $(e).parent();
            let ul = parent.children("ul");
            console.log(ul);
            if(ul.hasClass('close')){
                ul.slideDown("fast");
                ul.removeClass("close");
                ul.addClass("open");
            } else if(ul.hasClass('open')){
                ul.slideUp("fast");
                ul.removeClass("open");
                ul.addClass("close");
            }
        }
        function closeSettings(){
            $('.submenu_option').each(function () {
                $(this).addClass('close');
                $(this).removeClass('open');
                $(this).fadeOut(200);
            });
        }
        // $(".options").mouseleave(function(){
        //     closeSettings();
        // });
        $(".options").mouseleave(function(){
            closeSettings();
        });
        function changeActive(event){
            swal({
                title: "توجه",
                text: "آیا نسبت به فعال/غیرفعال کردن نشریه اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willUpdate) => {
                    if (willUpdate) {
                        let _token = $("#_token").val();
                        $.ajax({
                            'url' : '/admin/conference/edit/active/' + $(event).attr('conference-id') ,
                            'type' : 'POST' ,
                            'data' : {'_token' : '{{ csrf_token() }}'} ,
                            'dataType' : 'json' ,
                            'success' : function(data){
                                if(data.message == 'success'){
                                    if(data.target == 'success'){
                                        $(event).removeClass('label-danger');
                                        $(event).addClass('label-success');
                                        $(event).html("Active");
                                    }else{
                                        $(event).removeClass('label-success');
                                        $(event).addClass('label-danger');
                                        $(event).html("Inactive");
                                    }
                                }
                            }
                        });
                    } else {
                        return false;
                    }
                });
        }

        $(".volume_delete_form").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف دوره (volume) نشریه اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: "input",
                html: true
            })
                .then((value) => {
                    if(value=="delete"){
                        form.submit();
                    }else if(value==""){
                        swal("جهت حذف باید عبارت delete را وارد کنید");
                        return false;
                    }else{
                        swal("عبارت delete وارد نشده است!");
                        return false;
                    }
                });
        });

        $(".form_remove").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف کاربر نشریه اطمینان دارید ؟",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                content: "input",
                html: true
            })
                .then((value) => {
                    if(value=="delete"){
                        form.submit();
                    }else if(value==""){
                        swal("جهت حذف باید عبارت delete را وارد کنید");
                        return false;
                    }else{
                        swal("عبارت delete وارد نشده است!");
                        return false;
                    }
                });
        });

        function main_lang(target,type){
            switch (type){
                case 'title':
                    swal($(target).attr('data-title'));
                    break;
                case 'subject':
                    swal($(target).attr('data-subject'));
                    break;
                case 'description':
                    swal($(target).attr('data-description'));
                    break;
            }
        }

        function second_lang(target,type){
            switch (type){
                case 'title':
                    swal($(target).attr('data-title'));
                    break;
                case 'subject':
                    swal($(target).attr('data-subject'));
                    break;
                case 'description':
                    swal($(target).attr('data-description'));
                    break;
            }
        }
    </script>
@endsection