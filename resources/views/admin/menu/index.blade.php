@extends('admin.master')
@section('styles')
    <style>
        .menu_icon{width:110px;}
        #all_menu_tbl th,td{text-align: center; font-size:12px;}
        #all_menu_tbl tr{border-bottom:2px solid #222222;}
        .submenu_tr{background-color: #d6fcff; display: none;}
        .green{color: #4fcf97;}
        .green:hover{cursor: pointer;}
        .red{color:tomato}
        .red:hover{cursor: pointer;}
        .setting_td * { margin:0 3px; }
        #btn_remove_menu{border:none;background:transparent;color:tomato;}
        #btn_remove_menu:hover{cursor: pointer;}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row" style="margin:20px 0;">
                        <div class="col-sm-6 tal">
                            <a href="{{ route('admin.submenu.create') }}" class="btn btn-sm btn-warning">
                                زیر منو جدید
                                <span class="fa fa-plus vertical_middle"></span>
                            </a>
                            <a href="{{ route('admin.menu.create') }}" class="btn btn-sm btn-success">
                                منوی جدید
                                <span class="fa fa-plus vertical_middle"></span>
                            </a>
                        </div>
                        <div class="col-sm-6 tar">
                            <h2>منوهای افقی</h2>
                        </div>
                    </div>
                    <div class="row rtl">
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="all_menu_tbl" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>عنوان فارسی</th>
                                    <th>عنوان لاتین</th>
                                    <th>لینک</th>
                                    <th>تصویر</th>
                                    <th>وضعیت نمایش</th>
                                </tr>
                                @foreach($menus as $menu)
                                    <tr>
                                        @php( $loop_index = $loop->index + 1 )
                                        @php( $name = json_decode($menu->name) )
                                        <td><span class="fa fa-plus green" onclick="displaySubmenu(this , {{ $loop_index }})"></span> </td>
                                        <td>{{ $loop_index }}</td>
                                        <td>{{ $name->fa }}</td>
                                        <td>{{ $name->en }}</td>
                                        <td>{{ $menu->link }}</td>
                                        <td class="tac"><img src="/upload/menu/{{ $menu->img }}" class="menu_icon" /></td>
                                        <td style="display: flex" class="setting_td">
                                            @if($menu->display == 0 )
                                                <span class="fa fa-2x fa-eye-slash red" menu-id="{{$menu->id}}" onclick="changeDisplay( this )"></span>
                                            @else
                                                <span class="fa fa-2x fa-eye green" menu-id="{{$menu->id}}" onclick="changeDisplay( this )"></span>
                                            @endif

                                            <a href="{{ route('admin.menu.edit' , ['menu'=>$menu->id]) }}" class="fa fa-2x fa-edit" style="color:darkcyan; text-decoration: none;"></a>
                                            <form action="{{ route('admin.menu.remove' , ['menu'=>$menu->id]) }}" method="post" class="post_delete">
                                                @csrf
                                                <button id="btn_remove_menu" type="submit" class="fa fa-2x fa-remove" style=""></button>
                                            </form>
                                        </td>

                                    </tr>
                                        @if( $menu->submenus()->exists() )
                                            @foreach($menu->submenus as $submenu)
                                                <tr class="submenu_tr sub_{{$loop_index}}">
                                                    @php( $sub_name = json_decode($submenu->name) )
                                                    @php( $loop_index2 = $loop->index + 1 )
                                                    <td></td>
                                                    <td>({{$loop_index}}.{{ $loop_index2 }})</td>
                                                    <td>{{ $sub_name->fa }}</td>
                                                    <td>{{ $sub_name->en }}</td>
                                                    <td>{{ $submenu->link }}</td>
                                                    <td class="tac"><img src="/upload/submenu/{{ $submenu->img }}" class="menu_icon" /></td>

                                                    <td style="display: flex; background: #fffb5e;" class="setting_td">
                                                        @if($menu->display == 0 )
                                                            <span class="fa fa-2x fa-eye-slash red" submenu-id="{{$submenu->id}}" onclick="changeSubmenuDisplay( this )"></span>
                                                        @else
                                                            <span class="fa fa-2x fa-eye green" submenu-id="{{$submenu->id}}" onclick="changeSubmenuDisplay( this )"></span>
                                                        @endif

                                                        <a href="{{ route('admin.submenu.edit' , ['submenu'=>$submenu->id]) }}" class="fa fa-2x fa-edit" style="color:darkcyan; text-decoration: none;"></a>
                                                        <form action="{{ route('admin.submenu.remove' , ['submenu'=>$submenu->id]) }}" method="post" class="post_delete">
                                                            @csrf
                                                            <button id="btn_remove_menu" type="submit" class="fa fa-2x fa-remove" style=""></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="submenu_tr" id="sub_{{$loop_index}}">
                                                <td colspan="7" class="alert alert-danger">زیر منویی وجود ندارد</td>
                                            </tr>
                                        @endif
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
                title: "در صورت حذف منو تمام زیر منوهای منو حذف میشود",
                text: "آیا نسبت به حذف منو و زیرمنوها اطمینان دارید ؟",
                icon: "error",
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
            let display = $(".sub_"+id).css('display');
            if(display == "none"){
                $(".sub_"+id).show('fast');
                $(target).removeClass('fa-plus');
                $(target).removeClass('green');
                $(target).addClass('fa-minus');
                $(target).addClass('red');
            }else{
                $(".sub_"+id).hide('fast');
                $(target).removeClass('fa-minus');
                $(target).removeClass('red');
                $(target).addClass('fa-plus');
                $(target).addClass('green');
            }
        }

        function changeDisplay( target ){
            let menu_id =  $(target).attr('menu-id');
            $.ajax({
                'url' : '{{ route('admin.menu.change.display') }}' ,
                'method' : 'post',
                'data' : {'_token': '{{csrf_token()}}' , menu_id} ,
                'dataType' : 'json' ,
                'success' : function(data){
                    if(data.display == 0 ){
                        $(target).removeClass('fa-eye');
                        $(target).removeClass('green');
                        $(target).addClass('fa-eye-slash');
                        $(target).addClass('red');
                    }else{
                        $(target).removeClass('fa-eye-slash');
                        $(target).removeClass('red');
                        $(target).addClass('fa-eye');
                        $(target).addClass('green');
                    }
                }
            });
        }

        function changeSubmenuDisplay(target){
            let submenu_id =  $(target).attr('submenu-id');
            $.ajax({
                'url' : '{{ route('admin.submenu.change.display') }}' ,
                'method' : 'post',
                'data' : {'_token': '{{csrf_token()}}' , submenu_id} ,
                'dataType' : 'json' ,
                'success' : function(data){
                    if(data.display == 0 ){
                        $(target).removeClass('fa-eye');
                        $(target).removeClass('green');
                        $(target).addClass('fa-eye-slash');
                        $(target).addClass('red');
                    }else{
                        $(target).removeClass('fa-eye-slash');
                        $(target).removeClass('red');
                        $(target).addClass('fa-eye');
                        $(target).addClass('green');
                    }
                }
            });
        }
    </script>
@endsection