@extends('admin.master')
@section('styles')
    <style>
        #all_publications_tbl th,td{  text-align: center;  }
        .input_file{border:1px solid grey; padding:4px; border-radius:4px; }
        .poster{width:230px; border-radius:10px;}
        .separator{padding: 10px 0;border-bottom: 1px solid #bfbfbf;}
    </style>
@endsection

@section('content')
    @php ( $title = json_decode($publication->title ) )
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <h4 class="alert alert-info tac" style="">ویرایش نشریه
                            <span style="margin:0 10px;">{{$title->t1}}</span> ****
                            <span>{{$title->t2}}</span>
                        </h4>
                        <div class="col-sm-12">
                            <form action="{{ route('admin.publication.update' , ['publication'=>$publication]) }}" enctype="multipart/form-data" method="post" class="form-horizontal" novalidate>
                                {{ method_field('PATCH') }}
                                @include('message.errors')
                                <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                                <div class="form-group">
                                    <label for="group_id" style="margin:6px;">انتخاب گروه</label>
                                    <select name="group_id" id="group_id" class="form-control" required>
                                        @foreach($groups_list as $group)
                                            @php( $group_name = json_decode($group->name))
                                            @if($publication->group_id == $group->id )
                                                    <option value="{{ $group->id }}" selected="selected">{{ $group_name->en }}</option>
                                                @else
                                                    <option value="{{ $group->id }}">{{ $group_name->en }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="major_id" style="margin:6px;">انتخاب رشته</label>
                                    <select name="major_id" id="major_id" class="form-control" required>
                                    </select>
                                </div>
                                <div class="row rtl">
                                    <span class="tar alert alert-warning">انتخاب زبان</span>
                                </div>
                                <div class="row form-group" style="direction: rtl;">
                                    <div class="col-sm-3">
                                        <label for="lang_en">انگلیسی</label>
                                        <input type="radio" name="lang" id="lang_en" class="radio" value="en" onclick="setYearsByLang(this)" {{ $publication->lang == 'en' ? 'checked' : '' }} style="vertical-align:-4px; margin:0 3px;"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="lang_fa">فارسی</label>
                                        <input type="radio" name="lang" id="lang_fa" class="radio" value="fa" onclick="setYearsByLang(this)" {{ $publication->lang == 'fa' ? 'checked' : '' }} style="vertical-align:-4px; margin:0 3px;"/>
                                    </div>
                                </div>
                                <div class="row rtl">
                                    <span class="tar alert alert-warning">نوع مقالات نشریه</span>
                                </div>
                                <div class="row form-group" style="direction: rtl;">
                                    <div class="col-sm-3">
                                        <label for="abstract">Abstract</label>
                                        <input type="radio" name="publication_type" id="abstract" class="radio" value="abstract" {{ $publication->publication_type == 'abstract' ? 'checked' : '' }} onclick="setYearsByLang(this)" checked style="vertical-align:-2px; margin:0 3px;"/>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="fulltext">Fulltext</label>
                                        <input type="radio" name="publication_type" id="fulltext" class="radio" value="fulltext" {{ $publication->publication_type == 'fulltext' ? 'checked' : '' }} onclick="setYearsByLang(this)" style="vertical-align:-2px; margin:0 3px;"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="publish_order" style="margin:6px;">ترتیب انتشار</label>
                                    <select class="form-control" name="publish_order" id="publish_order">
                                        <option value="month" {{$publication->publish_order == "month" ? 'selected' : ''}}>ماهانه</option>
                                        <option value="season" {{$publication->publish_order == "season" ? 'selected' : ''}}>فصل نامه</option>
                                        <option value="half-year" {{$publication->publish_order == "half-year" ? 'selected' : ''}}>دو فصل نامه</option>
                                    </select>
                                </div>
                                <div class="form-group" style="direction: rtl;">
                                    <label for="access">وضعیت انتشار</label>
                                </div>
                                <div class="form-group">
                                    <table class="table">
                                        <tr>
                                            <td>
                                                <label for="open">دسترسی آزاد به تمامی مقالات</label>
                                                <input type="radio" name="access" id="open" value="open" class="radio" {{$publication->access == "open" ? 'checked' : ''}} style="vertical-align: middle; margin: 0 3px;"/>
                                            </td>
                                            <td>
                                                <label for="pay">پرداخت حق اشتراک</label>
                                                <input type="radio" name="access" id="pay" value="pay" class="radio" {{$publication->access == "pay" ? 'checked' : ''}} style="vertical-align: middle; margin: 0 3px;"/>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="first_publish_year">اولین سال انتشار</label>
                                    <select name="first_publish_year" id="first_publish_year" class="form-control rtl" style="text-align: right">
                                        @for($i = 2019; $i>=1994; $i--)
                                            <option value="{{$i}}" class="rtl"> {{$i}} میلادی</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title_1" class="alert alert-primary" style="margin:6px;">عنوان نشریه زبان اصلی</label>
                                    <input type="text" name="title_1" id="title_1" class="form-control" placeholder="عنوان نشریه را به زبان اصلی وارد کنید" required value="{{ $title->t1 }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="title_2" class="alert alert-secondary" style="margin:6px;">عنوان نشریه زبان دوم</label>
                                    <input type="text" name="title_2" id="title_2" class="form-control" placeholder="عنوان نشریه را به زبان دوم وارد کنید" required value="{{ $title->t2 }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="country" style="margin:6px;">کشور</label>
                                    <input type="text" name="country" id="country" class="form-control" placeholder="کشور را وارد نمایید" required value="{{$publication->country }} " />
                                </div>
                                <div class="form-group">
                                    <label for="city" style="margin:6px;">شهر</label>
                                    <input type="text" name="city" id="city" class="form-control" placeholder="شهر را وارد نمایید" required value="{{ $publication->city }}" />
                                </div>
                                <div class="form-group">
                                    <label for="printISSN" style="margin:6px;">Print ISSN</label>
                                    <input type="text" name="printISSN" id="printISSN" class="form-control" placeholder="را وارد نمایید print ISSN" required value="{{ $publication->printISSN }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="onlineISSN" style="margin:6px;">Online ISSN</label>
                                    <input type="text" name="onlineISSN" id="onlineISSN" class="form-control" placeholder="را وارد نمایید Online ISSN" required value="{{ $publication->onlineISSN }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="dependency" style="margin:6px;">وابستگی سازمان</label>
                                    <input type="text" name="dependency" id="dependency" class="form-control" placeholder="وابستگی را وارد نمایید" required value="{{ $publication->dependency }}" />
                                </div>
                                <div class="form-group">
                                    <label for="DOI" style="margin:6px;">DOI</label>
                                    <input type="text" name="DOI" id="DOI" class="form-control" placeholder="DOI" required value="{{ $publication->DOI }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="tell" style="margin:6px;">Phone</label>
                                    <input type="text" name="tell" id="tell" class="form-control" placeholder="Phone" required value="{{ $publication->tell }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="fax" style="margin:6px;">Fax</label>
                                    <input type="text" name="fax" id="fax" class="form-control" placeholder="fax" required value="{{ $publication->fax }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="website" style="margin:6px;">Website</label>
                                    <input type="text" name="website" id="website" class="form-control" placeholder="website" required value="{{ $publication->website }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="publication_publisher" style="margin:6px;">منتشرکننده نشریه</label>
                                    <input type="text" name="publication_publisher" id="publication_publisher" class="form-control" placeholder="منتشر کننده نشریه" required value="{{ $publication->publication_publisher }}"/>
                                </div>
                                <div class="form-group">
                                    <label for="address" style="margin:6px;">Address</label>
                                    <textarea name="address" id="address" class="form-control" placeholder="address" required rows="3">{{ $publication->address }}</textarea>
                                </div>
                                <div class="row form-group separator">
                                    @php($responsible = json_decode($publication->responsible))
                                    <div class="col-sm-4">
                                        <label for="responsible">مدیر مسئول</label>
                                        <input type="text" id="responsible" name="responsible" class="form-control" placeholder="مدیر مسئول" required value="@if($publication->responsible !=null) {{ $responsible->name }} @endif" />
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="responsible_pic">تصویر مدیر مسئول</label>
                                        <input type="file" id="responsible_pic" name="responsible_pic" class="form-control-file input_file"/>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($publication->responsible!=null)
                                            <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$responsible->pic}}" class="poster"/>
                                        @else
                                            <img src="/img/user/no_img.png" class="poster"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group separator">
                                    @php($redactor = json_decode($publication->redactor))
                                    <div class="col-sm-4">
                                        <label for="redactor">سردبیر</label>
                                        <input type="text" id="redactor" name="redactor" class="form-control" placeholder="سردبیر" required value="@if($publication->redactor !=null) {{ $redactor->name }} @endif" />
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="redactor_pic">تصویر سردبیر</label>
                                        <input type="file" id="redactor_pic" name="redactor_pic" class="form-control-file input_file"/>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($publication->redactor!=null)
                                            <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$redactor->pic}}" class="poster"/>
                                        @else
                                            <img src="/img/user/no_img.png" class="poster"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group separator">
                                    @php($editor = json_decode($publication->editor))
                                    <div class="col-sm-4">
                                        <label for="editor">ویراستار</label>
                                        <input type="text" id="editor" name="editor" class="form-control" placeholder="ویراستار" required value="@if($publication->editor !=null) {{ $editor->name }} @endif" />
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="editor_pic">تصویر ویراستار</label>
                                        <input type="file" id="editor_pic" name="editor_pic" class="form-control-file input_file"/>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($publication->editor!=null)
                                            <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$editor->pic}}" class="poster"/>
                                        @else
                                            <img src="/img/user/no_img.png" class="poster"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group separator">
                                    @php($manager_in = json_decode($publication->manager_in))
                                    <div class="col-sm-4">
                                        <label for="managerin">مدیر داخلی</label>
                                        <input type="text" id="managerin" name="managerin" class="form-control" placeholder="مدیر داخلی" required value="@if($publication->manager_in !=null) {{ $manager_in->name }} @endif" />
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="managerin_pic">تصویر مدیر داخلی</label>
                                        <input type="file" id="managerin_pic" name="managerin_pic" class="form-control-file input_file"/>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($publication->manager_in!=null)
                                            <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$manager_in->pic}}" class="poster"/>
                                        @else
                                            <img src="/img/user/no_img.png" class="poster"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group separator">
                                    @php($manager_exe = json_decode($publication->manager_exe))
                                    <div class="col-sm-4">
                                        <label for="managerexe">مدیر اجرایی</label>
                                        <input type="text" id="managerexe" name="managerexe" class="form-control" placeholder="مدیر خارجی" required value="@if($publication->manager_exe !=null) {{ $manager_exe->name }} @endif" />
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="managerexe_pic">تصویر مدیر اجرایی</label>
                                        <input type="file" id="managerexe_pic" name="managerexe_pic" class="form-control-file input_file"/>
                                    </div>
                                    <div class="col-sm-4">
                                        @if($publication->manager_exe!=null)
                                            <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$manager_exe->pic}}" class="poster"/>
                                        @else
                                            <img src="/img/user/no_img.png" class="poster"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group" style="padding:6px;">
                                    <div class="col-sm-6">
                                        <label for="poster" class="alert alert-danger">پوستر نشریه</label>
                                        <input type="file" id="poster" name="poster" class="form-control-file input_file"/>
                                    </div>
                                    @if($publication->poster !=null)
                                    <div class="col-sm-6">
                                        <span class="alert alert-warning">تصویر قبلی</span>
                                        <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$publication->poster}}" class="poster"/>
                                    </div>
                                    @else
                                        <img src="#" class="poster"/>
                                    @endif
                                </div>
                                <div class="row form-group" style="border-top:0.5px solid #30aaff; border-bottom:0.5px solid #30aaff; padding:6px;">
                                    <div class="col-sm-6">
                                        <label for="owner_logo" class="alert alert-primary">پوستر صاحب امتیاز</label>
                                        <input type="file" id="owner_logoowner_logo" name="owner_logo" class="form-control-file input_file"/>
                                    </div>
                                    @if($publication->owner_logo !=null)
                                        <div class="col-sm-6">
                                            <span class="alert alert-warning">تصویر قبلی</span>
                                            <img src="{{publication_assets_path}}/{{$publication->dir}}/{{$publication->owner_logo}}" class="poster"/>
                                        </div>
                                    @else
                                        <img src="#" class="poster"/>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="alert bg-primary">وضعیت مقاله
                                            @if($publication->active == 0 )
                                                <span class="alert alert-danger">غیرفعال</span>
                                            @elseif($publication->active == 1)
                                                <span class="alert alert-success">فعال</span>
                                            @else
                                                <span class="alert alert-warning">فعال (عدم ارسال مقاله)</span>
                                            @endif
                                            </p>
                                        </div>
                                    </div><hr/>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <label for="active" style="margin:6px;">فعال</label>
                                            <input type="radio" name="active" id="active" class="vertical_middle" value="1" {{ $publication->active == 1 ? 'checked' : '' }}/>
                                        </div>
                                        <div class="col-sm-2">
                                            <label for="no_active" style="margin:6px;">غیرفعال</label>
                                            <input type="radio" name="active" id="no_active" class="vertical_middle" value="0" {{ $publication->active == 0 ? 'checked' : '' }}/>
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="yes_no_article" style="margin:6px;">فعال (عدم ارسال مقاله)</label>
                                            <input type="radio" name="active" id="yes_no_article" class="vertical_middle" value="2" {{ $publication->active == 2 ? 'checked' : '' }}/>
                                        </div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="form-group tal" style="margin:4px;">
                                    <input type="submit" value="ویرایش نشریه" class="btn btn-primary"/>
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

    <input type="hidden" value="{{$publication->major_id}}" id="major"/>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            let group_id = $("#group_id").val();
            let major_id = $("#major_id");
            let major = $("#major").val();
            $.ajax({
                'url' : '{{route('admin.publication.majors.group')}}' ,
                'type' : 'POST' ,
                'data' : { '_token':"{{csrf_token()}}", 'group':group_id} ,
                'dataType': 'json',
                'success' : function(data){
                    major_id.empty();
                    $.each(data, (key, value) => {
                        let major_name = JSON.parse(value.name);
                        if(value.id == major) {
                            major_id.append('<option value="' + value._id + '" selected>' + major_name.en + '</option>');
                        }else{
                            major_id.append('<option value="' + value._id + '">' + major_name.en + '</option>');
                        }
                    });
                }
            });
        });

        $("#group_id").change(function(){
            let _token = $("#_token").val();
            let id = $(this).children(":selected").attr("value");
            let major_id = $("#major_id");
            $.ajax({
                'url' : '/admin/publication/majors/group' ,
                'type' : 'POST' ,
                'data' : {_token , id} ,
                'dataType' : 'json' ,
                'success' : function(data){
                    major_id.empty();
                    for(let i=0; i<data.length; i++){
                        let major_name = JSON.parse(data[i].name);
                        major_id.append('<option value="'+data[i]._id+'">'+ major_name.en +'</option>');
                    }
                }
            });
        });

        function setYearsByLang(e){
            let first_publish_year = $("#first_publish_year");
            first_publish_year.empty();
            switch ($(e).val()){
                case 'en':
                    for(let i = 2019; i>=1994; i--) {
                        first_publish_year.append('<option value="'+i+'" class="rtl">'+i+' میلادی </option>')
                    }
                    break;

                case 'fa':
                    for(let i = 1398; i>=1370; i--) {
                        first_publish_year.append('<option value="'+i+'" class="rtl">'+i+' شمسی </option>')
                    }
                    break;

                case 'ar':
                    for(let i = 1440; i>=1425; i--) {
                        first_publish_year.append('<option value="'+i+'" class="rtl">'+i+' قمری </option>')
                    }
                    break;
            }
        }
    </script>
@endsection