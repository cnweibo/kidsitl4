@extends('site.layouts.default')
@section('title')
	小学一年级二年级三年级数学二位数三位数四位数加减乘除同步练习试卷
	@parent
@stop
@section('keywords')
	小学数学数学同步练习系统，二位数加减乘除法，三位数加减乘除法，四位数加减乘除同步练习试卷，一年级数学练习，二年级数学练习，三年级数学练习
@stop
@section('description')	
	小学数学数学同步练习系统，适合一年级二年级三年级小学生二位数三位数四位数加减乘除同步练习，自动出题，自动批卷
	@parent
@stop
@section('css')
	<link rel="stylesheet" href="{{ asset('bootstrap/css/printmath.css') }}">
@stop
@section('content')
<h1 style="text-align: center;">IT宝贝网低年级数学计算同步练习题库(试卷id:{{$examid}}) <a href="javascript:window.print()"><span class="glyphicon glyphicon-print fa-2x"></span></a></h1>
<h4 style="margin-bottom: 10px;" class="aligncenter">本试卷创建于 {{$examcreatedat}} <span class="label label-warning">试卷永久网址:</span> <a href="http://kidsit.cn/math/exams/{{$examid}}">http://kidsit.cn/math/exams/{{$examid}}</a></h4> 
<hr>
	<div id="examcontainer" class="container">	
		{{--*/$layoutloopcount=0;/*--}}
		@foreach (array_chunk($exercises,3) as $row)
			<div class="row">
				<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-push-1 ">
					<div class="row	exerciserow">
						@foreach ($row as $exercise)
						{{--*/++$layoutloopcount;/*--}}
							<article class="col-md-4">
								<span style="display:inline-block;width:30px;font-size:0.6em" class="label label-success">{{$layoutloopcount}}</span>
								<span style="display:inline-block;width:40px;font-size: 0.8em">{{$exercise['operand1']}}</span> 
								<span style="display:inline-block;width:20px;font-size: 0.8em">+</span>  
								
								<span style="display:inline-block;width:40px;font-size: 0.8em">{{$exercise['operand2']}}</span>  
								= <span class="answerdata" data-ng-show="mathexam.showAnswer">(&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp)</span>
							</article>
						@endforeach
					</div>
				</div>
			</div>
		@endforeach
	</div>
@stop