// gradeList.ctrl.js created by zhenghua@kidsit.cn on 17/01/2015 
(function () {
    'use strict';
            var scripts = document.getElementsByTagName("script");
            var currentScriptPath = scripts[scripts.length-1].src;
    console.log(currentScriptPath);

    angular
        .module('gradeApp')
        .controller('gradeListCtrl',['$scope','khttp','$q',function($scope,khttp,$q){
        /*jshint validthis: true */
        var vm = this;
        var promise;
        // var grades;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/system/grade/api");
        promise.then(
            function(gradesdata) {/*success*/
                $scope.grades = vm.gradesOrginal = gradesdata;
                console.log($scope.grades);
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.checkAndSaveGradeTitle = function($data,grade){
            var d = $q.defer();
            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/system/grade/api",grade.id,grade);
            promise.then(
                function(gradesdata) {/*success*/
                    d.resolve(gradesdata);
                },
                function(status) {
                    d.resolve(status);
                    console.log("error status code:"+status);
                }
            );
            return d.promise;
        };
        vm.testmodel="this is from controller!";
        $scope.$watchGroup('grades',function(nv,ov){
            console.log(nv);
            console.log(ov);

        });
        vm.saveGrades = function(){

        };
    }]);

   
})();