// angular js guest add word controller
guestaddwordapplication.controller('guestaddwordController_<?php echo $fayinguizeid ?>', function($scope,$window,$log,$http){
	// $scope.wordsadded = [
	// 	{wordtext: 'hello',createdby: 'zhangsan'},
	// 	{wordtext: 'go',createdby: 'lisi'},
	// ];
	// retrieve the session token
	$scope.csrf_token = $window.csrf_token;
	$scope.newwordadded ='';
	$http.get('/guestaddedword?fayinguizeid=<?php echo $fayinguizeid ?>&yinbiaoid=<?php echo $yinbiaoid ?>').success(function(guestaddedwords)
	{
		$scope.wordsadded = guestaddedwords;
	});
	$scope.addword = function(){
		var wordadded = {
			wordtext: $scope.newwordadded,
			fayinguizeid: $scope.wordinfo.fayinguizeid,
			yinbiaoid: $scope.wordinfo.yinbiaoid,
			_token: $scope.csrf_token,
			createdby: 'zhangsan'
		};
		var regex = /[a-z]+/;
		if (regex.test(wordadded.wordtext)){
		console.log(wordadded);
		console.log(regex.test(wordadded.wordtext));
		$http.post('/guestaddedword',wordadded);
		$scope.wordsadded.push({
			wordtext: $scope.newwordadded,
			createdby:'wangwu'
		});
		}
		// $log.info($scope.wordsadded);
		$scope.newwordadded = '';
	};

});
