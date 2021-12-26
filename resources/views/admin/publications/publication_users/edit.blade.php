@extends('admin.master')
@section('styles')
    <style>
        #all_publications_tbl th,td{  text-align: center;  }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer; box-shadow: 0 0 10px #ddd; border-radius: 8px; transition: all .3s;}
        .form_remove{vertical-align: -2px; display: inline;}
        .form_remove:hover{}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h4 class="alert alert-info tac" style="margin-right:50px;">ویرایش نشریه {{$publicationUser->name}}</h4>
                        <div class="col-sm-11" style="margin:0 auto;">
                            @include('message.errors')
                            <form action="{{ route('admin.publication.users.update' , ['publicationUser'=>$publicationUser->id]) }}" method="post" class="form-horizontal">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form-group">
                                    <label for="name" style="margin:6px;">نام نشریه</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="نام نشریه را وارد کنید" required value="{{$publicationUser->name }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="email" style="margin:6px;">آدرس پست الکترونیکی</label>
                                    <input type="text" name="email" id="email" class="form-control tal ltr" placeholder="test@gmail.ir آدرس پست الکترونیکی" required value="{{ $publicationUser->email }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="website" style="margin:6px;">آدرس وب سایت نشریه</label>
                                    <input type="text" name="website" id="website" class="form-control tal ltr" placeholder="www.journal.ir آدرس وب سایت" required value="{{ $publicationUser->website }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="ISSN" style="margin:6px;">شماره ISSN</label>
                                    <input type="text" name="ISSN" id="ISSN" class="form-control tal ltr" maxlength="10" placeholder="ISSN" required value="{{ $publicationUser->ISSN }}"/>
                                </div>
                                <hr/>
                                <div class="form-group tar" style="margin:4px;">
                                    <input type="submit" value="ویرایش کاربر نشریه" class="btn btn-success"/>
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
@endsection

@section('scripts')
    <script>
    </script>
@endsection