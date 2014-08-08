var guestaddwordapplication = angular.module('guestaddwordapp', [],function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});
guestaddwordapplication.controller('mp3playerController', function($scope,$window,$log,$http){
	var wordiddombg = "#FFE6FA";
	var previousanimatingID;

	$scope.playmp3 = function(mymp3,domid){
	$("#yinbiaoplayer").attr("src" ,"http://kidsit.cn/getmp3/"+mymp3);
	$("#yinbiaoplayer").trigger('play');

	//animate the word hovered backgroundColor
	$(previousanimatingID).stop();
	$(domid).stop();
	$(domid).animate({backgroundColor: "#abcdef"}, 800);
	$(domid).animate({backgroundColor: wordiddombg}, 200);
	previousanimatingID = domid;
};
	$scope.sequentialfollow = function(wordslist){
		console.log(wordslist);
	};
});
guestaddwordapplication.controller('wordinfoController',function($scope){
	$scope.$parent.wordstoplay = $scope.wordtoplay;	
	$scope.parentwordstoplay = $scope.$parent.wordstoplay;
});
guestaddwordapplication.controller('wordstoplayController',function($scope){
	$scope.wordstoplay = 1;
});