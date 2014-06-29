@extends('site.layouts.default')
@section('content')
	<div class="container">	
		<ul class="list-unstyled">
		<li>
		<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
			<h1>{{link_to_route('yinbiaocategory.show',$ybcategory->ybcategory,$ybcategory->id,['class'=>'yinbiaocatatag'])}}</h1>
			<p>{{$ybcategory->description}}</p>
			<hr>
			<?php $yinbiaos = $ybcategory->yinbiao; ?>
			@foreach ($yinbiaos as $yinbiao)
				<p>音标：{{link_to_route('yinbiao.show',$yinbiao->name,$yinbiao->id,['class'=>'yinbiaoatag'])}}</p>			
			@endforeach
	
		</div>
		<p>{{link_to_route('yinbiao.index','浏览全部音标分类')}}</p>
		</li>
		</ul>
	</div>
@stop