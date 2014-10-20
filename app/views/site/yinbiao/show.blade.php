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
@section('css')
	<link rel="stylesheet" href={{ asset('bootstrap/css/printyinbiaoshow.css')}}>
@stop
@section('bodyhead')
<body ng-app="kidsitApp" ng-controller="kidsitAppCtrl">
@overwrite
@section('content')
<script type="text/ng-template" id="guestaddedwords.html">
	<ul class="nopadding guestaddwordul">
		<li class="inlineblock guestaddword" ng-repeat="wordadded in wordsadded"><span class="label label-default label-sm wordaddlabel"><small ng-bind="wordadded.wordtext"></small></span></li>
		<form style="display:inline" class="form-inline" ng-submit="addword()">
		    <span style="display:inline-block">
		    	<input type="text" name="wordadded" id="inputWordadded" class="guestaddwordinput" ng-model="newwordadded">
				<button type="submit" class="btn btn-info btn-xs">我来加词</button>
			</span>
		</form>		
	</ul>
</script>
<script type="text/ng-template" id="singleword.html">
	<p id="[[wordDom]]" class="inlineblock wordyinbiaoblock">
		<span class="elementblock wordtext"> <a href="[[wordFollowUrl]]">[[wordText]]</a> </span>
		<em class="elementblock wordyinbiao"> [[wordYinbiao]] </em>
		<small class="elementblock yinbiaoshu" ng-click="mp3Play(mp3File)"> <i class="clickable glyphicon glyphicon-music"></i>:[[wordYinjieshu]]</small>
	</p>
</script>
	<div class="container" mp3-player>
		<ul class="list-unstyled">
		<li>
		<div class="yinbiaoshowheader row" style="margin-bottom:10px;margin-left:13px;font-family:Lucida Sans Unicode,Arial Unicode MS;letter-spacing: 5px;font-size:20px">
		<div>
		<h1 style="display:inline;margin-right:20px">{{link_to_route('yinbiao.show',$yinbiao->name,$yinbiao->id,['class'=>'yinbiaoatag'])}}</h1>
		<span id="yinbiao_1"><i class="clickable glyphicon glyphicon-volume-up"></i>点击发音</span>
		<span>所属类别：{{link_to_route('yinbiaocategory.show',$yinbiao->yinbiaocategory->ybcategory,$yinbiao->yinbiaocategory->id,['class'=>'yinbiaocatatag'])}} </span>
		<a href="javascript:window.print()"><span class="glyphicon glyphicon-print fa-2x"></span></a>
		</div>
		
		</div>
		</li>
		</ul>
		<!-- 发音规则分类 -->

{{--*/$layoutloopcount=0;/*--}}
		@foreach ($yinbiao->fayinguizes as $fayinguize)	
			@if ($layoutloopcount%2==0)
				<div class="row">				
			@endif
		{{--*/$layoutloopcount++;/*--}}
				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" highlight-chars dom-id="ppatternregex_{{$layoutloopcount}}" pt="<?php echo $fayinguize->regex?$fayinguize->regex : "No_Regex_Defined";?>">
					<div class="panel panel-success">
						<div class="panel-heading">
							<span  ></span> 
						<h3 style="display:inline;margin-right:20px" class="panel-title">{{link_to_route('fayinguize.show',$fayinguize->title,$fayinguize->id,['class'=>'yinbiaocatatag'])}}</h3>
						<em style="font-weight: bolder">{{$fayinguize->description}}</em>
						<!-- <?php $words=[];?> <?php foreach ( Fayinguize::find(4)->relatedwords->toArray() as $relateword) ?> <?php array_push($words,'#wd_'.$relateword["id"]); ?> <?php echo json_encode($words); ?> -->
						<span >顺序跟读</span>
						</div>
						<div class="panel-body" id='ppatternregex_{{$layoutloopcount}}'>
							@foreach ($fayinguize->relatedwords as $relatedword)
								<p hover-animate single-word mp3-file="{{$relatedword->mp3}}" word-dom="wd_{{$fayinguize->id}}_{{$relatedword->id}}" word-follow-url="http://kidsit.cn/relatedword/{{$relatedword->id}}" 
								   word-yinbiao = "{{$relatedword->wordyinbiao}}" word-yinjieshu="{{$relatedword->yinjieshu}}" class="inlineblock wordyinbiaoblock" word-text="{{$relatedword->wordtext}}"></p>
							@endforeach
							<hr class = "guestaddwordhr">
						<ul guest-added-words fayinguizeid ={{ $fayinguize->id }} yinbiaoid = {{$yinbiao->id}}>
						</ul>
							<div class="rightbottom"> <a href="http://kidsit.cn/yinbiao/"><i class="font2e glyphicon glyphicon-tree-conifer kidsittreeback"></i></a></div>
						</div>

				    </div>	
				    
				</div>	

			@if ($layoutloopcount%2==0)
				</div>				
			@endif	
			

		@endforeach


	</div>
@stop
@section('scripts')
	<script type="text/javascript" src="{{ asset('bootstrap/js/angular.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/angularinit.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/ng-animate.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/TweenMax.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/kidsitanimatelib.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/highlightppattern.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/guestaddword.js') }}"></script>
	<script type="text/javascript" src="{{ asset('bootstrap/js/yinbiaoapp.js') }}"></script>
	<script type="text/javascript">var mp3='{{$yinbiao->mp3}}';//var ppatternregex='{{(is_null($yinbiao->fayinguizes->first())) ? 'Not_assigned_ppattern' : $yinbiao->fayinguizes->first()->regex}}';</script>
    @include('phptojsvariables')
@stop