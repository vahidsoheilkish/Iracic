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
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <h2>گروه های موجود</h2>
                            <a href="{{ route('admin.major.create') }}" class="tal">رشته جدید</a>
                            <table id="tbl_groups" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>#</th>
                                    <th>گروه</th>
                                    <th>عنوان رشته فارسی</th>
                                    <th>عنوان رشته انگلیسی</th>
                                    <th>ویرایش</th>
                                </tr>
                                @foreach($majors as $major)
                                    @php($major_name = json_decode($major->name) )
                                    @php($group_name = json_decode($major->group['name']) )
                                    <tr>
                                        <td>{{ $major->id }}</td>
                                        <td>
                                            <span style="color:tomato">{{ $group_name->fa }}</span> ***
                                            <span style="color:green">{{ $group_name->en }}</span>
                                        </td>
                                        <td>{{ $major_name->fa }}</td>
                                        <td>{{ $major_name->en }}</td>
                                        <td><a href="{{ route('admin.major.edit' ,['major'=>$major->id]) }}"><i class="fa fa-2x fa-edit"></i></a></td>
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
@endsection
@section('scripts')
    <script>

    </script>
@endsection