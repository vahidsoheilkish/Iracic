@extends('admin.master')
@section('styles')
    <style>
        #all_conferences_tbl th,td{  text-align: center; overflow-y: scroll; margin:0; padding:10px 4px !important; vertical-align: middle; }
        #all_conferences_tbl th{ font-size:14px;  }
        #all_conferences_tbl td{  font-size: 12px; }
        .btn_a{padding: 0;  border: none;  background: inherit;  display: inline;}
        .btn_a:hover{cursor: pointer}
        .form_remove{vertical-align: middle; display: inline;}
        .form_remove:hover{}
        .active_publication{font-size:12px; font-family: Arial; font-weight: bolder; }
        .active_publication:hover{cursor: pointer; color:#222 !important; background: #f1c40f !important; }
        .remove_icon{position: relative; left:3px;}
        .edit_icon{line-height: 17px;}
        .submenu_option{background-color: #fff; box-shadow:0px 0px 5px #222222; padding:4px; list-style: none; position:absolute; display: none; border-radius: 4px; margin-right: -33px !important;min-width: 160px;}
        .submenu_option li {cursor:pointer; color:#222222; padding:6px 5px;text-align: right; border-radius:6px; font-size:13px;}
        .submenu_option li:hover { text-align: right; background-color: #993365; color:#fff;}
        .submenu_option a { text-decoration: none; color:#222;}
        .setting_icon{vertical-align: middle; margin:3px; min-width:20px; float:right;}
        .setting_text{text-align: left;}
        #btn_setting{font-size:12px; line-height: normal;}
        .red{color:#ff394f}
        .green{color:#0ac282}
        .icon_plus:hover{cursor: pointer;  transition: .3s;}
        .swal-modal{  width:750px !important;  }
        .swal-title{direction: rtl}
        .swal-text{direction: rtl}
        #publication_title{ padding:5px; color:#ff0f30; text-align: right; direction: rtl; font-weight:bolder }
        #publication_header{ padding:5px;  text-align: right; direction: rtl;  font-size:13px;}
        .conf_lang{margin:4px 0; border-radius:4px; padding:2px;}
        .conf_lang:hover{cursor: pointer;}
        .conf_poster{width:75px; box-shadow:0 0 4px #0800dd; border-radius: 4px;}
        .volumes_row{display: none;}
        .add_volume{color:forestgreen; vertical-align: middle;  margin: 0 4px;}
        .add_volume:hover{cursor: pointer; color: #c4b400; transition: .3s}
    </style>
@endsection

@section('content')
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row rtl">
                        <div class="col-sm-4">
                            <h2>لیست کنفرانس ها</h2>
                        </div>
                    </div>
                    <div class="row rtl">
                        @include('message.errors')
                        <div class="col-sm-12" style="overflow-y: scroll;">
                            <table id="all_conferences_tbl" class="table table-bordered table-responsive-lg">
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>زبان</th>
                                    <th>گروه</th>
                                    <th>رشته</th>
                                    <th>کاربر کنفرانس</th>
                                    <th>عنوان</th>
                                    <th>زبان</th>
                                    <th>کشور</th>
                                    <th>ناشر</th>
                                    <th>نوع کنفرانس</th>
                                    <th>نحوه دسترسی</th>
                                    <th>DOI</th>
                                </tr>
                                @foreach($conferences as $conference)
                                    @php($conference_subjects = json_decode($conference->conference_subjects) )
                                    @php($description = json_decode($conference->description) )
                                    <tr>
                                        @php( $loop_index = $loop->index + 1 )
                                        <td><span class="fa fa-plus icon_plus green" onclick="displayVolumes(this , {{$loop_index}})"></span></td>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $conference->lang }}</td>
                                        <td>{{ $conference->group_id }}</td>
                                        <td>{{ $conference->major_id }}</td>
                                        <td>{{ $conference->conference_user_id }}</td>
                                        <td>
                                            <p onclick="main_lang(this,'title')" data-title="{{$conference->title}}" class="alert-success conf_lang">زبان اصلی</p>
                                        </td>
                                        <td> {{$conference->lang }} </td>
                                        <td> {{ $conference->country }} </td>
                                        <td> {{ $conference->conference_publisher }} </td>
                                        <td>@if($conference->conference_type == "fulltext")
                                                Fulltext
                                            @elseif($conference->conference_type == "abstract")
                                                Abstract
                                            @endif
                                        </td>
                                        <td>@if($conference->access == "open")
                                                دسترسی آزاد
                                            @elseif($conference->conference_type == "money")
                                                نقدی
                                            @endif
                                        </td>
                                        <td>{{ $conference->DOI }}</td>
                                        <td class="options">
                                            <button id="btn_setting" class="btn btn-sm btn_purple" onclick="openSetting(this)">تنظیمات
                                                <span class="fa fa-caret-down" style="vertical-align: middle"></span>
                                            </button>
                                            <ul class="submenu_option close" style="display: block !important;">
                                                <li>
                                                    <a href="{{ route('admin.conference.new.volume' , ['conference'=>$conference->id]) }}">
                                                        <span class="fa fa-android ml-2"></span>
                                                        ثبت دوره
                                                    </a>
                                                </li>
                                                <li data-toggle="modal" data-target="#sendNotification" conference-title="{{$conference->title}}" conference-id="{{$conference->conference_user_id}}" onclick="openNotificationModal(this)">
                                                    ارسال Notification<span class="fa fa-sticky-note setting_icon"></span>
                                                </li>
                                                <li>
                                                    <a href="{{ route('admin.conference.edit' , ['conference'=>$conference->id]) }}" id="submenu_option ">
                                                        <span class="fa fa-edit setting_icon" style="vertical-align: -4px;"></span>
                                                        ویرایش کنفرانس
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                        <td>
                                            @if($conference->active==0)
                                                <span class="label label-danger active_publication" conference-id="{{$conference->id}}" onclick="changeActive(this)">Inactive</span>
                                            @else
                                                <span class="label label-success active_publication" conference-id="{{$conference->id}}" onclick="changeActive(this)">Active</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if(  $conference->volumes()->exists()  )
                                        <tr colspan="12" class="volumes_row volume_row_{{$loop_index}}" style="background-color: #c48b9f;">
                                            <td>#</td>
                                            <td>تاریخ شروع</td>
                                            <td>تاریخ پایان</td>
                                            <td>محورها - موضوعات</td>
                                            <td>شهر</td>
                                            <td>ایمیل</td>
                                            <td>مکان برگزاری</td>
                                            <td style="font-weight: bolder">تنظیمات</td>
                                        </tr>
                                        @foreach($conference->volumes as $index => $volume)
                                            <tr class="volumes_row volume_row_{{$loop_index}}" style="background-color: #ffeeff">
                                                <td>{{$index + 1}}</td>
                                                <td>{{$volume->startDate}}</td>
                                                <td>{{ $volume->endDate }}</td>
                                                <td>{{ $volume->city }}</td>
                                                <td>{{ $volume->email }}</td>
                                                <td>{{ $volume->place }}</td>
                                                <td>
                                                    <div style="display: inline-flex">
                                                        <a href="#" style="margin:0 4px;">
                                                            <span class="fa fa-2x fa-edit volume_edit"></span>
                                                        </a>
                                                        <a href="{{ route('admin.conference.volume.articles',['volume'=>$volume->id]) }}">
                                                            <span class="fa fa-2x fa-address-book add_volume"></span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr colspan="12" class="volumes_row volume_row_{{$loop_index}}">
                                            <td colspan="10" class="red">دوره ای برای این نشریه وجود ندارد</td>
                                        </tr>
                                    @endif
                              @endforeach
                          </table>
                      </div>
                      <div class="tac" style="margin:30px auto;">
                          {!! $conferences->render() !!}
                      </div>
                  </div>
              </div>
          </div>
          <div id="styleSelector">
          </div>
      </div>
  </div>

  <!-- The Conference send notification -->
  <div class="modal fade" id="sendNotification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header rtl">
                  <h4 class="modal-title tar" id="exampleModalLabel">ارسال پیام</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body rtl">
                  @if(isset($conference))
                      <form action="{{ route('admin.conference.send.notification' , ['conferenceUser'=>$conference->id]) }}" method="post">
                              @csrf
                              <input type="hidden" id="conference_id_notification" name="conference_user_id"/>
                              <div class="form-group">
                                  <label for="message">متن پیام</label>
                                  <textarea name="message" id="message" class="form-control" rows="4"></textarea>
                              </div>
                          <div class="modal-footer rtl">
                              <button type="submit" class="btn btn-sm btn-success">ارسال پیام</button>
                          </div>
                      </form>
                  @endif
              </div>
          </div>
      </div>
  </div>
@endsection

@section('scripts')
  <script>
      CKEDITOR.replace('message' ,{
          contentsLangDirection: 'rtl'
      });
      $(document).ready(function(){
          $(".submenu_option").css('display','none');
          $(".submenu_option li").mouseenter(function(){
              $(this).find('a,span').each(function(){
                 $(this).css('color','#fff');
              });
          });
          $(".submenu_option li").mouseleave(function(){
              $(this).find('a,span').each(function(){
                  $(this).css('color','#222');
              });
          });

          $(".volume_update").click(function(){
              let id = $(this).attr('volume-id');
              let year = $(this).attr('volume-year');
              $("#conference_update").val(id);
              $("#volume_year").val(year);
          });

          $("#volume_update").click(function(){
              let id = $("#conference_update").val();
              let year = $("#volume_year").val();
              let _csrf = $("#_csrf").val();
              $.ajax({
                  'url' : '/admin/conference/volume/update/'+id ,
                  'method' : 'post',
                  'data' : {'_token': _csrf , 'year' : year , 'id' : id} ,
                  'dataType' : 'json' ,
                  'success' : function(data){
                      if(data.message=='success'){
                          swal("ویرایش شد", "سال دوره به "+data.year+" تغییر کرد", "success");
                          setTimeout(function(){
                              location.reload();
                          },1500);
                      }
                  }
              });
          });

      });

      function openNotificationModal(e){
          let id = $(e).attr('conference-id');
          let title = $(e).attr('conference-title');
          $("#conference_id_notification").val(id);
          $("#conference_title").html(title);

      }

      function openSetting(e){
          let parent = $(e).parent();
          let ul = parent.children("ul");
          console.log(ul);
          if(ul.hasClass('close')){
              ul.slideDown("fast");
              ul.removeClass("close");
              ul.addClass("open");
          } else if(ul.hasClass('open')){
              ul.slideUp("fast");
              ul.removeClass("open");
              ul.addClass("close");
          }
      }
      function closeSettings(){
          $('.submenu_option').each(function () {
              $(this).addClass('close');
              $(this).removeClass('open');
              $(this).fadeOut(200);
          });
      }
      // $(".options").mouseleave(function(){
      //     closeSettings();
      // });
      $(".options").mouseleave(function(){
          closeSettings();
      });
      function changeActive(event){
          swal({
              title: "توجه",
              text: "آیا نسبت به فعال/غیرفعال کردن نشریه اطمینان دارید ؟",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
              .then((willUpdate) => {
                  if (willUpdate) {
                      let _token = $("#_token").val();
                      $.ajax({
                          'url' : '/admin/conference/edit/active/' + $(event).attr('conference-id') ,
                          'type' : 'POST' ,
                          'data' : {'_token' : '{{ csrf_token() }}'} ,
                          'dataType' : 'json' ,
                          'success' : function(data){
                              if(data.message == 'success'){
                                  if(data.target == 'success'){
                                      $(event).removeClass('label-danger');
                                      $(event).addClass('label-success');
                                      $(event).html("Active");
                                  }else{
                                      $(event).removeClass('label-success');
                                      $(event).addClass('label-danger');
                                      $(event).html("Inactive");
                                  }
                              }
                          }
                      });
                  } else {
                      return false;
                  }
              });
      }

      $(".volume_delete_form").submit(function(e){
          let form = this;
          e.preventDefault();
          swal({
              title: "جهت حذف عبارت delete را وارد کنید",
              text: "آیا نسبت به حذف دوره (volume) نشریه اطمینان دارید ؟",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              content: "input",
              html: true
          })
              .then((value) => {
                  if(value=="delete"){
                      form.submit();
                  }else if(value==""){
                      swal("جهت حذف باید عبارت delete را وارد کنید");
                      return false;
                  }else{
                      swal("عبارت delete وارد نشده است!");
                      return false;
                  }
              });
      });

      $(".form_remove").submit(function(e){
          let form = this;
          e.preventDefault();
          swal({
              title: "جهت حذف عبارت delete را وارد کنید",
              text: "آیا نسبت به حذف کاربر نشریه اطمینان دارید ؟",
              icon: "warning",
              buttons: true,
              dangerMode: true,
              content: "input",
              html: true
          })
              .then((value) => {
                  if(value=="delete"){
                      form.submit();
                  }else if(value==""){
                      swal("جهت حذف باید عبارت delete را وارد کنید");
                      return false;
                  }else{
                      swal("عبارت delete وارد نشده است!");
                      return false;
                  }
              });
      });

      function main_lang(target,type){
          switch (type){
              case 'title':
                  swal($(target).attr('data-title'));
                  break;
              case 'subject':
                  swal($(target).attr('data-subject'));
                  break;
              case 'description':
                  swal($(target).attr('data-description'));
                  break;
          }
      }

      function second_lang(target,type){
          switch (type){
              case 'title':
                  swal($(target).attr('data-title'));
                  break;
              case 'subject':
                  swal($(target).attr('data-subject'));
                  break;
              case 'description':
                  swal($(target).attr('data-description'));
                  break;
          }
      }


      function displayVolumes(e , id){
          if ( $(e).hasClass('fa-plus') ){
              $(".volume_row_"+id).show("fast");
              $(e).removeClass("fa-plus");
              $(e).removeClass("green");
              $(e).addClass("fa-minus");
              $(e).addClass("red");
          }else{
              $(".volume_row_"+id).hide("fast");
              $(e).removeClass("fa-minus");
              $(e).removeClass("red");
              $(e).addClass("fa-plus");
              $(e).addClass("green");
          }
      }
  </script>
@endsection