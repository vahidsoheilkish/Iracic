@extends('publication.en.dashboard.master')

@section('styles')
    <style>
        #submit_container{text-align: right; padding:30px; margin:20px auto !important; border-radius:10px; box-shadow:0 0 5px #000}
        #publication_create_container input::placeholder{text-align: left;}
        #publication_create_container {text-align: left;}
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div id="submit_container" class="col-sm-12">
                <h3 class="tal" style="color:tomato;">Submit Journal</h3><hr/>
                @include('message.en.errors')
                <form action="{{ route('publication.store') }}" method="post" class="form-horizontal" id="publication_create_container" novalidate>
                    <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
                    <div class="form-group">
                        <label for="group_id" style="margin:6px;">Group</label>
                        <select name="group_id" id="group_id" class="form-control" required>
                            <option></option>
                            @foreach($groups_list as $group)
                                @php( $group_name= json_decode($group->name) )
                                <option value="{{ $group->id }}">{{ $group_name->en }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="major_id" style="margin:6px;">Major</label>
                        <select name="major_id" id="major_id" class="form-control" required>
                        </select>
                    </div>
                    <div class="row">
                        <span class=" alert alert-warning">Language</span>
                    </div>
                    <div class="row form-group" >
                        <div class="col-sm-3">
                            <label for="lang_en">English</label>
                            <input type="radio" name="lang" id="lang_en" class="radio" value="en" onclick="setYearsByLang(this)" checked style="vertical-align:-4px; margin:0 3px;"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="lang_fa">فارسی</label>
                            <input type="radio" name="lang" id="lang_fa" class="radio" value="fa" onclick="setYearsByLang(this)" style="vertical-align:-4px; margin:0 3px;"/>
                        </div>
                    </div>
                    <div class="row">
                        <span class="alert alert-warning">Publication articles type</span>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3">
                            <label for="abstract">Abstract</label>
                            <input type="radio" name="publication_type" id="abstract" class="radio" value="abstract" onclick="setYearsByLang(this)" checked style="vertical-align:-2px; margin:0 3px;"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="fulltext">Fulltext</label>
                            <input type="radio" name="publication_type" id="fulltext" class="radio" value="fulltext" onclick="setYearsByLang(this)" style="vertical-align:-2px; margin:0 3px;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" style="margin:6px;">Title of publication</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter title of publication" required value="{{ old('title') }}"/>
                    </div>
                    <div class="form-group">
                        <label for="publish_order" style="margin:6px;">Publish order</label>
                        <select class="form-control" name="publish_order" id="publish_order">
                            <option value="month">Monthly</option>
                            <option value="season">Quarterly</option>
                            <option value="half-year">Semester</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="first_publish_year">The first year of publication</label>
                        <select name="first_publish_year" id="first_publish_year" class="form-control rtl" style="text-align: right">
                            @for($i = 2019; $i>=1994; $i--)
                                <option value="{{$i}}" class="rtl"> {{$i}} میلادی</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="website" style="margin:6px;">Website of publication</label>
                        <input type="text" name="website" id="website" class="form-control" placeholder="Enter website of publication" required value="{{ old('website') }}"/>
                    </div>
                    <div class="form-group">
                        <label for="captcha">Security Code</label>
                        <input type="text" id="captcha" name="captcha" class="form-control" placeholder="Enter security code">
                        @captcha
                    </div>
                    <div class="form-group tal" style="margin:4px;">
                        <input type="submit" value="Submit journal" class="btn btn-success"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <p id="result"></p>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_journal_register')").removeClass('active');
            let group_list = $("#group_id");
            for(let i = 0; i < group_list.length; i++) {
                group_list[i].selectedIndex =0;
            }
            $("#lang_en").trigger('click');
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

        $("#group_id").change(function(){
            $("#progressbar").show("fast");
            let _token = $("#_token").val();
            let id = $(this).children(":selected").attr("value");
            let major_id = $("#major_id");
            $.ajax({
                'url' : '/publication/majors/group/'+id ,
                'type' : 'POST' ,
                'data' : {_token , id} ,
                'dataType' : 'json' ,
                'success' : function(data){
                    setTimeout(function(){
                        $("#progressbar").hide("fast");
                    } , 500);
                    major_id.empty();
                    for(let i=0; i<data.length; i++){
                        let major_name = JSON.parse(data[i].name);
                        major_id.append('<option value="'+data[i]._id+'">'+ major_name.en +'</option>');
                    }
                }
            });
        });
    </script>
@endsection