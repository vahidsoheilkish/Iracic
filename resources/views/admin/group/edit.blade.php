@extends('admin.master')
@section('styles')
    <style>
        #tbl_groups th,td{text-align: center;}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h2>گروه های موجود</h2>
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <form action="{{ route('admin.group.update' , ['group'=>$group->id]) }}" method="post">
                                @include('message.errors')
                                @csrf
                                {{ method_field('PATCH') }}
                                <table id="tbl_groups" class="table table-bordered table-responsive-lg">
                                    <tr>
                                        <th>عنوان گروه فارسی</th>
                                        <th>عنوان گروه انگلیسی</th>
                                    </tr>
                                    @php($group_name = json_decode($group->name) )
                                    <tr>
                                        <td><input type="text" name="group_fa" class="form-control" value=" {{ $group_name->fa }}" /></td>
                                        <td><input type="text" name="group_en" class="form-control ltr" value=" {{ $group_name->en }}" /></td>
                                    </tr>
                                </table>
                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-info">ویرایش گروه</button>
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