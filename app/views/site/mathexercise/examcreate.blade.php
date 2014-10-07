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
@stop
@section('loginctrlform')
<ul ng-cloak class="nav navbar-nav pull-right" id="top-nav-right" ng-controller="loginCtrl">
    <li ng-if="userloggedinfo.isAdmin"><a href="{{{ URL::to('admin') }}}">管理控制台</a></li>

    <li ng-if="userloggedinfo.username"><a href="{{{ URL::to('user') }}}">登录为： [[userloggedinfo.username]]</a></li>
    <li ng-if="userloggedinfo.username"><a href="" ng-click="doLogout()">退出</a></li> 

    <li ng-if="!userloggedinfo.username"><a href="#" ng-click="login()">登录</a></li>
    <li ng-if="!userloggedinfo.username"><a href="#" ng-click="signup()">{{{ Lang::get('site.sign_up') }}}</a></li>
</ul>
@overwrite
@section('content')
<div >

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
		<span ng-form="inputform1"><input ng-disabled="!canInputAnswer" ng-if="!isVisualColumn(row,1) && !showAnswer " class="answerInput" type="text" data-ng-model="row.myanswerdata"></span>
		
		<span style="display:inline-block;width:20px;font-size: 0.8em">+</span>  

		<span ng-if="isVisualColumn(row,2)" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,2)]">[[row.operand2]]</span>  
		<span ng-if="!isVisualColumn(row,2) && showAnswer" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,2)]">([[row.operand2]])</span> 
		<span ng-form="inputform2"><input ng-disabled="!canInputAnswer" ng-if="!isVisualColumn(row,2) && !showAnswer " class="answerInput" type="text" data-ng-model="row.myanswerdata"></span>
		
		= 

		<span ng-if="isVisualColumn(row,3)" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,3)]">[[row.sumdata]]</span>  
		<span ng-if="!isVisualColumn(row,3) && showAnswer" ng-class="{true: 'examdata', false: 'answerdata'}[isVisualColumn(row,3)]">([[row.sumdata]])</span> 
		<span ng-form="inputform3"><input ng-disabled="!canInputAnswer" ng-if="!isVisualColumn(row,3) && !showAnswer "  class="answerInput" type="text" data-ng-model="row.myanswerdata"></span>
		<span check-result my-row="row" has-input="inputform1.$dirty || inputform2.$dirty || inputform3.$dirty" answer='row.myanswerdata' check-answer-realtime="checkAnswerRealtime"></span>
	</span>
	<script type="text/ng-template" id="checkresult.html">
		<span>
			<span class="answerTF" data-ng-if="hasInput && checkAnswerRealtime && checkData(myRow,answer)"><label class="label label-danger"><span class="glyphicon glyphicon-ok"></span></label></span>
			<span class="answerTF" data-ng-if="hasInput && checkAnswerRealtime && (!checkData(myRow,answer))"><label class="label label-danger"><span class="glyphicon glyphicon-remove"></span></label></span>
		</span>
	</script>
	</script>
	<div class="row">
		<div login-form class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-lg-push-3">
			
		</div>
	</div>
<h1 style="text-align: center;">IT宝贝网低年级数学计算同步练习题库 
	<a href="javascript:window.print()"><span tooltip-placement="top" tooltip="打印本试卷" class="glyphicon glyphicon-print fa-2x"></span></a>
	<a href="#" data-ng-click="showconf.showSettings = !showconf.showSettings"><span tooltip-placement="top" tooltip="打开配置面板，按需重新调阅" style="margin-left:10px;" class="glyphicon glyphicon-cog fa-2x"></span></a>
	<div toggle-answer-view-and-animcate trigger="mathexam.showAnswer" ></div>
</h1>
<h4 ng-cloak id="exammeta" style="margin-bottom: 10px;" class="aligncenter">本试卷创建于 [[examdata.examCreatedate]] <span class="label label-warning">试卷查询地址:</span> <a data-ng-href="http://kidsit.cn/math/exams/[[examdata.examID]]" target="_blank">http://kidsit.cn/math/exams/[[examdata.examID]]</a></h4> 
	<div class="container">	
		<div ng-cloak ng-show="showconf.showSettings" class="aligncenter">
			<div class="panel panel-info">
				  <div class="panel-heading">
						<h3 class="panel-title">试卷配置及考试配置面板</h3>
				  </div>
				  <div class="panel-body">
						<tabset>
							<p><span class="label label-default">[[mathexam.mathCategory | examTixing]]</span> 
								<span class="label label-default">[[mathexam.mathDigitNumbers]]位数</span> 
								<span class="label label-default">[[mathexam.mathDifficulty]]级</span> 
								<span class="label label-default">[[mathexam.mathQuantity]]题</span>
								<button type="submit" data-ng-click="createExam();showconf.showSettings = null;clearExamTimer('examCountTimer') " class="btn btn-danger btn-lg">调阅试卷</button>
							</p>
						    <tab heading="题型">
				    	    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="plus" check="checked"> 加</label>
				    	    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="minus"> 减</label>
				    		    <label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="times"> 乘</label>
				    			<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="division"> 除</label>				
						    </tab>
						  	<tab heading="位数">
				  		    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="1"> 1位数</label>
				  		    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="2"> 2位数</label>
				  			    <label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="3"> 3位数</label>
				  				<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="4" check="checked"> 4位数</label>				
				  			
						  	</tab>
						  	<tab heading="难度">
						    	    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="1"> 1级</label>
						    	    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="2"> 2级</label>
						    		    <label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="3"> 3级</label>
						    			<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="4" check="checked"> 4级</label>				
						    		</tab>
						  	<tab heading="题数">
				  				<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" value="20"> 20</label>
				  		    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" value="50" check="checked">50</label>
				  			    <label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" value="100"> 100</label>			
				  			
						  	</tab>
						  	<tab heading="在线考试模式">
						  		<section>
						  			<h6 class="text-success bg-success inlineblock">计时模式：给定时间，在该时间内，做对的题目越多越好</h6>
					  					<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" value="5" > 5分钟</label>
					  			    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" value="10" check="checked">10分钟</label>
					  					<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" value="15"> 15分钟</label>
					  			        <label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathTimeToDo" data-ng-model="mathexam.timetodo" value="20"> 20分钟</label>			
						  		</section>
								<section>
									<h6 class="text-success bg-success inlineblock">计量模式：给定题目数量，计算时间，时间越短成绩越好</h6>
										<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathqtocount" data-ng-model="mathexam.mathQuantity" value="20"> 20道题</label>
								    	<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathqtocount" data-ng-model="mathexam.mathQuantity" value="50" check="checked">50道题</label>
										<label style="display:inline" class="radio inline"><input style="float:none" type="radio" name="mathqtocount" data-ng-model="mathexam.mathQuantity" value="100"> 100道题</label>	
								</section>
						  	</tab>
						</tabset>
				  </div>
			</div>
			
			<form id="examcustom" style="display:inline" class="form-inline" data-ng-submit="createExam()">
			    <span style="display:inline-block">   
			    <div class="form-group">
			    	<label class="radio inline"><input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="plus" check="checked"> 加</label>
			    	<label class="radio inline"><input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="minus"> 减</label>
				    <label class="radio inline"><input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="times"> 乘</label>
					<label class="radio inline"><input type="radio" name="mathCategory" data-ng-model="mathexam.mathCategory" value="division"> 除</label>				
				</div>
				
				<div class="form-group">
					<span> | 位数:</span>
			    	<label class="radio inline"><input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="1"> 1位数</label>
			    	<label class="radio inline"><input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="2"> 2位数</label>
				    <label class="radio inline"><input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="3"> 3位数</label>
					<label class="radio inline"><input type="radio" name="mathDigitNumbers" data-ng-model="mathexam.mathDigitNumbers" value="4" check="checked"> 4位数</label>				
				</div>
				
				<div class="form-group">
					<span> | 难度:</span>
			    	<label class="radio inline"><input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="1"> 1级</label>
			    	<label class="radio inline"><input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="2"> 2级</label>
				    <label class="radio inline"><input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="3"> 3级</label>
					<label class="radio inline"><input type="radio" name="mathDifficulty" data-ng-model="mathexam.mathDifficulty" value="4" check="checked"> 4级</label>				
				</div>
				
				<div class="form-group">
					<span> | 题数:</span>
					<label class="radio inline"><input type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" value="20"> 20</label>
			    	<label class="radio inline"><input type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" value="50" check="checked">50</label>
				    <label class="radio inline"><input type="radio" name="mathQuantity" data-ng-model="mathexam.mathQuantity" value="100"> 100</label>			
				</div>
						<button tooltip-placement="top" tooltip="启动考试计时" type="submit" data-ng-click="createExam()" class="btn btn-info btn-xs btn-large">开始做题</button>
							
				</span>
			</form>	
		</div>
		<h4><span class="aligncenter inlineblock"><strong>班级:</strong>________ <strong>姓名:</strong>__________  
				<span ng-cloak timer timerid="examCountTimer" autostart="false" interval="1000">已用时：<strong style="color:red">[[mminutes]] </strong>分 <strong style="color:red">[[sseconds]]</strong> 秒  
					
				</span>
				<div class="btn-group">
						<button type="button" class="btn btn-primary" ng-disabled="metadata.shouldDisabled1" ng-click="startExamTimer('examCountTimer')"><i class="glyphicon glyphicon-time"></i> 开始做题</button>
						<button type="button" class="btn btn-danger"  ng-disabled="metadata.shouldDisabled2" ng-click="stopExamTimer('examCountTimer')"><i class="glyphicon glyphicon glyphicon-pause"></i> 暂停</button>
						<button type="button" class="btn btn-success"  ng-disabled="metadata.shouldDisabled3" ng-click="resumeExamTimer('examCountTimer')"><i class="glyphicon glyphicon-play"></i> 继续</button>
						<button type="button" class="btn btn-warning"  ng-disabled="metadata.shouldDisabled4" ng-click=""><i class="glyphicon ok-circle"></i> 交卷</button>
						<button tooltip-placement="bottom" tooltip="1.点击开始做题启动计时才能答题;2.答题中可以暂停和继续;3.交卷需要登录" type="button" class="btn btn-info"  ng-click=""><i class="glyphicon glyphicon-question-sign"></i></button>
				
				</div>
			</span>        
		</h4>
		<div class="row">
			<div id="examcontainer" class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-push-1">
				<div class="row	exerciserow">
			    	<article class="col-md-4" data-ng-repeat="examrow in examdata.examdata">
			    			<span exam-row-data can-input-answer="canInputAnswer" row="examrow" id="$index+1" show-answer="mathexam.showAnswer" check-answer-mode="mathexam.checkAnswerRealtime"></exam-row-data>				    		
			    	</article>
			    </div>
			</div>   

	</div>

</div>
</div>

<!-- examAppCtrl -->
@stop
@section('scripts')
	<script src="{{asset('bootstrap/js/angular.js')}}"></script>
	<script src="{{asset('bootstrap/js/angular-timer.js')}}"></script>
	<script src="{{asset('bootstrap/js/ng-animate.js')}}"></script>	
	<script src="{{asset('bootstrap/js/kidsitanimatelib.js')}}"></script>
	<script src="{{asset('bootstrap/js/ui-bootstrap-tpls-0.11.0.min.js')}}"></script>
	<script src="{{asset('bootstrap/js/TweenMax.min.js')}}"></script>
	<script src="{{asset('bootstrap/js/examApp.js')}}"></script>
@stop
