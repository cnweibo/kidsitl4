// angular js guest add word controller
function guestaddwordController($scope,$log,$http){
	// $scope.wordsadded = [
	// 	{wordtext: 'hello',createdby: 'zhangsan'},
	// 	{wordtext: 'go',createdby: 'lisi'},
	// ];
	$http.get('/guestaddedword').success(function(guestaddedwords)
	{
		$scope.wordsadded = guestaddedwords;
	});
	$scope.addword = function(){
		var wordadded = {
			wordtext: $scope.newwordadded,
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

}