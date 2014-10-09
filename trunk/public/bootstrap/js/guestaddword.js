// angular js guest add word controller
kidsitApplication.directive('guestAddedWords',function($window,$log,$http){
	var linker = function(scope, element, attrs){
	// retrieve the session token
	scope.csrf_token = $window.csrf_token;
	scope.newwordadded ='';
	$http.get('/guestaddedword?fayinguizeid='+scope.fayinguizeid+'&yinbiaoid='+scope.yinbiaoid).success(function(guestaddedwords)
	{
		scope.wordsadded = guestaddedwords;
	});
	scope.addword = function(){
		var wordadded = {};
			wordadded._token = scope.csrf_token;
			wordadded.wordtext = scope.newwordadded;
			wordadded.createdby = 'zhangsan';
			wordadded.fayinguizeid = scope.fayinguizeid;
			wordadded.yinbiaoid = scope.yinbiaoid;
		
		var regex = /[a-z]+/;
		if (regex.test(wordadded.wordtext)){
		$http.post('/guestaddedword',wordadded);
		scope.wordsadded.push({
			wordtext: scope.newwordadded,
			createdby:'wangwu'
		});
		}
		// $log.info(scope.wordsadded);
		scope.newwordadded = '';
		};
	};
	return {
		restrict: 'AE',
		scope: {fayinguizeid: "@",yinbiaoid: "@"},
		templateUrl: 'guestaddedwords.html',
		link: linker,
		replace: true
	};
});

