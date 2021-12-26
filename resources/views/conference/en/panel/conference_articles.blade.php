@extends('conference.en.panel.master')

@section('styles')
    <style>
        #articles_list th{text-align: center;}
        #articles_list tr td:nth-child(even){text-align: center;}
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @php($conference_title = json_decode($conference->title) )
            <h2>Articles list of {{ $conference_title->l1 }} conference</h2>
            <table id="articles_list" class="table table-bordered">
                <tr>
                    <th>Article title</th>
                    <th>Edit</th>
                </tr>
                @foreach($articles as $article)
                    <tr>
                        @if($article->active == 0 )
                            <td class="bg alert-warning">{{ $article->title }}</td>
                            <td><a href="{{route('conference.notice.article.edit',['article'=>$article->id])}}"><span class="fa fa-edit" style="vertical-align: middle;font-size:16px; margin:0 4px;"></span>Edit article</a></td>
                        @else
                            <td class="bg alert-success">{{ $article->title }}</td>
                            <td>---</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("*:not('#menu_list')").removeClass('active');
        });
    </script>
@endsection