var app = angular.module('examApp', ['ui.bootstrap','kidsitAnimate','timer'],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('examAppCtrl', function($scope,$http,answeringFactory) {
	$scope.timerRunning = null;
	$scope.metadata = {shouldDisabled1: false,shouldDisabled2: true, shouldDisabled3: true, shouldDisabled4: true};
	$scope.mathexam = {
		'mathQuantity' : 50,
		'mathDifficulty': 2,
		'mathDigitNumbers': 2,
		'mathCategory': 'plus',
		'timetodo':10,
		'showAnswer': false
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
	};
	$scope.clearExamTimer = function(id){
		$scope.$broadcast('timer-stop',id);
		answeringFactory.setIsAnswering(false);
	    $scope.metadata.examTimerRunning = 0;
	    $scope.canInputAnswer = answeringFactory.canInputAnswer();
	}
	$scope.shouldDisabled = function(btnid){
		if (btnid==1){
		if ($scope.metadata.examTimerRunning==0){
			return false;
		}
		else{return true;
		}
		}
		if (btnid==2){
		if ($scope.metadata.examTimerRunning==2 || $scope.metadata.examTimerRunning==0 ){
			return true;
		}
		else{return false;
		}
		}
		if (btnid==3){
		if ($scope.metadata.examTimerRunning==3 || $scope.metadata.examTimerRunning==1 || $scope.metadata.examTimerRunning==0){
			return true;
		}
		else{return false;
		}
		}
		if (btnid==4){
			return false;
		}

	};

	$scope.$watch("metadata.examTimerRunning",function(nv,ov){
		if(nv != ov){
			$scope.metadata.shouldDisabled1 = $scope.shouldDisabled(1);
			$scope.metadata.shouldDisabled2 = $scope.shouldDisabled(2);
			$scope.metadata.shouldDisabled3 = $scope.shouldDisabled(3);
			$scope.metadata.shouldDisabled4 = $scope.shouldDisabled(4);
		}
	});
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
		scope: {row: "=",showAnswer: "=", id: "=",canInputAnswer: "="},
		templateUrl: 'examrow.html',
		link: linker,
		// replace: true
	};
});
app.directive("checkResult",function(){
	var linker = function(scope, element, attrs) {
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
		restrict: 'A',
		scope: {myRow: '=', answer: '='},
		template: '<span class="answerTF" data-ng-if="checkData(myRow,answer)"><label class="label label-danger"><span class="glyphicon glyphicon-ok"></span></label></span>',
		link: linker,
		replace: true
	};
});