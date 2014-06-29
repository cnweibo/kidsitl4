@extends('site.layouts.default')
@section('content')
	<div class="container">	
		<ul class="list-unstyled">
	@foreach ($yinbiaos as $yinbiao)
		<li>
		<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
			 <h1>{{link_to_route('yinbiao.show',$yinbiao->name,$yinbiao->id,['class'=>'yinbiaoatag'])}}</h1>
			 <h2>所属类别：{{link_to_route('yinbiaocategory.show',$yinbiao->yinbiaocategory->ybcategory,$yinbiao->yinbiaocategory->id,['class'=>'yinbiaocatatag'])}} </h2>
		</div>
		</li>
	@endforeach
		</ul>
	</div>
@stop