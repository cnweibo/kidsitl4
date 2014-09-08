var app = angular.module('examApp', ['ui.bootstrap','kidsitAnimate'],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('examAppCtrl', function($scope,$http) {
	$scope.mathexam = {
		'mathQuantity' : 50,
		'mathDifficulty': 2,
		'mathDigitNumbers': 2,
		'mathCategory': 'plus',
		'timetodo':10,
		'showAnswer': false
	};
	$scope.viewClassDetails = function(classToView) {
	// do something
	console.log('viewing details for ' + classToView.name);
	};
	$http.get('/math/exams/create',{params:{mathCategory:'plus',mathDigitNumbers:2,mathDifficulty:2,mathQuantity:50}}).success(function(data)
	{
		$scope.examdata = data;
	});

	$scope.createExam = function(){
		var mathexamreq = $scope.mathexam;
		$http.get('/math/exams/create',{params:mathexamreq}).success(function(examdata)
	{
		$scope.examdata = examdata;
	});
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
app.directive("toggleAnswerViewAndAnimcate",function($animate){
	var linker = function(scope, element, attrs) {
			var clicktoggle = 0;
			element.bind('click', function(event) {
				clicktoggle++;
				if (clicktoggle%2){
				    scope.trigger = 'fadeMeIn';
				}
				else{
				    scope.trigger = 'fadeMeOut';
				}
				scope.$apply();
			});

		};
	return {
		restrict: 'A',
		scope: {trigger: '='},
		template: '<a href="#"><span style="margin-left:10px;" class="glyphicon glyphicon-comment fa-2x"></span></a>',
		link: linker,
		replace: true
	}
});