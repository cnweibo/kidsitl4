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
	<link rel="stylesheet" href={{ asset('htmlapp/libs/angular-busy/dist/angular-busy.css')}}>
	<link rel="stylesheet" href="{{asset('htmlapp/assets/custom.css')}}">
@stop
@section('bodyhead')
<body style="position:relative" ng-app="kidsitApp" ng-controller="kidsitAppCtrl" ng-strict-di>
	<div cg-busy="currentPromise" style="position:absolute;top:50%;left:50%" ></div>
@overwrite
@section('loginctrlform')
<ul ng-cloak class="nav navbar-nav pull-right" id="top-nav-right" ng-controller="loginCtrl">
    <li ng-if="userloggedinfo.isAdmin"><a href="{{{ URL::to('admin') }}}">管理控制台</a></li>

    <li ng-cloak ng-if="userloggedinfo.username"><a href="{{{ URL::to('user') }}}">登录为： [[userloggedinfo.username]]</a></li>
    <li ng-if="userloggedinfo.username"><a href="" ng-click="doLogout()">退出</a></li> 

    <li ng-if="!userloggedinfo.username"><a href="#" ng-click="login()">登录</a></li>
    <li ng-if="!userloggedinfo.username"><a href="{{{ URL::to('user/create') }}}" target="_blank">{{{ Lang::get('site.sign_up') }}}</a></li>
</ul>
@overwrite
@section('content')
<div class="contentwrapper">

	<script type="text/ng-template" id="loginmenu.html">
		<ul class="nav navbar-nav pull-right" id="top-nav-right" >
		</ul>
	</script>
	<script type="text/ng-template" id="loginform.html">
		<div id="loginform" class="well" ng-show="user.showLogin">
			<div class="page-header">
				<h1>登录进入系统</h1>
			</div>
			<form name="loginform" class="form-horizontal" accept-charset="UTF-8" data-ng-submit="doLogin()">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			    <fieldset>
			        <div class="form-group">
			            <label class="col-md-5 control-label" for="email">{{ Lang::get('confide::confide.username_e_mail') }}</label>
			            <div class="col-md-7">
			                <input ng-model="logininput.email" class="form-control" tabindex="1" placeholder="{{ Lang::get('confide::confide.username_e_mail') }}" type="text" name="email" id="email" value="{{ Input::old('email') }}">
			            </div>
			        </div>
			        <div class="form-group">
			            <label class="col-md-5 control-label" for="password">
			                {{ Lang::get('confide::confide.password') }}
			            </label>
			            <div class="col-md-7">
			                <input ng-model="logininput.password" class="form-control" tabindex="2" placeholder="{{ Lang::get('confide::confide.password') }}" type="password" name="password" id="password">
			            </div>
			        </div>

			        <div class="form-group">
			            <div class="col-md-offset-5 col-md-7">
			                <div class="checkbox">
			                    <label for="remember">{{ Lang::get('confide::confide.login.remember') }}
			                        <input ng-model="logininput.remember" type="hidden" name="remember" value="0">
			                        <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">
			                    </label>
			                </div>
			            </div>
			        </div>

			        @if ( Session::get('error') )
			        <div class="alert alert-danger">{{ Session::get('error') }}</div>
			        @endif

			        @if ( Session::get('notice') )
			        <div class="alert">{{ Session::get('notice') }}</div>
			        @endif

			        <div class="form-group">
			            <div class="col-md-offset-2 col-md-10">
			                <button tabindex="3" type="submit" class="btn btn-primary">{{ Lang::get('confide::confide.login.submit') }}</button>
			                <a class="btn btn-default" href="forgot">{{ Lang::get('confide::confide.login.forgot_password') }}</a>
			            </div>
			        </div>
			    </fieldset>
			</form>
		</div>	
	</script>
	<script type="text/ng-template" id="examrow.html">
	<span>
		<span style="display:inline-block;width:30px;font-size:0.6em" class="label label-success">[[id]]</span>
		
		<span ng-if="isVisualColumn(row,1)" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,1)]">[[row.operand1]]</span> 
		<span ng-if="!isVisualColumn(row,1) && showAnswer" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,1)]">([[row.operand1]])</span> 
		<span ng-form="inputform1"><input ng-blur="updateScore()" ng-disabled="!canInputAnswer" ng-if="!isVisualColumn(row,1) && !showAnswer " class="answerInput" type="text" data-ng-model="row.myanswerdata"></span>
		
		<span ng-if="category == 'plus'" style="display:inline-block;width:20px;font-size: 0.8em">+</span>  
		<span ng-if="category == 'times'" style="display:inline-block;width:20px;font-size: 0.8em">x</span>  

		<span ng-if="isVisualColumn(row,2)" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,2)]">[[row.operand2]]</span>  
		<span ng-if="!isVisualColumn(row,2) && showAnswer" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,2)]">([[row.operand2]])</span> 
		<span ng-form="inputform2"><input ng-blur="updateScore()" ng-disabled="!canInputAnswer" ng-if="!isVisualColumn(row,2) && !showAnswer " class="answerInput" type="text" data-ng-model="row.myanswerdata"></span>
		
		= 

		<span ng-if="isVisualColumn(row,3)" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,3)]"><span  ng-if="category == 'plus'">[[row.sumdata]]</span><span  ng-if="category == 'times'">[[row.multiplydata]]</span></span>  
		<span ng-if="!isVisualColumn(row,3) && showAnswer" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,3)]">(<span  ng-if="category == 'plus'">[[row.sumdata]]</span><span  ng-if="category == 'times'">[[row.multiplydata]]</span>)</span> 
		<span ng-form="inputform3"><input ng-blur="updateScore()" ng-disabled="!canInputAnswer" ng-if="!isVisualColumn(row,3) && !showAnswer "  class="answerInput" type="text" data-ng-model="row.myanswerdata"></span>
		<span check-result category="category" my-row="row" has-input="inputform1.$dirty || inputform2.$dirty || inputform3.$dirty" answer='row.myanswerdata' check-answer-realtime="checkAnswerRealtime"></span>
	</span>
	</script>
	<script type="text/ng-template" id="checkresult.html">
		<span>
			<span class="answerTF" data-ng-show="hasInput && (checkAnswerRealtime || hasSubmittedAnsweres) && !isRevisioning && checkData(myRow,answer)"><label class="label label-danger"><span class="glyphicon glyphicon-ok"></span></label></span>
			<span class="answerTF" data-ng-show="hasInput && (checkAnswerRealtime || hasSubmittedAnsweres || isRevisioning) && (!checkData(myRow,answer))"><label class="label label-danger"><span class="glyphicon glyphicon-remove"></span></label></span>
		</span>
	</script>

	<div class="row">
		<div login-form class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-push-3">
			
		</div>
	</div>
	<div class="mathwrapper">
		<!-- <div class="container"> -->
		<h1 style="text-align: center;">IT宝贝网低年级数学计算同步练习题库 
			<!--  -->
		</h1>
		<!-- pageslide -->
		<h4 ng-cloak id="exammeta" style="margin-bottom: 10px;" class="aligncenter">本试卷创建于 [[examdata.examCreatedate]] <span class="label label-warning">试卷查询地址:</span> <a data-ng-href="http://kidsit.cn/math/exams/[[examdata.examID]]" target="_blank">http://kidsit.cn/math/exams/[[examdata.examID]]</a></h4> 
		
		
			<h4><span ng-cloak class="aligncenter inlineblock"><strong>姓名:</strong><strong style="color:red" ng-show="userloggedinfo.username"> [[userloggedinfo.username]] </strong><strong ng-show="!userloggedinfo.username">_____ </strong> <strong>分数:</strong><span class="score"> <strong ng-show="(!mathexam.hasSubmitted)&&(!mathexam.checkAnswerRealtime)"> ______</strong> <strong ng-show="mathexam.hasSubmitted || mathexam.checkAnswerRealtime" style="color:red; position: absolute; top: -15px" fade-value-change="mathexam.score"> [[mathexam.score|number]] </strong></span>
					<span ng-cloak timer timerid="examCountTimer" autostart="false" interval="1000" exported-timer-val="exportedTimerVal">已用时：<strong style="color:red">[[mminutes]] </strong>分 <strong style="color:red">[[sseconds]]</strong> 秒  
						
					</span>
					<div class="btn-group">
							<button type="button" class="btn btn-primary" ng-disabled="metadata.shouldDisabled1" ng-click="startExamTimer('examCountTimer')"><i class="glyphicon glyphicon-time"></i> 开始做题</button>
							<button type="button" class="btn btn-danger"  ng-disabled="metadata.shouldDisabled2" ng-click="stopExamTimer('examCountTimer')"><i class="glyphicon glyphicon glyphicon-pause"></i>暂停</button>
							<button type="button" class="btn btn-success"  ng-disabled="metadata.shouldDisabled3" ng-click="resumeExamTimer('examCountTimer')"><i class="glyphicon glyphicon-play"></i>继续</button>
							<button type="button" class="btn btn-warning"  ng-disabled="metadata.shouldDisabled4" ng-click="submitAnswers()"><i class="glyphicon glyphicon-ok"></i> 交卷</button>
							<button type="button" class="btn btn-info"  ng-disabled="metadata.shouldDisabled5" ng-click="revisionAnswers()"><i class="glyphicon glyphicon-pencil"></i>订正</button>
							<button tooltip-placement="bottom" tooltip="1.点击开始做题启动计时才能答题;2.答题中可以暂停和继续;3.交卷需要登录" type="button" class="btn btn-info"  ng-click=""><i class="glyphicon glyphicon-info-sign"></i></button>
					
					</div>
				</span>        
			</h4>
			<ng-view></ng-view>

		<!-- </div> end of container -->
		<div class="rightsidebarwrapper">
			<div class="mathsidebar" ng-cloak>
				<a href="javascript:window.print()" class="sidebarhref" tooltip-placement="left" tooltip="打印本试卷"><span class="glyphicon glyphicon-print fa-2x"></span></a>
				<!-- toggleShowSetting($event); -->
				<a href="#" data-ng-click="toggleShowSetting($event)" class="sidebarhref" tooltip-placement="left" tooltip="打开配置面板，配置当前试卷答题模式，或按需调阅新试卷"><span class="glyphicon glyphicon-cog fa-2x"></span></a>
				<div toggle-answer-view-and-animcate trigger="mathexam.showAnswer" ></div>
				<a href="#" data-ng-click="toggleshowReports($event)" class="sidebarhref" tooltip-placement="left" tooltip="学习成绩和进度报告" data-trigger="mouseenter"><span class="glyphicon glyphicon-stats fa-2x"></span></a>
			</div>
			<div pageslide ps-speed="0.5" ps-size="300px" ps-open="isOpened" ps-custom-right="41px" class="pageslidesidebar">
			        <div ng-cloak ng-show="isOpened" class="text-left sidetoolbar">
						<h3>试卷配置面板</h3>
						<form name="helpForm" novalidate role="form">
							<div class="well">
							<div>
								<span>题目类型：</span>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" id="inlineRadio1" value="plus"> 加
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" id="inlineRadio2" value="minus"> 减
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" id="inlineRadio3" value="times"> 乘
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" id="inlineRadio4" value="division"> 除
								</label>
							</div>
							<div>
								<span>位数：</span>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" id="inlineRadio1" value="1"> 1位
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" id="inlineRadio2" value="2"> 2位
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" id="inlineRadio3" value="3"> 3位
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" id="inlineRadio4" value="4"> 4位
								</label>
							</div>
						    <div>
						    	<span>难度：</span>
						    	<label class="radio-inline radio-inline-toolbar-small">
						    	  <input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" id="inlineRadio1" value="1"> 1级
						    	</label>
						    	<label class="radio-inline radio-inline-toolbar-small">
						    	  <input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" id="inlineRadio2" value="2"> 2级
						    	</label>
						    	<label class="radio-inline radio-inline-toolbar-small">
						    	  <input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" id="inlineRadio3" value="3"> 3级
						    	</label>
						    	<label class="radio-inline radio-inline-toolbar-small">
						    	  <input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" id="inlineRadio4" value="4"> 4级
						    	</label>
						    </div>
							<div>
								<span>题数：</span>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" id="inlineRadio1" value=20> 20
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" id="inlineRadio2" value=50> 50
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" id="inlineRadio3" value=100> 100
								</label>
							</div>
							<div>
								<span>限时模式：</span>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" id="inlineRadio1" value="5"> 5
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" id="inlineRadio2" value="10"> 10
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" id="inlineRadio3" value="15"> 15
								</label>
								<label class="radio-inline radio-inline-toolbar-small">
								  <input type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" id="inlineRadio4" value="20"> 20
								</label>
							</div>	
					        	<p class="ng-scope"><span class="label label-default">[[mathexam.mathCategory|examTixing]]</span> 
									<span class="label label-default">[[mathexam.mathDigitNumbers]]位数</span> 
									<span class="label label-default">[[mathexam.mathDifficulty]]级难度</span> 
									<span class="label label-default">[[mathexam.mathQuantity]]题</span>
								</p>
								<button type="submit" data-ng-click="createExam();isOpened=false;clearExamTimer('examCountTimer') " class="btn btn-danger">调阅新试卷</button>
							</div>
							<div class="well">
								<span>批卷模式：</span>
								<br>
								<p>
									<label class="radio-inline radio-inline-toolbar-small">
									  <input type="radio" name="mathPijuanMode" data-ng-model="mathexam.checkAnswerRealtime" id="inlineRadio1" ng-value="true"> 边答题边批卷
									</label>
									<label class="radio-inline radio-inline-toolbar-small">
									  <input type="radio" name="mathPijuanMode" data-ng-model="mathexam.checkAnswerRealtime" id="inlineRadio2" ng-value="false"> 交卷时一次性批卷
									</label>
								</p>
								<button type="submit" data-ng-click="isOpened=false" class="btn btn-danger">应用到本试卷</button>
							</div>
					    </form>
			        	
			        </div> <!-- end of side toolbar content -->
			</div>
			<div pageslide ps-speed="0.5" ps-size="600px" ps-open="showReports" ps-custom-right="41px" class="pageslidesidebar">
		        <div ng-show="showReports" class="text-left sidetoolbar">
		        	<!-- imporvement chart section -->
		        	<div ng-controller="improvementChartsCtrl">
		        <!-- 	<div class="row">
		        		<div class="col-sm-10">
		        			<input ng-model="chartConfig.title.text">
					        <button ng-click="addSeries()">Add Series</button>
		                    <button ng-click="addPoints()">Add Points to Random Series</button>
		                    <button ng-click="removeRandomSeries()">Remove Random Series</button>
		                  	<button ng-click="swapChartType()">line/bar</button>

		        		</div>
		        	</div> -->
		        	<div class="row">
		        		<highchart id="chart1" config="chartConfig" class="span10"></highchart>
		        	</div>
		        	</div>		
				</div>
			</div>
		</div><!-- end of contentwrapper -->	
	</div>

<!-- examAppCtrl -->
@stop


@section('scripts')
	

	<script type="text/javascript" src="{{asset('dist/appMath.min.js')}}"></script>

@stop
