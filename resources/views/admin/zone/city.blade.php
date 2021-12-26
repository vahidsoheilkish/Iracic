@extends('admin.master')

@section('styles')
    <style>
        #country_table tr,th{text-align: center;}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        .red{color:#ff394f}
        .red:hover{cursor:pointer;color:tomato}
        .green{color: #0ac282}
        .green:hover{cursor:pointer;color:limegreen}
        .empty_button{padding: 0;border: none;background: none; position: relative; top:-5px}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <div class="col-sm-12 form-group" style="display: inline-flex;">
                            <div class="col-sm-10">
                                <h2>لیست کشورها</h2>
                            </div>
                            <div class="col-sm-2 tal">
                                <a href="#" data-toggle="modal" data-target="#newCountry" class="btn btn-sm btn-primary tal">اضافه کردن کشور</a>
                            </div>
                        </div>
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="country_table" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>#</th>
                                    <th>نام کشور</th>
                                    <th>تنظیمات</th>
                                </tr>
                                @foreach($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>
                                            <div style="display: inline-flex">
                                                <a data-country="{{$country->id}}" data-toggle="modal" data-target="#newCity" class="add_city" style="margin:0 4px;">
                                                    <span class="fa fa-2x fa-plus green"></span>
                                                </a>

                                                <form action="{{ route('admin.country.remove', ['country'=>$country->id]) }}" method="post"  class="form_remove">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" data-toggle="modal" data-target="#" class="empty_button" style="margin:0 4px;">
                                                        <span class="fa fa-2x fa-remove red"></span>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @if($country->cities()->exists())
                                        <tr style="background-color: #ffb03c;">
                                            <th>#</th>
                                            <th>نام شهر</th>
                                            <th>حذف</th>
                                        </tr>
                                        @foreach($country->cities as $city)
                                            <tr style="background-color: #def6ff; color:#0026ff;">
                                                <td colspan="1">{{ $city->id }}</td>
                                                <td colspan="1">{{ $city->name }}</td>
                                                <td>
                                                    <form action="{{ route('admin.city.remove', ['city'=>$city->id]) }}" method="post"  class="form_remove">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" data-toggle="modal" data-target="#" class="empty_button" style="margin:0 4px;">
                                                            <span class="fa fa-remove red"></span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach
                            </table>
                        </div>
                        <div class="tac" style="margin:30px auto;">
                            {!! $countries->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>

    <!-- New Country -->
    <div class="modal fade" id="newCountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h4 class="modal-title tar" id="exampleModalLabel">ثبت کشور جدید</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.country.store') }}" method="post" enctype="multipart/form-data">
                    @include('message.errors')
                    @csrf
                    <div class="modal-body rtl">
                        <div class="form-group tac form-inline">
                            <label for="country" style="margin:10px;">نام کشور</label>
                            <input type="text" name="country" id="country" class="form-control"/>
                        </div>
                        <div class="form-group tac form-inline">
                            <label for="flag" style="margin:10px;">پرچم کشور</label>
                            <input type="file" name="flag" id="flag" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer rtl">
                        <button type="submit" class="btn btn-sm btn-primary">ثبت کشور</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- New City -->
    <div class="modal fade" id="newCity" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header rtl">
                    <h4 class="modal-title tar" id="exampleModalLabel">ثبت شهر جدید</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.city.store') }}" method="post">
                    @csrf
                    <input type="hidden" id="countries_id" name="countries_id"/>
                    <div class="modal-body rtl">
                        <div class="form-group tac form-inline">
                            <label for="city" style="margin:10px;">نام شهر</label>
                            <input type="text" name="city" id="city" class="form-control"/>
                        </div>
                    </div>
                    <div class="modal-footer rtl">
                        <button type="submit" class="btn btn-sm btn-primary">ثبت شهر</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(".add_city").click(function(){
        let country_id = $(this).attr('data-country');
        $("#countries_id").val(country_id);
    });
    $(".form_remove").submit(function(e){
        let form = this;
        e.preventDefault();
        swal({
            title: "جهت حذف عبارت delete را وارد کنید",
            text: "آیا نسبت به حذف کشور اطمینان دارید ؟",
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
</script>
@endsection
