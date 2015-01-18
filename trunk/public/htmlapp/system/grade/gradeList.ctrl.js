// gradeList.ctrl.js created by zhenghua@kidsit.cn on 17/01/2015 
(function () {
    'use strict';
            var scripts = document.getElementsByTagName("script");
            var currentScriptPath = scripts[scripts.length-1].src;
    console.log(currentScriptPath);

    angular
        .module('gradeApp')
        .controller('gradeListCtrl',['$scope','khttp',function($scope,khttp){
        /*jshint validthis: true */
        var vm = this;
        var promise;
        // var grades;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/system/grade/api");
        promise.then(
            function(gradesdata) {/*success*/
                    vm.grades = gradesdata;
                },
            function(status) {console.log("error status code:"+status);}
        );
        vm.testmodel="this is from controller!";
        
    }]);

   
})();