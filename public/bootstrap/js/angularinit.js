var guestaddwordapplication = angular.module('guestaddwordapp', []);
guestaddwordapplication.controller('mp3playerController', function($scope,$window,$log,$http){
	$scope.playmp3 = function(mymp3){
	$("#yinbiaoplayer").attr("src" ,"http://kidsit.cn/getmp3/"+mymp3);
	$("#yinbiaoplayer").trigger('play');
};
});