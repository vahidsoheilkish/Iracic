@extends('conference.en.panel.master')

@section('styles')
    <style>
        .seen{ color:green; margin-top:4px;}
        .not_seen{ color:tomato; margin-top:4px; }
        .center_icon{ vertical-align:middle; text-align: center; }
        .empty_btn{border:1px solid #f1f1f1; border-radius:8px; vertical-align: middle; background-color: #ffffff;}
    </style>
@endsection


@section('content')
    @if(count($notifications)>0)
    <table class="table table-bordered">
        <tr>
            <th>Message</th>
            <th>Seen</th>
        </tr>
        @foreach($notifications as $notification)
            <tr>
                <td>{{ $notification->message }}</td>
                <td class="center_icon">
                    @if($notification->seen === 0)
                        <button class="empty_btn" notification-id="{{$notification->id}}" onclick="change_seen(this)"> <span class="fa fa-2x fa-close not_seen"></span></button>
                    @else
                        <button class="empty_btn" notification-id="{{$notification->id}}" onclick="change_seen(this)"><span class="fa fa-2x fa-check-circle seen"></span></button>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-sm-12 tac" style="margin:2px auto">
            {!! $notifications->render()  !!}
        </div>
    </div>
    @else
        <h4 class="alert alert-danger tac">No notification</h4>
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_notification')").removeClass('active');
        });

        function change_seen(target){
            let id = $(target).attr("notification-id");
            $.ajax({
                'url':  '{{route("conference.notice.change.notification.seen") }}'  ,
                'type' : 'post',
                'data' : { id, '_token':"{{csrf_token()}}" } ,
                'dataType' : 'json',
                'success' : function(data){
                    if(data.message=="success"){
                        $(target).children("span").removeClass("fa-check-circle");
                        $(target).children("span").removeClass("seen");
                        $(target).children("span").addClass("fa-close");
                        $(target).children("span").addClass("not_seen");
                    }else{
                        $(target).children("span").removeClass("fa-close");
                        $(target).children("span").removeClass("not_seen");
                        $(target).children("span").addClass("fa-check-circle");
                        $(target).children("span").addClass("seen");
                    }
                }
            });
        }
    </script>
@endsection