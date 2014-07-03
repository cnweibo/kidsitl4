@extends('site.layouts.default')
@section('title')
	国际音标发音规则表，音标对应的样例单词，样例例句 国际音标童声教育课堂 
	@parent
@stop
@section('keywords')
	国际音标发音规则表，国际音标学习，音标类别相关样例词样例句，音标，音标表，国际音标，英语音标学习
@stop
@section('description')	
	各种国际音标发音规则表，对应该规则相应列出对应样例单词，样例句子，国际音标学习，按音标类别浏览国际音标，英语国际音标是自然拼读法的基础，本系列教程以音标，音标相关单词，单词拼音的相关规则，单词相应的句子为学习的引导线，组织严谨科学，配音由外国语小学满分学生朗读
	@parent
@stop
@section('content')
	<div class="container">	
		<ul class="list-unstyled">
		@foreach ($fayinguizes as $fayinguize)
			<li>
			<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
				<h1>{{link_to_route('fayinguize.show',$fayinguize->title,$fayinguize->id,['class'=>'yinbiaocatatag'])}} </h1>
				<p>{{$fayinguize->description}}</p>
			</div>
			</li>
		@endforeach
		</ul>
	</div>
@stop