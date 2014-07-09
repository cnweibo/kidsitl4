@extends('site.layouts.default')
@section('title')
	国际音标分类表，单元音，双元音，半元音，爆破音，摩擦音，破擦音，鼻音，舌侧音，音标对应的样例单词，相关发音规则，相关例句 国际音标童声教育课堂 
	@parent
@stop
@section('keywords')
	国际音标分类表，按音标类别浏览国际音标，音标类别相关样例词样例句，音标，音标表，国际音标，英语音标学习
@stop
@section('description')	
	国际音标分类表，单元音，双元音，半元音，爆破音，摩擦音，破擦音，鼻音，舌侧音，按音标类别浏览国际音标，英语国际音标是自然拼读法的基础，本系列教程以音标，音标相关单词，单词拼音的相关规则，单词相应的句子为学习的引导线，组织严谨科学，配音由外国语小学满分学生朗读
	@parent
@stop
@section('content')
	<div class="container">	
		{{--*/$layoutloopcount=0;/*--}}
		@foreach ($yinbiaocategories as $ybcategory)
			@if ($layoutloopcount%2==0)
				<div class="row">				
			@endif
		{{--*/$layoutloopcount++;/*--}}
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					<div class="panel panel-success">
						<div class="panel-heading">
						<h3 class="panel-title">{{link_to_route('yinbiaocategory.show',$ybcategory->ybcategory,$ybcategory->id,['class'=>'yinbiaocatatag'])}}</h3>
						</div>
						<div class="panel-body">
							<h4>{{$ybcategory->description}}</h4>
							@foreach ($ybcategory->yinbiao as $yinbiao)
								<span style="font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px"> {{link_to_route('yinbiao.show',$yinbiao->name,$yinbiao->id,['class'=>'yinbiaoatag'])}} </span>			
							@endforeach
						</div>
				    </div>	
				</div>	
			@if ($layoutloopcount%2==0)
				</div>				
			@endif	
			

		@endforeach
	</div>
@stop