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
                            <form action="{{ route('admin.major.update' , ['major'=>$major->id]) }}" method="post">
                                @include('message.errors')
                                @csrf
                                {{ method_field('PATCH') }}
                                <table id="tbl_groups" class="table table-bordered table-responsive-lg">
                                    <tr>
                                        <th>#</th>
                                        <th>گروه انتخابی</th>
                                        <th>عنوان گروه فارسی</th>
                                        <th>عنوان گروه انگلیسی</th>
                                    </tr>
                                    @php($major_name = json_decode($major->name) )
                                    <tr>
                                        <td>{{ $major->id }}</td>
                                        <td>
                                            <select name="group_id" class="form-control" style="min-height: 50px;">
                                                @foreach($groups_list as $group)
                                                    @php($group_name = json_decode($group->name) )
                                                        @if($major->group_id == $group->id )
                                                            <option value="{{$group->id}}" selected="selected">{{ $group_name->fa }} | {{ $group_name->en }}</option>
                                                        @else
                                                        <option value="{{$group->id}}">{{ $group_name->fa }} | {{ $group_name->en }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input type="text" name="major_fa" class="form-control" value=" {{ $major_name->fa }}" /></td>
                                        <td><input type="text" name="major_en" class="form-control ltr" value=" {{ $major_name->en }}" /></td>
                                    </tr>
                                </table>
                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-warning">ویرایش رشته</button>
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