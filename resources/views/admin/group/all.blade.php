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
                            <a href="{{ route('admin.group.create') }}" class="tal">گروه جدید</a>
                            <table id="tbl_groups" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th>#</th>
                                    <th>عنوان گروه فارسی</th>
                                    <th>عنوان گروه انگلیسی</th>
                                    <th>ویرایش</th>
                                </tr>
                                @foreach($groups as $group)
                                    @php($group_name = json_decode($group->name) )
                                    <tr>
                                        <td>{{ $group->id }}</td>
                                        <td>{{ $group_name->fa }}</td>
                                        <td>{{ $group_name->en }}</td>
                                        <td><a href="{{ route('admin.group.edit' ,['group'=>$group->id]) }}"><i class="fa fa-2x fa-edit"></i></a></td>
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