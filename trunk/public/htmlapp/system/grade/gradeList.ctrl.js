// gradeList.ctrl.js created by zhenghua@kidsit.cn on 17/01/2015 
(function () {
    'use strict';
            var scripts = document.getElementsByTagName("script");
            var currentScriptPath = scripts[scripts.length-1].src;

    angular
        .module('gradeApp')
        .controller('gradeListCtrl',['$scope','khttp','$q','$http','$location',function($scope,khttp,$q,$http,$location){
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
            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/system/grade/",grade.id,grade);
            promise.then(
                function(gradesdata) {/*success*/
                    d.resolve();
                },
                function(status) {
                    d.resolve(status);
                    console.log("error status code:"+status);
                }
            );
            return d.promise;
        };
        vm.deleteGrade = function(grade){
            $scope.grades.splice($scope.grades.indexOf(grade),1);
            khttp.destroy("http://kidsit.cn/admin/api/system/grade/",grade.id).then(
                function(res){
                    // console.log(res);
                },
                function(error){
                    // console.log(error);
                }
            );
            $location.path('/grade-list');
        };
        vm.saveGrades = function(){

        };
    }]);

   
})();