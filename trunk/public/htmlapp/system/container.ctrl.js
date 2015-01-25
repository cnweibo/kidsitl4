// container.ctrl.js created by zhenghua@kidsit.cn on 25/01/2015 
(function () {
    'use strict';
    angular
        .module('containerCtrl',[])
        .controller('containerCtrl',containerCtrl);

    containerCtrl.$inject = ['$scope','$window'];

    function containerCtrl($scope,$window) {
        /*jshint validthis: true */
        var vm = this;
        $scope.goBack = function () {
			$window.history.back();
		};
    }
})();