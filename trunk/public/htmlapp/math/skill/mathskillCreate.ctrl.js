// mathskillCreate.ctrl.js created by zhenghua@kidsit.cn on 09/03/2015 
(function () {
    'use strict';
    angular
        .module('mathskillApp')
        .controller('mathskillCreateCtrl',mathskillCreateCtrl);

    mathskillCreateCtrl.$inject = ['$scope','khttp','$window','toastr','$location','$q','$timeout'];

    function mathskillCreateCtrl($scope,khttp,$window,toastr,$location,$q,$timeout) {
        /*jshint validthis: true */
        var vm = this;
		$scope.skillsdata = [];
        var promise;
        vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/math/skill/");
        promise.then(
            function(skillsdata) {/*success*/
					$scope.skillsdata = vm.skillsOrginal = skillsdata.resp.data;
					console.log($scope.skillsdata);
                },
            function(status) {console.log("error status code:"+status);}
        );
        // $scope.skillsdata = [{email:"p\u4efd",password:"fsadfsda",cell:"fsd\u4efd",id:3,name:"\u9648\u79c0",sysloginname:"chenxiu",organization:"fs",address:"fs",created_at:"2015-01-25 23:37:58",classes:[{id:11,skilllabel:"gffdsfda",description:"a \u5728\u91cd\u8bfb\u5f00\u97f3\u8282\u4e2d\uff0c\u53d1\u5b57\u6bcd\u97f3[ei]",profileURL:"fssafdfs",deleted_at:null,created_at:"2015-01-31 22:34:00",updated_at:"2015-01-31 22:34:00",teacher_id:3}]},{email:"fff\u53d1\u653e\u901f\u5ea6\u901f\u5ea6",password:"fsdfdsafsd",cell:"fff",id:25,name:"alice",sysloginname:"alicezhang",organization:"fff",address:"fff",created_at:"2015-01-26 01:09:30",classes:[]},{email:"dsdsdsd",password:"fdsfsda",cell:"dddd",id:26,name:"ffffsdsd",sysloginname:"dsddsds",organization:"dddd",address:"desdsddss",created_at:"2015-01-28 00:21:34",classes:[]}];
        $scope.selected = null;
        $scope.mathskillcatsdata = [];
		khttp.getAll('http://kidsit.cn/admin/api/math/skillcat/')
			.then(
				function (response) {
					$scope.mathskillcatsdata = response.resp.data;
					console.log($scope.mathskillcatsdata);
				},
				function (response) {
					toastr.error(response);
				}
			);
        vm.createMathskill = function (form) {
			if (form.$invalid){
				toastr.error('请先改正表单中的错误字段后重试！');
				return;
			}
			var promise;
			vm.newMathskill._token = $window._token;
			vm.newMathskill.skilllabel = vm.newMathskill.skillcatlabel+'.'+vm.newMathskill.skillsublabel;
			vm.currentPromise = promise = khttp.store("http://kidsit.cn/admin/api/math/skill",vm.newMathskill);
			promise.then(
				function (mathskillsdata) {
					if (mathskillsdata.resp.code!==0){
						toastr.error(vm.newMathskill.skilllabel+mathskillsdata.resp.message);
						return;
					}
					else{
						toastr.success(vm.newMathskill.skilllabel+' 创建成功！');
					}
					
				},
				function () {
					toastr.error(vm.newMathskill.skilllabel+' 创建出错，请重试！');
				}
			);
			// $location.path('/mathskill-list');
        };
        $scope.canUseThisName = function (thisname) {
			var d = $q.defer();
			var promise;

			vm.verfiyskilllabelpromise = promise = khttp.getOne('http://kidsit.cn/admin/api/math/skill/',vm.newMathskill.skillcatlabel+'.'+thisname);
			promise.then(
				function (a) {
					return d.reject();
				},
				function (a) {
					d.resolve();
				}
			);
			return d.promise;
        };
        vm.viewFormState = function (form) {
			console.log(form.$valid);
        };
        // callback for typeahead select change
        vm.onSelectSkillcatLabel = function ($item, $model, $label) {
			$scope.$item = $item;
			$scope.$model= $model;
			$scope.$label= $label;
			vm.newMathskill.catid = $item.id;
        };
    }
})();