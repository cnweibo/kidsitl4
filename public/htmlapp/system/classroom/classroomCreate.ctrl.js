// classroomCreate.ctrl.js created by zhenghua@kidsit.cn on 26/01/2015 
(function () {
    'use strict';
    angular
        .module('classroomApp')
        .controller('classroomCreateCtrl',classroomCreateCtrl);

    classroomCreateCtrl.$inject = ['$scope','khttp','$window','toastr','$location','$q'];

    function classroomCreateCtrl($scope,khttp,$window,toastr,$location,$q) {
        /*jshint validthis: true */
        var vm = this;
        vm.createClassroom = function () {
			var promise;
			vm.newClassroom._token = $window._token;
			vm.currentPromise = promise = khttp.store("http://kidsit.cn/admin/api/system/classroom",vm.newClassroom);
			promise.then(
				function (classroomsdata) {
					if (classroomsdata.resp.code!==0){
						toastr.error(vm.newClassroom.sysname+classroomsdata.resp.message);
						return;
					}
					else{
						toastr.success(vm.newClassroom.sysname+' 创建成功！');
					}
					
				},
				function () {
					toastr.error(vm.newClassroom.sysname+' 创建出错，请重试！');
				}
			);
			// $location.path('/classroom-list');
        };
    }
})();