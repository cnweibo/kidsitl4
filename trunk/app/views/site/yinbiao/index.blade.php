@extends('site.layouts.default')
@section('title')
	国际音标童声教育课堂 
	@parent
@stop
@section('keywords')
	音标，音标表，国际音标，英语音标学习
@stop
@section('description')	
	英语国际音标是自然拼读法的基础，本系列教程以音标，音标相关单词，单词拼音的相关规则，单词相应的句子为学习的引导线，组织严谨科学，配音由外国语小学满分学生朗读
	@parent
@stop
@section('content')
	<div class="container">	
		<ul class="list-unstyled">
	@foreach ($yinbiaos as $yinbiao)
		<li>
		<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
			 <div>
			 <h1 style="display:inline;margin-right:20px">{{link_to_route('yinbiao.show',$yinbiao->name,$yinbiao->id,['class'=>'yinbiaoatag'])}}</h1>
			 <i class="glyphicon glyphicon-volume-up"></i>
			 </div>
			 <h2>所属类别：{{link_to_route('yinbiaocategory.show',$yinbiao->yinbiaocategory->ybcategory,$yinbiao->yinbiaocategory->id,['class'=>'yinbiaocatatag'])}} </h2>
		</div>
		</li>
	@endforeach
		</ul>
	</div>
@stop