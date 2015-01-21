// gradeCreateCtrl.ctrl.js created by zhenghua@kidsit.cn on 20/01/2015 
(function () {
    'use strict';
    angular
        .module('gradeApp')
        .controller('gradeCreateCtrl',gradeCreateCtrl);

    gradeCreateCtrl.$inject = ['$scope','$window','khttp'];

    function gradeCreateCtrl($scope,$window,vhttp) {
        /*jshint validthis: true */
        var vm = this;
        vm.newGrade = null;
        console.log("create control");
        vm.goBack = function () {
			$window.history.back();
		};
		vm.createGrade = function () {
			vm.newGrade._token = $window._token;
			vhttp.store("http://kidsit.cn/admin/api/system/grade",vm.newGrade)
			.then(
				function (data) {
					console.log(data);
				},
				function () {
					console.log('error');
				}
				);
		};
    }
})();