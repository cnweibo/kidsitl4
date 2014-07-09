@extends('site.layouts.default')
@section('title')
	{{$relatedword->relatedword}}国际音标类别的所有音标，音标对应的样例单词，相关发音规则，相关例句 国际音标童声教育课堂 
	@parent
@stop
@section('keywords')
	{{$relatedword->relatedword}}的国际音标分类表，{{$relatedword->relatedword}}音标类别下的相关样例词样例句，音标，音标表，国际音标，英语音标学习
@stop
@section('description')	
	{{$relatedword->relatedword}}的国际音标类别，{{$relatedword->description}},英语国际音标是自然拼读法的基础，本系列教程以音标，音标相关单词，单词拼音的相关规则，单词相应的句子为学习的引导线，组织严谨科学，配音由外国语小学满分学生朗读
	@parent
@stop
@section('content')

	<div class="container">	
		{{--*/$layoutloopcount=0;/*--}}

			@if ($layoutloopcount%2==0)
				<div class="row">				
			@endif
		{{--*/$layoutloopcount++;/*--}}
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-success">
						<div class="panel-heading">
						<h3 class="panel-title">{{link_to_route('relatedword.show',$relatedword->wordtext,$relatedword->id,['class'=>'yinbiaocatatag'])}}</h3>
						</div>
						<div class="panel-body">
							<h4>{{$relatedword->wordyinbiao}}</h4>
							@foreach ($relatedword->relatedsentences as $relatedsentence)
								<p class="relatedsentence">{{$relatedsentence->sentencetext}}</p>
							@endforeach
							<div>
								<span id="yinbiao_1"><i class="clickable glyphicon glyphicon-volume-up"></i>点击发音</span>
								<audio id="yinbiaoplayer"></audio>
							</div>
						</div>
				    </div>	
				</div>	
			@if ($layoutloopcount%2==0)
				</div>				
			@endif	

			<p>{{link_to_route('relatedword.index','浏览全部例词')}}</p>

	</div>
@stop
@section('scripts')
	<script type="text/javascript">var mp3='{{$relatedword->mp3}}';</script>
@stop