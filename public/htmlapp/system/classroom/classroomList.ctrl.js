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
                $scope.classrooms = vm.classroomsOrginal = classroomsdata.resp.data;
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.deleteClassroom = function(classroom){

            khttp.destroy("http://kidsit.cn/admin/api/system/classroom/",classroom).then(
                
                function(res){
                    $scope.classrooms.splice($scope.classrooms.indexOf(classroom),1);
                    toastr.success(res.resp.message);
                },
                function(error){
                    toastr.error(res.resp.message);
                }
            );
            $location.path('/classroom-list');
        };
        // check and save for the edit in place
        vm.checkAndSaveClassroom = function(data,field,classroom) {
		var d = $q.defer();
        console.log(data);
        
		classroom[field] = data;
		vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/classroom/"+classroom.id,classroom);
		promise.then(
            function(classroomdata) {/*success*/
                if (classroomdata.resp.code !==0 ){
                    d.resolve(classroomdata.resp.message);
                    toastr.error(classroomdata.resp.message);
                }
                else{
                    d.resolve();
                    if (field=='teacher_id'){
                        classroom.owner.name = _.findWhere($scope.owners,{id:data}).name ;
                        classroom.owner.id = data;
                        toastr.success(_.findWhere($scope.owners,{id:data}).name+"更新成功！");
                    }
                    else{
                        toastr.success(data+" 更新成功！");
                    }

                }
            },
            function(status) {
                d.resolve(status);
                toastr.error(classroom[field]+'操作出错请重试！');
            }
		);
		return d.promise;
        };
        $scope.owner = {
            id: 5,
            name: "chenxiu"
        };
        $scope.owners=[];
        vm.loadClassroomSelectableOwners = function () {
            khttp.getAll("http://kidsit.cn/admin/api/system/teacher").then(
            function(teacherkeys) {/*success*/
                $scope.owners = teacherkeys.resp.data;
                console.log($scope.owners);
                },
            function(status) {console.log("error status code:"+status);}
            );
        };
    }
})();