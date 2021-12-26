@extends('conference.en.panel.master')


@section('content')

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_dashboard')").removeClass('active');
        });
    </script>
@endsection