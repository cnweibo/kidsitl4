// studentList.ctrl.js created by zhenghua@kidsit.cn on 27/01/2015 
(function () {
    'use strict';
    angular
        .module('studentApp')
        .controller('studentListCtrl',studentListCtrl);

    studentListCtrl.$inject = ['$scope','$window','toastr','$location','khttp','$q'];

    function studentListCtrl($scope,$window,toastr,$location,khttp,$q) {
        /*jshint validthis: true */
        var vm = this;
        var promise;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/system/student/");
        promise.then(
            function(studentsdata) {/*success*/
                $scope.students = vm.studentsOrginal = studentsdata.resp.data;
                },
            function(status) {console.log("error status code:"+status);}
        );
		// check and save for the edit in place
		vm.checkAndSaveStudent = function(data,field,student) {
			var d = $q.defer();
			student[field] = data;
			vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/student/"+student.id,student);
			promise.then(

				function(studentdata) {/*success*/
					if (studentdata.resp.code !==0 ){
						d.resolve(studentdata.resp.message);
						toastr.error(studentdata.resp.message);
					}
					else{
						d.resolve();
						if(field == 'classroom_id'){
							student.belonging_class.sysname = _.findWhere($scope.belongingClasses,{id:data}).sysname ;
							student.belonging_class.id = _.findWhere($scope.belongingClasses,{id:data}).id ;
						}
						toastr.success(field+' '+data+" 更新成功！");
					}
				},
				function(status) {
					d.resolve(status);
					toastr.error(student[field]+'操作出错请重试！');
				}
			);
			return d.promise;
		};
		vm.deleteStudent = function(student){

			khttp.destroy("http://kidsit.cn/admin/api/system/student/",student).then(

				function(res){
					$scope.students.splice($scope.students.indexOf(student),1);
					toastr.success(res.resp.message);
				},
				function(error){
					toastr.error(res.resp.message);
				}
			);
			$location.path('/student-list');
		};
		$scope.belongingClasses=[];
		vm.loadStudentSelectableBelongingClasses = function () {
			khttp.getAll("http://kidsit.cn/admin/api/system/classroom").then(
			function(classesdata) {/*success*/
				$scope.belongingClasses = classesdata.resp.data;
				console.log($scope.belongingClasses);
				},
			function(status) {console.log("error status code:"+status);}
			);
		};
	}
})();