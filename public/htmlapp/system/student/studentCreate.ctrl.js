// studentCreate.ctrl.js created by zhenghua@kidsit.cn on 27/01/2015 
(function () {
    'use strict';
    angular
        .module('studentApp')
        .controller('studentCreateCtrl',studentCreateCtrl);

    studentCreateCtrl.$inject = ['$scope','$window','toastr','$location','khttp','$q'];

    function studentCreateCtrl($scope,$window,toastr,$location,khttp,$q) {
        /*jshint validthis: true */
        var vm = this;

        var promise;
        $scope.classroomsdata = [];
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/system/classroom/");
        promise.then(
            function(classroomsdata) {/*success*/
					$scope.classroomsdata = vm.teachersOrginal = classroomsdata.resp.data;
					console.log($scope.classroomsdata);
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.createStudent = function () {
			var promise;
			vm.newStudent._token = $window._token;
			vm.currentPromise = promise = khttp.store("http://kidsit.cn/admin/api/system/student",vm.newStudent);
			promise.then(
				function (studentsdata) {
					if (studentsdata.resp.code!==0){
						toastr.error(vm.newStudent.name+studentsdata.resp.message);
						return;
					}
					else{
						toastr.success(vm.newStudent.name+' 创建成功！');
					}
					
				},
				function () {
					toastr.error(vm.newStudent.name+' 创建出错，请重试！');
				}
			);
			// $location.path('/student-list');
        };

    }
})();