<html>
<head>
	<meta charset="UTF-8"/>
	<style>
		span{font-size:12px !important;}
		p{font-size:12px !important;text-align:justify;}
		.context_title{font-weight: bolder; font-stretch: expanded}
		.context_text{font-size:10px;}
		.article_file_container{color:#222;text-align:center;}
		.article_image{width:200px; border-radius:10px;margin:10px;}
		.resource_container{margin:5px; padding:10px;  border-bottom:2px solid #222; }
		.row {display: -webkit-box;display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;}
	</style>
</head>
<body style="background-color:#ffffff;font-family:tahoma;">
<div style="width:100%; display:flex; border-top:1px solid #000; border-bottom:4px solid #000; margin:50px auto; ">
	<div style="width:11%; margin:10px 0 0 0; float:left; border-radius:2px;">
		<img src="{{public_path('img/pdf/logo.png')}}" style="height:150px;"/>
	</div>
	<div style="width:67%; float:left; clear:right; text-align:center; background-color:#a9a434;margin:0 10px;">
		<p style="font-size:9px; margin:0; padding:4px; text-align:center;">Contents lists available at ScienceDirect</p>
		<h4 style="font-weight:bolder; margin:40px; padding:4px;">{{ $article->title }}</h4>
		<p style="font-size:9px; padding:2px; margin:0; text-align: center">journal homepage:
			<a href="www.elsevier.com/locate/yjbin" style="font-size:9px;">www.elsevier.com/locate/yjbin</a>
		</p>
	</div>
	<div style="width:11%; float:left; margin:10px 0 0 20px; border-radius:2px;">
		<img src="{{public_path('img/pdf/publication.jpg')}}" style="height:150px;"/>
	</div>
	<p style="margin:1px;"></p>
</div>

<div style="margin:5px auto;">
	<h4 style="padding:20px; font-weight:normal;">{{ $article->title }}</h4>
	<div style="margin:20px;">
		@foreach($authors as $author)
			<span style="font-size:12px; margin:4px;">{{$author->name}}
				@if(!$loop->last)
					;
				@endif
            </span>
		@endforeach
	</div>
	<ul style="list-style:none;">
		@foreach($authors as $author)
			<li style="font-size:12px; margin:4px;">{{ $author->dependency }}</li>
		@endforeach
	</ul>
</div>

<div style="margin:5px;">
	<div style="width:20%;float:left;">
		<h5 style="letter-spacing:8px; padding-bottom:5px; border-bottom:1px solid #222;">ARTICLE INFO</h5>
		<div style="display:inline-grid">
			<span style="font-size:10px;">{{ $article->keywords }}</span>
		</div>
	</div>
	<div style="margin:6px; width:70%;float:right;">
		<h5 style="letter-spacing:8px; padding-bottom:5px; border-bottom:1px solid #222;">ABSTRACT</h5>
		<span style="line-height:26px;">
            {{ $abstract->en }}
        </span>
	</div>
</div>
<div style="clear:both;"></div><hr/>

<div style="margin:5px;">
	@if($structs)
		@foreach($structs as $key=>$struct)
			<h5 class="context_title">
				{{ $struct->title }}
			</h5>
			@php($col = round(strlen($struct->text) / 2000) )
			<div style="width:100%;">
				<p class="context_text">{{ $struct->text }}</p>
			</div>
			{{--@for($i=0 ; $i<(int)$col; $i++)--}}
			{{--<div class="row">--}}
			{{--<div style="width:45%;float:left; margin:12px;">--}}
			{{--<p class="context_text">{{ substr($struct->text, $i , 2000 ) }}</p>--}}
			{{--</div>--}}
			{{--<div style="width:45%;float:left; margin:12px;">--}}
			{{--<p class="context_text">{{ substr($struct->text, 2000 , 4000) }}</p>--}}
			{{--</div>--}}
			{{--</div>--}}
			{{--@endfor--}}
            <?php $json =  json_decode($struct->imgInfo) ?>
			<div style="width:100%;">
				@if($json)
					@for($i=0 ; $i<count($json->img) ; $i++)
						<div class="article_file_container">
							<img class="article_image" src="{{public_path($json->img[$i])}}" /><br/>
							<span style="color:#222;font-size:9px;">{{  $json->des[$i] }}</span>
						</div>
					@endfor
					<hr/>
				@endif
			</div>
		@endforeach
	@endif
</div>

<div style="margin:20px 0;">
	<h5 style="border-bottom:2px solid #222; padding:10px 0; margin:20px 0;">Refrences: </h5>
	@foreach($resource as $res)
		<div class="resource_container">
			<span style="color:#4dc0b5;">[{{$loop->index +1}}]</span>
			{{ $res }}
		</div>
	@endforeach
</div>

</body>
</html>