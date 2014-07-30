// angular js guest add word controller
angular.module('guestaddwordapp', []).controller('guestaddwordController', function($scope,$window,$log,$http){
	// $scope.wordsadded = [
	// 	{wordtext: 'hello',createdby: 'zhangsan'},
	// 	{wordtext: 'go',createdby: 'lisi'},
	// ];
	// retrieve the session token
	$scope.csrf_token = $window.csrf_token;
	$http.get('/guestaddedword').success(function(guestaddedwords)
	{
		$scope.wordsadded = guestaddedwords;
	});
	$scope.addword = function(){
		var wordadded = {
			wordtext: $scope.newwordadded,
			_token: $scope.csrf_token,
			createdby: 'zhangsan'
		};
		$http.post('/guestaddedword',wordadded);
		$scope.wordsadded.push({
			wordtext: $scope.newwordadded,
			createdby:'wangwu'
		});
		// $log.info($scope.wordsadded);
		$scope.newwordadded = '';
	};

});
