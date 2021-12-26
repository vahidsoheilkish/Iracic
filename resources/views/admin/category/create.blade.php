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
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <h2>دسته بندی جدید</h2><hr/>
                            <form action="{{route('admin.categories.store')}}" method="post">
                                @include('message.errors')
                                @csrf
                                <div class="form-group">
                                    <label for="category">عنوان دسته بندی</label>
                                    <input type="text" name="category" class="form-control" value=" {{ old('category') }}" />
                                </div>
                                <div class="form-group tal">
                                    <button type="submit" class="btn btn-success">اضافه کردن دسته بندی</button>
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