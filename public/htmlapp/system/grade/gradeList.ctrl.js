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
                $scope.grades = vm.gradesOrginal = gradesdata.resp.data;
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.checkAndSaveGrade = function(data,field,grade){

            var d = $q.defer();
            grade[field] = data;
            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/grade/"+grade.id,grade);
            promise.then(
                function(gradesdata) {/*success*/
                    if (gradesdata.resp.code !==0 ){
                        d.resolve(gradesdata.resp.message);
                        toastr.error(gradesdata.resp.message);
                    }
                    else{
                        d.resolve();
                        toastr.success(data+"更新成功！");
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

            khttp.destroy("http://kidsit.cn/admin/api/system/grade/",grade).then(
                function(res){
                    $scope.grades.splice($scope.grades.indexOf(grade),1);
                    toastr.success(res.resp.message);
                },
                function(error){
                    toastr.error(res.resp.message);
                    // console.log(error);
                }
            );
            $location.path('/grade-list');
        };
        vm.saveGrades = function(){

        };
    }]);

   
})();