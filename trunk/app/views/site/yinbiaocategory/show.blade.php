@extends('site.layouts.default')
@section('title')
	{{$ybcategory->ybcategory}}国际音标类别的所有音标，音标对应的样例单词，相关发音规则，相关例句 国际音标童声教育课堂 
	@parent
@stop
@section('keywords')
	{{$ybcategory->ybcategory}}的国际音标分类表，{{$ybcategory->ybcategory}}音标类别下的相关样例词样例句，音标，音标表，国际音标，英语音标学习
@stop
@section('description')	
	{{$ybcategory->ybcategory}}的国际音标类别，{{$ybcategory->description}},英语国际音标是自然拼读法的基础，本系列教程以音标，音标相关单词，单词拼音的相关规则，单词相应的句子为学习的引导线，组织严谨科学，配音由外国语小学满分学生朗读
	@parent
@stop
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
		<p>{{link_to_route('yinbiaocategory.index','浏览全部音标分类')}}</p>
		</li>
		</ul>
	</div>
@stop