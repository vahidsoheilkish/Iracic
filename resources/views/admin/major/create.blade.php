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
                        <h2>رشته جدید</h2>
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <form action="{{route('admin.major.store')}}" method="post">
                                @include('message.errors')
                                @csrf
                                <div class="form-group">
                                    <select name="group_id" class="form-control">
                                        @foreach($groups_list as $group)
                                            @php($name = json_decode($group->name) )
                                            <option value="{{$group->id}}">{{ $name->en }} *** {{ $name->fa }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <table id="tbl_groups" class="table table-bordered table-responsive-lg">
                                    <tr>
                                        <th>عنوان رشته فارسی</th>
                                        <th>عنوان رشته انگلیسی</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="major_fa" class="form-control" value=" {{ old('major') }}" /></td>
                                        <td><input type="text" name="major_en" class="form-control ltr" value=" {{ old('major_en') }}" /></td>
                                    </tr>
                                </table>
                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-success">اضافه کردن رشته</button>
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