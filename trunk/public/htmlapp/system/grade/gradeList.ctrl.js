// gradeList.ctrl.js created by zhenghua@kidsit.cn on 17/01/2015 
(function () {
    'use strict';
            var scripts = document.getElementsByTagName("script");
            var currentScriptPath = scripts[scripts.length-1].src;

    angular
        .module('gradeApp')
        .controller('gradeListCtrl',['$scope','khttp','$q','$http','$location','$window','toastr',function($scope,khttp,$q,$http,$location,$window,toastr){
        /*jshint validthis: true */
        var vm = this;
        var promise;
        // var grades;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/system/grade/");
        promise.then(
            function(gradesdata) {/*success*/
                $scope.grades = vm.gradesOrginal = gradesdata;
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.checkAndSaveGrade = function(data,field,grade){

            var d = $q.defer();
            grade._method = 'PUT';
            grade._token = $window._token;
            grade[field] = data;
            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/grade/"+grade.id,grade);
            promise.then(
                function(gradesdata) {/*success*/
                if (gradesdata.indexOf("年级") >= 0){
                        d.resolve(grade[field]+'已经存在！');
                        toastr.error(grade[field]+'已经存在！');
                    }
                else{
                    d.resolve();
                        toastr.success(grade[field]+'修改成功！');
                    }
                },
                function(status) {
                    d.resolve(status);
                    toastr.error(grade[field]+'操作出错请重试！');
                }
            );
            
            return d.promise;
        };
        vm.deleteGrade = function(grade){
            $scope.grades.splice($scope.grades.indexOf(grade),1);
            khttp.destroy("http://kidsit.cn/admin/api/system/grade/",grade.id).then(
                function(res){
                    toastr.success(grade.skillgradetitle+'删除成功！');
                },
                function(error){
                    toastr.error(grade.skillgradetitle+'删除出错！');
                    // console.log(error);
                }
            );
            $location.path('/grade-list');
        };
        vm.saveGrades = function(){

        };
    }]);

   
})();