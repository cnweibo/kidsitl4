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
        vm.checkAndSaveGradeTitle = function(data,grade){

            // var d = $q.defer();
            // khttp.getOne("http://kidsit.cn/admin/api/system/grade/",grade.id)
            // .then(
            //     function(gradesdata) {/*success*/
            //         d.resolve(); // resolve empty for onbeforesave continue to go
            //         console.log(gradesdata);
            //     },
            //     function(status) {
            //         d.reject('server error');
            //         console.log("error status code:"+status);
            //     }
            // );
            var d = $q.defer();
            grade._token = $window._token;
            grade.skillgradetitle = data;
            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/grade/"+grade.id,grade);
            promise.then(
                function(gradesdata) {/*success*/
                if (gradesdata.indexOf("年级") >= 0){
                        d.resolve(grade.skillgradetitle+'已经存在！');
                        toastr.error(grade.skillgradetitle+'已经存在！');
                    }
                else{
                    d.resolve();
                        toastr.success(grade.skillgradetitle+'修改成功！');
                    }
                },
                function(status) {
                    d.resolve(status);
                    toastr.error(grade.skillgradetitle+'操作出错请重试！');
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