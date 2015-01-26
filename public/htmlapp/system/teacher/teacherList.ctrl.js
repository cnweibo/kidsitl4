// teacherList.ctrl.js created by zhenghua@kidsit.cn on 25/01/2015 
(function () {
    'use strict';
    angular
        .module('teacherApp')
        .controller('teacherListCtrl',teacherListCtrl);

    teacherListCtrl.$inject = ['$scope','khttp','$location','toastr','$q','$window'];

    function teacherListCtrl($scope,khttp,$location,toastr,$q,$window) {
        /*jshint validthis: true */
        var vm = this;
        var promise;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/system/teacher/");
        promise.then(
            function(teachersdata) {/*success*/
                $scope.teachers = vm.teachersOrginal = teachersdata;
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.deleteTeacher = function(teacher){
            $scope.teachers.splice($scope.teachers.indexOf(teacher),1);
            khttp.destroy("http://kidsit.cn/admin/api/system/teacher/",teacher.id).then(
                function(res){
                    toastr.success(teacher.name+'删除成功！');
                },
                function(error){
                    toastr.error(teacher.name+'删除出错！');
                    // console.log(error);
                }
            );
            $location.path('/teacher-list');
        };
		vm.checkAndSaveTeacher = function(data,field,teacher) {
			var d = $q.defer();
			teacher._token = $window._token;
			teacher[field] = data;
			vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/teacher/"+teacher.id,teacher);
			promise.then(
				function(teacherdata) {/*success*/
				if (teacherdata.indexOf("存在") >= 0){
					d.resolve(teacher.email+'已经存在！');
						toastr.error(teacher[field]+'已经存在！');
					}
				else{
					d.resolve();
						toastr.success(teacher[field]+'修改成功！');
					}
				},
				function(status) {
					d.resolve(status);
					toastr.error(teacher[field]+'操作出错请重试！');
				}
			);

			return d.promise;
		};
    }
})();