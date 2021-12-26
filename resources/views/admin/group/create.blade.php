@extends('admin.master')
@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h2>گروه جدید</h2>
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <form action="{{route('admin.group.store')}}" method="post">
                                @include('message.errors')
                                @csrf
                                <table id="tbl_groups" class="table table-bordered table-responsive-lg">
                                    <tr>
                                        <th>عنوان گروه فارسی</th>
                                        <th>عنوان گروه انگلیسی</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="group_fa" class="form-control" value=" {{ old('group_fa') }}" /></td>
                                        <td><input type="text" name="group_en" class="form-control ltr" value=" {{ old('group_en') }}" /></td>
                                    </tr>
                                </table>
                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-success">اضافه کردن گروه</button>
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