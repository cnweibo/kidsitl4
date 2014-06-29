@extends('site.layouts.default')
@section('content')
	<div class="container">	
		<li>
		<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
			<h1>{{$ybcategory->ybcategory}}</h1>
			<p>{{$ybcategory->description}}</p>
			<hr>
			<?php $yinbiaos = $ybcategory->yinbiao; ?>
			@foreach ($yinbiaos as $yinbiao)
				<p>音标：{{$yinbiao->name}}</p>			
			@endforeach
	
		</div>
		</li>
		</ul>
	</div>
@stop