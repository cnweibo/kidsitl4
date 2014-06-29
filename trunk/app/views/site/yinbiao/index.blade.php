@extends('site.layouts.default')
@section('content')
	<div class="container">	
	@foreach ($yinbiaos as $yinbiao)
		<li>
		<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
			 <h1>{{$yinbiao->name}}</h1>
			 <h2>所属类别：{{link_to_route('yinbiaocategory.show',$yinbiao->yinbiaocategory->ybcategory,$yinbiao->yinbiaocategory->id)}} </h2>
		</div>
		</li>
	@endforeach
		</ul>
	</div>
@stop