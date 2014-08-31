var app = angular.module('examApp', [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

app.controller('examAppCtrl', function($scope,$http) {
	$scope.mathexam = {
		'mathQuantity' : 50,
		'mathDifficulty': 4,
		'mathDigitNumbers': 4,
		'mathCategory': 'plus'
	};
	$scope.viewClassDetails = function(classToView) {
	// do something
	console.log('viewing details for ' + classToView.name);
	};
	$http.get('/math/exams/create',{params:{mathCategory:'plus',mathDigitNumbers:4,mathDifficulty:4,mathQuantity:50}}).success(function(data)
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
