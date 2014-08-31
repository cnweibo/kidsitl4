@extends('site.layouts.default')
@section('title')
	小学一年级二年级三年级数学二位数三位数四位数加减乘除同步练习试卷出题系统
	@parent
@stop
@section('keywords')
	小学数学数学同步练习出题系统，二位数加减乘除法，三位数加减乘除法，四位数加减乘除同步练习试卷，一年级数学练习，二年级数学练习，三年级数学练习
@stop
@section('description')	
	小学数学数学同步练习出题系统，适合一年级二年级三年级小学生二位数三位数四位数加减乘除同步练习，自动出题，自动批卷
	@parent
@stop
@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/printmath.css') }}" media="print"/>
    <link rel="stylesheet" href="{{asset('bootstrap/fonts/font-awesome-4.1.0/css/font-awesome.min.css')}}">
@stop
@section('content')
<div ng-app="examApp" ng-controller="examAppCtrl">
<h1 style="text-align: center;">IT宝贝网低年级数学计算同步练习题库 <a href="javascript:window.print()"><span class="glyphicon glyphicon-print fa-2x"></span></a></h1>
<hr>
	<div class="container">	
		<form id="examcustom" style="display:inline" class="form-inline" ng-submit="createExam()">
		    <span style="display:inline-block">   
		    <div class="form-group">
		    	<span> 题型: </span>
		    	<label class="radio inline"><input type="radio" name="mathCategory" ng-model="mathexam.mathCategory" value="plus" check="checked"> 加</label>
		    	<label class="radio inline"><input type="radio" name="mathCategory" ng-model="mathexam.mathCategory" value="minus"> 减</label>
			    <label class="radio inline"><input type="radio" name="mathCategory" ng-model="mathexam.mathCategory" value="times"> 乘</label>
				<label class="radio inline"><input type="radio" name="mathCategory" ng-model="mathexam.mathCategory" value="division"> 除</label>				
			</div>
			
			<div class="form-group">
				<span> | 位数:</span>
		    	<label class="radio inline"><input type="radio" name="mathDigitNumbers" ng-model="mathexam.mathDigitNumbers" value="1"> 1位数</label>
		    	<label class="radio inline"><input type="radio" name="mathDigitNumbers" ng-model="mathexam.mathDigitNumbers" value="2"> 2位数</label>
			    <label class="radio inline"><input type="radio" name="mathDigitNumbers" ng-model="mathexam.mathDigitNumbers" value="3"> 3位数</label>
				<label class="radio inline"><input type="radio" name="mathDigitNumbers" ng-model="mathexam.mathDigitNumbers" value="4" check="checked"> 4位数</label>				
			</div>
			
			<div class="form-group">
				<span> | 难度:</span>
		    	<label class="radio inline"><input type="radio" name="mathDifficulty" ng-model="mathexam.mathDifficulty" value="1"> 1级</label>
		    	<label class="radio inline"><input type="radio" name="mathDifficulty" ng-model="mathexam.mathDifficulty" value="2"> 2级</label>
			    <label class="radio inline"><input type="radio" name="mathDifficulty" ng-model="mathexam.mathDifficulty" value="3"> 3级</label>
				<label class="radio inline"><input type="radio" name="mathDifficulty" ng-model="mathexam.mathDifficulty" value="4" check="checked"> 4级</label>				
			</div>
			
			<div class="form-group">
				<span> | 题数:</span>
				<label class="radio inline"><input type="radio" name="mathQuantity" ng-model="mathexam.mathQuantity" value="20"> 20</label>
		    	<label class="radio inline"><input type="radio" name="mathQuantity" ng-model="mathexam.mathQuantity" value="50" check="checked">50</label>
			    <label class="radio inline"><input type="radio" name="mathQuantity" ng-model="mathexam.mathQuantity" value="100"> 100</label>			
			</div>
   				<button type="submit" ng-click="createExam()" class="btn btn-info btn-xs btn-large">开始做题</button>
				<label class="checkbox inline"><input type="checkbox" name="mathShowAnswer" ng-model="mathexam.showAnswer">看答案 </label>			
			</span>
		</form>	
		<div> <span>本试卷创建于 [[examdata.examCreatedate]] <span class="label label-warning">查询地址:</span> <a href="http://kidsit.cn/math/exams/[[examdata.examID]]">http://kidsit.cn/math/exams/[[examdata.examID]]</a></span> </div>	
		<hr>

		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-push-1 ">
				<div class="row	exerciserow">
			    	<article class="col-md-4" ng-repeat="examrow in examdata.examdata">
			    		<span style="display:inline-block;width:30px;font-size:0.6em" class="label label-success">[[$index+1]]</span>
			    		<span style="display:inline-block;width:40px;font-size: 0.8em">[[examrow.operand1]]</span> 
			    		<span style="display:inline-block;width:20px;font-size: 0.8em">+</span>  
		
			    		<span style="display:inline-block;width:40px;font-size: 0.8em">[[examrow.operand2]]</span>  
			    		= (<span ng-show="mathexam.showAnswer" style="display:inline-block;width:45px;color: blue; font-size: 0.8em">[[examrow.sumdata]]</span><span ng-show="!mathexam.showAnswer">&nbsp&nbsp&nbsp&nbsp &nbsp&nbsp</span>)
			    	</article>
			    </div>
			</div>    	
	</div>
</div>
</div><!-- examAppCtrl -->
@stop
@section('scripts')
	<script src="{{asset('bootstrap/js/angular.js')}}"></script>
	<script src="{{asset('bootstrap/js/examApp.js')}}"></script>
@stop
