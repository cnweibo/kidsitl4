// classroomList.ctrl.js created by zhenghua@kidsit.cn on 26/01/2015 
(function () {
    'use strict';
    angular
        .module('classroomApp')
        .controller('classroomListCtrl',classroomListCtrl);

    classroomListCtrl.$inject = ['$scope','$window','toastr','$location','khttp','$q'];

    function classroomListCtrl($scope,$window,toastr,$location,khttp,$q) {
        /*jshint validthis: true */
        var vm = this;
        var promise;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/system/classroom/");
        promise.then(
            function(classroomsdata) {/*success*/
                $scope.classrooms = vm.classroomsOrginal = classroomsdata;
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.deleteClassroom = function(classroom){

            khttp.destroy("http://kidsit.cn/admin/api/system/classroom/",classroom).then(
                function(res){
                    $scope.classrooms.splice($scope.classrooms.indexOf(classroom),1);
                    toastr.success(classroom.sysname+'删除成功！');
                },
                function(error){
                    toastr.error(classroom.sysname+'删除出错！');
                    // console.log(error);
                }
            );
            $location.path('/classroom-list');
        };
        // check and save for the edit in place
        vm.checkAndSaveClassroom = function(data,field,classroom) {
		var d = $q.defer();
		classroom[field] = data;
		vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/classroom/"+classroom.id,classroom);
		promise.then(
			function(classroomdata) {/*success*/
			if (classroomdata.indexOf("存在") >= 0){
				d.resolve(classroom[field]+'已经存在！');
					toastr.error(classroom[field]+'已经存在！');
				}
			else{
				d.resolve();
					toastr.success(classroom[field]+'修改成功！');
				}
			},
			function(status) {
				d.resolve(status);
				toastr.error(classroom[field]+'操作出错请重试！');
			}
		);
		return d.promise;
        };
    }
})();