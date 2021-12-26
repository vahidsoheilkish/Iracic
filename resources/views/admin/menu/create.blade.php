@extends('admin.master')
@section('styles')
    <style>
        .menu_icon{width:110px;}
        #all_menu_tbl th,td{text-align: center; font-size:12px;}
        .submenu_tr{background-color: #d6fcff; display: none;}
        .green{color: #4fcf97;}
        .green:hover{cursor: pointer;}
        .red{color:tomato}
        .red:hover{cursor: pointer;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row" style="margin:20px 0;">
                        <div class="col-sm-12">
                            <div class="form-group-lg">
                                <h2 class="tar">منوی جدید</h2>
                            </div><hr/>
                            <form action="{{ route('admin.menu.store') }}" method="post" enctype="multipart/form-data" style="direction:rtl;">
                                @csrf
                                @include('message.errors')
                                <div class="form-group">
                                    <label for="name_fa">عنوان فارسی</label>
                                    <input type="text" id="name_fa" name="name_fa" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="name_en">عنوان لاتین</label>
                                    <input type="text" id="name_en" name="name_en" class="form-control tal ltr" />
                                </div>

                                <div class="form-group">
                                    <label for="link">لینک</label>
                                    <input type="text" id="link" name="link" class="form-control tal ltr" />
                                </div>

                                <div class="form-group">
                                    <label for="img">تصویر</label>
                                    <input type="file" id="img" name="img" class="form-control" />
                                </div>

                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-warning">ثبت</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>

    <!-- modals -->
    <!-- The Blog Body Modal -->
    <div class="modal fade" id="blogBody" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ltr">
                </div>
                <div class="modal-body ltr">
                    <p id="post_body"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- The Blog Tags Modal -->
    <div class="modal fade" id="blogTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header ltr">
                </div>
                <div class="modal-body ltr">
                    <p id="post_tags"></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(".post_delete").submit(function(e){
            let form = this;
            e.preventDefault();
            swal({
                title: "جهت حذف عبارت delete را وارد کنید",
                text: "آیا نسبت به حذف پست  نشریه اطمینان دارید ؟",
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

        function displaySubmenu(target ,id){
            let display = $("#sub_"+id).css('display');
            if(display == "none"){
                $("#sub_"+id).show('fast');
                $(target).removeClass('fa-plus');
                $(target).removeClass('green');
                $(target).addClass('fa-minus');
                $(target).addClass('red');
            }else{
                $("#sub_"+id).hide('fast');
                $(target).removeClass('fa-minus');
                $(target).removeClass('red');
                $(target).addClass('fa-plus');
                $(target).addClass('green');
            }
        }
    </script>
@endsection