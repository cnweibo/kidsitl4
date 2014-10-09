var app = angular.module('kidsitApp', ['ui.bootstrap','kidsitAnimate','timer','toastr'],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('kidsitAppCtrl', function($scope,$rootScope,$http,answeringFactory,toastr) {
	$scope.timerRunning = null;
	$scope.user={};	
	$scope.metadata = {shouldDisabled1: false,shouldDisabled2: true, shouldDisabled3: true, shouldDisabled4: true, shouldDisabled5: true};
	$scope.mathexam = {
		'mathQuantity' : 50,
		'mathDifficulty': 2,
		'mathDigitNumbers': 2,
		'mathCategory': 'plus',
		'timetodo':10,
		'showAnswer': false,
		'checkAnswerRealtime': false,
		'scorePerQuestion' : 2,
		'score': 0,
		'userAnsweredData':[],
		'hasSubmitted': false
	};
	var searchAnsweredData = function(rowtosearch){
		var index = -1;
		for (i=0;i<$scope.mathexam.userAnsweredData.length;i++)
			if (rowtosearch.id == $scope.mathexam.userAnsweredData[i].id){
				index = i;
				break;
			}
			return index;
	};
	$scope.$on('updateScoreAndAnswer',function (e,rowdata) {
			var result = null;
			var index = -2;
			index = searchAnsweredData (rowdata);
			if (rowdata.invisualcolumns == "1"){
				result = (rowdata.operand1 == rowdata.myanswerdata) ;
			}
			if (rowdata.invisualcolumns == "2"){
				result = (rowdata.operand2 == rowdata.myanswerdata) ;}
			if (rowdata.invisualcolumns == "3"){
				result = (rowdata.sumdata == rowdata.myanswerdata) ;
			}
			if (result){// if the answer is right
				if (index == -1){//not found yet, we push in and add the score
					$scope.mathexam.score += $scope.mathexam.scorePerQuestion;
					$scope.mathexam.userAnsweredData.push({'id': rowdata.id,'invisualcolumns': rowdata.invisualcolumns,'myanswerdata': rowdata.myanswerdata, 'scoreAddedTimes':1});
				}else{
					// have found ,we should check whether or not had added the score
					if ($scope.mathexam.userAnsweredData[index].scoreAddedTimes == 0){
						$scope.mathexam.score += $scope.mathexam.scorePerQuestion;
						$scope.mathexam.userAnsweredData[index].scoreAddedTimes = 1;
					}else if ($scope.mathexam.userAnsweredData[index].scoreAddedTimes == 1){
						// do nothing, ignore it
					}
				}
			}else{
				// the answer is not right
				if (index == -1){//not found yet, we push in and NOT add the score
					$scope.mathexam.userAnsweredData.push({'id': rowdata.id,'invisualcolumns': rowdata.invisualcolumns,'myanswerdata': rowdata.myanswerdata, 'scoreAddedTimes':0});
				}else{
					// have found and score had been added, so we should decrease the score
					if ($scope.mathexam.userAnsweredData[index].scoreAddedTimes == 1){
						$scope.mathexam.score -= $scope.mathexam.scorePerQuestion;
						$scope.mathexam.userAnsweredData[index].scoreAddedTimes = 0;
				}
				}
			}
			
});
	$scope.changeQuantity = function(newvalue){
		$scope.mathexam.scorePerQuestion = 100 / newvalue ;
	};
	$scope.logininput = {};
	$scope.user = {};
	$scope.userloggedinfo = {};
	$http.get('/user/loginstatusx',$scope.logininput).success(function(logindata)
	{
		$scope.userloggedinfo = logindata;
		console.log($scope.userloggedinfo);
	});	
	$scope.doLogin = function(){
		$scope.logininput._token = angular.element(document.getElementsByName('_token')[0]).val();
		$http.post('/user/loginx',$scope.logininput).success(function(logindata)
	{
		$scope.userloggedinfo = logindata;
		console.log($scope.userloggedinfo);
	});
		$scope.user.showLogin = false ;
	};
	$scope.doLogout = function(){
		$scope.logininput._token = angular.element(document.getElementsByName('_token')[0]).val();
		$http.post('/user/logoutx',$scope.logininput).success(function(logindata)
	{
		$scope.userloggedinfo = logindata;
		console.log($scope.userloggedinfo);
	});
		$scope.user.showLogin = false ;
	};
	$scope.canInputAnswer = answeringFactory.canInputAnswer();
	$scope.viewClassDetails = function(classToView) {
	// do something
	};
	$http.get('/math/exams/create',{params:{mathCategory:'plus',mathDigitNumbers:2,mathDifficulty:2,mathQuantity:50}}).success(function(data)
	{
		$scope.examdata = data;
	});

	$scope.createExam = function(){
		var mathexamreq = $scope.mathexam;
		$scope.metadata.examTimerRunning = 0;
		$scope.mathexam.userAnsweredData = [];
		$scope.mathexam.score = 0;
		$scope.mathexam.hasSubmitted = false;
		$http.get('/math/exams/create',{params:mathexamreq}).success(function(examdata)
	{
		$scope.examdata = examdata;
	});
	};
	$scope.metadata.examTimerRunning = 0;
	$scope.startExamTimer = function(id){
		$scope.$broadcast('timer-start',id);
		answeringFactory.setIsAnswering(true);
		$scope.canInputAnswer = answeringFactory.canInputAnswer();
        $scope.metadata.examTimerRunning = 1;
	};
	$scope.stopExamTimer = function(id){
		$scope.$broadcast('timer-stop',id);
		answeringFactory.setIsAnswering(false);
        $scope.metadata.examTimerRunning = 2;
        // 由于未能主动$watch变化，所以主动再读一下通知变化
        $scope.canInputAnswer = answeringFactory.canInputAnswer();
	};
	$scope.resumeExamTimer = function(id){
		$scope.$broadcast('timer-resume',id);
		answeringFactory.setIsAnswering(true);
	    $scope.metadata.examTimerRunning = 3;
	    $scope.canInputAnswer = answeringFactory.canInputAnswer();
	    $scope.mathexam.hasSubmitted = false;

	};
	$scope.clearExamTimer = function(id){
		$scope.$broadcast('timer-stop',id);
		answeringFactory.setIsAnswering(false);
	    $scope.metadata.examTimerRunning = 0;
	    $scope.canInputAnswer = answeringFactory.canInputAnswer();
	};
	$scope.submitAnswers = function(){
		toastr.error('请登录后再提交','需要登录',{closeButton: true,positionClass: 'toast-bottom-full-width'});
		$scope.mathexam.hasSubmitted = true;
		$scope.metadata.examTimerRunning = 4;
		answeringFactory.setIsAnswering(false);
	    $scope.canInputAnswer = answeringFactory.canInputAnswer();
		$rootScope.$broadcast('userHasSubmittedAnswers');
	};
	$scope.revisionAnswers = function(){
		$scope.mathexam.hasSubmitted = false;
		$scope.metadata.examTimerRunning = 5;
		answeringFactory.setIsAnswering(true);
	    $scope.canInputAnswer = answeringFactory.canInputAnswer();
		$rootScope.$broadcast('revisionAfterSubmittedAnswers');
	};
	$scope.shouldDisabled = function(btnid){
		if (btnid==1){
		if ($scope.metadata.examTimerRunning==0){
			return false;
		}
		else{return true;
		}
		}
		if (btnid==2){
		if ($scope.metadata.examTimerRunning==2 || $scope.metadata.examTimerRunning==0 || $scope.metadata.examTimerRunning==4 || $scope.metadata.examTimerRunning==5){
			return true;
		}
		else{return false;
		}
		}
		if (btnid==3){
		if ($scope.metadata.examTimerRunning==3 || $scope.metadata.examTimerRunning==1 || $scope.metadata.examTimerRunning==0 || $scope.metadata.examTimerRunning==4 || $scope.metadata.examTimerRunning==5){
			return true;
		}
		else{return false;
		}
		}
		if (btnid==4){
			if ($scope.metadata.examTimerRunning==0 || $scope.metadata.examTimerRunning==1 || $scope.metadata.examTimerRunning==3 || $scope.metadata.examTimerRunning==4){
				return true;
			}
			else{return false;
			}
		}
		if (btnid==5){
			if ($scope.metadata.examTimerRunning==0 || $scope.metadata.examTimerRunning==1 || $scope.metadata.examTimerRunning==2 || $scope.metadata.examTimerRunning==3 || $scope.metadata.examTimerRunning==5){
				return true;
			}
			else if( $scope.metadata.examTimerRunning==4 ){return false;}
		}
	};

	$scope.$watch("metadata.examTimerRunning",function(nv,ov){
		if(nv != ov){
			$scope.metadata.shouldDisabled1 = $scope.shouldDisabled(1);
			$scope.metadata.shouldDisabled2 = $scope.shouldDisabled(2);
			$scope.metadata.shouldDisabled3 = $scope.shouldDisabled(3);
			$scope.metadata.shouldDisabled4 = $scope.shouldDisabled(4);
			$scope.metadata.shouldDisabled5 = $scope.shouldDisabled(5);
		}
	});
});
app.controller('loginCtrl',function($scope,$http){

	$scope.login = function(){
		console.log("logining in");
		$scope.user.showLogin = true;
	};
	$scope.logout = function(){
		console.log("logining out");
	};
	$scope.signup = function(){
		console.log("signup ...");
	};
});
app.filter('examTixing',function(){
	return	function(mathcategory){
		switch (mathcategory){
			case 'plus':
				return "加法";
			case 'minus':
				return	"减法";
			case 'times':
				return "乘法";
			case 'division':
				return "除法";
			}
		};
	});
app.filter('examWeishu',function(){
	return	function(digitnumbers){
		switch (digitnumbers){
			case '1':
				return "1位数";
			case '2':
				return	"2位数";
			case '3':
				return "3位数";
			case '4':
				return "4位数";
			}
		};
	});
app.filter('examDifficulty',function(){
	return function(difficulty){
		switch (difficulty){
			case '1':
				return "1级";
			case '2':
				return	"2级";
			case '3':
				return "3级";
			case '4':
				return "4级";
			}
	};
});
app.value('answeringFactory', {
	isAnswering : false,
	canInputAnswer: function() {
    return this.isAnswering;
	},
	setIsAnswering: function(tof){
  	this.isAnswering = tof ;
}});
app.directive("toggleAnswerViewAndAnimcate",function($animate){
	var linker = function(scope, element, attrs) {
			var clicktoggle = 0;
			element.bind('click', function(event) {
				clicktoggle++;
				if (clicktoggle % 2){
				    scope.trigger = "fadeMeIn";
				}
				else{
				    scope.trigger = null;
				}
				scope.$apply();
			});

		};
	return {
		restrict: 'A',
		scope: {trigger: '='},
		template: '<a href="#"><span tooltip-placement="top" tooltip="显示/隐藏答案" style="margin-left:10px;" class="glyphicon glyphicon-eye-open fa-2x"></span></a>',
		link: linker,
		replace: true
	};
});

app.directive("examRowData",function($animate,answeringFactory){
	var linker = function(scope, element, attrs) {
			// scope.canInputAnswer = false;
			// scope.canInputAnswer = answeringFactory.canInputAnswer();
			// scope.$watch('canInputAnswer', function(newVal, oldVal) {
			//     console.log(newVal);
			// });
			// scope.$watch('row.myanswerdata',function(nv,ov){
			// 	console.log(nv);
			// })
			scope.updateScore = function(){
					scope.$emit('updateScoreAndAnswer',scope.row);
			};
			scope.isVisualColumn = function(row,column){
				return (row.invisualcolumns!=column);
			};
			scope.checkData = function(row,answer){
				var result = null;
				if (row.invisualcolumns == "1"){
					result = (row.operand1 == answer) ;
				}
				if (row.invisualcolumns == "2"){
					result = (row.operand2 == answer) ;
				}
				if (row.invisualcolumns == "3"){
					result = (row.sumdata == answer) ;
					
					}
				return result;
			};
		};
	return {
		restrict: 'AE',
		scope: {row: "=",showAnswer: "=", id: "=",canInputAnswer: "=",checkAnswerRealtime: "=checkAnswerMode"},
		templateUrl: 'examrow.html',
		link: linker,
		// replace: true
	};
});
app.directive("checkResult",function(){
	var linker = function(scope, element, attrs) {
		scope. hasSubmittedAnsweres = false;
		scope.checkData = function(row,answer){
			var result = null;
			if (row.invisualcolumns == "1"){
				result = (row.operand1 == answer) ;
			}
			if (row.invisualcolumns == "2"){
				result = (row.operand2 == answer) ;
			}
			if (row.invisualcolumns == "3"){
				result = (row.sumdata == answer) ;
				
				}
			return result;
		};
		scope.isRevisioning = false;
		scope.$on('userHasSubmittedAnswers',function(){
			scope.hasSubmittedAnsweres = true;
			scope.isRevisioning = false;
		});
		scope.$on('revisionAfterSubmittedAnswers',function(){
			scope.hasSubmittedAnsweres = false;
			scope.isRevisioning = true;
		});
	};
	return {
		restrict: 'A',
		scope: {myRow: '=', answer: '=',checkAnswerRealtime: '=',hasInput: '='},
		templateUrl: 'checkresult.html',
		
		link: linker,
		replace: true
	};
});
app.directive("loginMenu",function(){
	var linker = function(scope, element, attrs, ctrl, transclude) {
		      transclude(scope, function(clone, scope) {
		        element.append(clone);
		      });
		    };
	return{
		restrict: 'AE',
		transclude: true,
		link : linker,
		templateUrl: 'loginmenu.html'
	}
});
app.directive("loginForm",function(){
	return{
		restrict: 'AE',
		// controller: 'loginCtrl',
		templateUrl: 'loginform.html'
	}
});