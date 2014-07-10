@extends('site.layouts.default')
@section('title')
	{{$yinbiao->name}}的国际音标及其读法，相关单词，相关发音规则，相关例句 国际音标童声教育课堂 
	@parent
@stop
@section('keywords')
	{{$yinbiao->name}}的国际音标，{{$yinbiao->name}}的国际音标读法，{{$yinbiao->name}}的相关词相关例句，音标，音标表，国际音标，英语音标学习
@stop
@section('description')	
	{{$yinbiao->name}}的国际音标，英语国际音标是自然拼读法的基础，本系列教程以音标，音标相关单词，单词拼音的相关规则，单词相应的句子为学习的引导线，组织严谨科学，配音由外国语小学满分学生朗读
	@parent
@stop
@section('content')
	<div class="container">	




		<ul class="list-unstyled">
		<li>
		<div style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
		<div>
		<h1 style="display:inline;margin-right:20px">{{link_to_route('yinbiao.show',$yinbiao->name,$yinbiao->id,['class'=>'yinbiaoatag'])}}</h1>
		<span id="yinbiao_1"><i class="clickable glyphicon glyphicon-volume-up"></i>点击发音</span>
		<audio id="yinbiaoplayer"></audio>
		</div>
		<h2>所属类别：{{link_to_route('yinbiaocategory.show',$yinbiao->yinbiaocategory->ybcategory,$yinbiao->yinbiaocategory->id,['class'=>'yinbiaocatatag'])}} </h2>
		</div>
		<!-- 发音规则分类 -->

{{--*/$layoutloopcount=0;/*--}}
		@foreach ($yinbiao->fayinguizes as $fayinguize)	
			@if ($layoutloopcount%2==0)
				<div class="row">				
			@endif
		{{--*/$layoutloopcount++;/*--}}
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-success">
						<div class="panel-heading">
							<?php Give::javascript(['guizerelatedwords_'.$layoutloopcount =>$fayinguize->regex,'admin'=>'king of kidist']);?>
						<h3 class="panel-title">{{link_to_route('fayinguize.show',$fayinguize->title,$fayinguize->id,['class'=>'yinbiaocatatag'])}}</h3>
						</div>
						<div class="panel-body" id='guizerelatedwords_{{$layoutloopcount}}'>
							@foreach ($fayinguize->relatedwords as $relatedword)
								<span style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px"> {{link_to_route('relatedword.show',$relatedword->wordtext,$relatedword->id,['class'=>'yinbiaoatag'])}} </span>			
							@endforeach
							<p> <a href="http://kidsit.cn/yinbiao/"><i class="font4e rightbottom glyphicon glyphicon-tree-conifer "></i></a></p>
						</div>

				    </div>	
				    
				</div>	

			@if ($layoutloopcount%2==0)
				</div>				
			@endif	
			

		@endforeach
		</li>
		</ul>

	</div>
@stop
@section('scripts')
	<script type="text/javascript" src="{{ asset('bootstrap/js/highlightppattern.js') }}"></script>
	<script type="text/javascript">var mp3='{{$yinbiao->mp3}}';var ppatternregex='{{$yinbiao->fayinguizes->first()->regex}}'</script>
@stop