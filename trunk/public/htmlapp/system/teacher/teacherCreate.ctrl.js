// teacherCreate.ctrl.js created by zhenghua@kidsit.cn on 25/01/2015 
(function () {
    'use strict';
    angular
        .module('teacherApp')
        .controller('teacherCreateCtrl',teacherCreateCtrl);

    teacherCreateCtrl.$inject = ['$scope','khttp','$window','toastr','$location'];

    function teacherCreateCtrl($scope,khttp,$window,toastr,$location) {
        /*jshint validthis: true */
        var vm = this;
        vm.createTeacher = function () {
			var promise;
			vm.newTeacher._token = $window._token;
			vm.currentPromise = promise = khttp.store("http://kidsit.cn/admin/api/system/teacher",vm.newTeacher);
			promise.then(
				function (teachersdata) {
					if (teachersdata.resp.code!==0){
						toastr.error(vm.newTeacher.name+teachersdata.resp.message);
						return;
					}
					else{
						toastr.success(vm.newTeacher.name+' 创建成功！');
					}
					
				},
				function () {
					toastr.error(vm.newTeacher.name+' 创建出错，请重试！');
				}
			);
			// $location.path('/teacher-list');
        };
    }
})();