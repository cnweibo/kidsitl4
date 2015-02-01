// studentApp.mod.js created by zhenghua@kidsit.cn on 27/01/2015 
(function () {
    'use strict';

    document.write("<base href='http://kidsit.cn/admin/system/student' />");
    var assetbase = "http://kidsit.cn/htmlapp/system/grade/";
    var indexpagebase = "http://kidsit.cn/admin/system/grade#";

	angular.module('studentApp',['ngRoute','khttp','cgBusy','xeditable','toastr','ui.utils','containerCtrl','ui.bootstrap','angular.filter'])

		.config( ['$routeProvider','$interpolateProvider','toastrConfig', function ($routeProvider,$interpolateProvider,toastrConfig) {
			$interpolateProvider.startSymbol('[[');
			$interpolateProvider.endSymbol(']]');

			angular.extend(toastrConfig, {
				allowHtml: true,
				closeButton: true,
				closeHtml: '<button>&times;</button>',
				containerId: 'toast-container',
				extendedTimeOut: 1000,
				iconClasses: {
					error: 'toast-error',
					info: 'toast-info',
					success: 'toast-success',
					warning: 'toast-warning'
				},
				maxOpened: 0,
				messageClass: 'toast-message',
				newestOnTop: true,
				onHidden: null,
				onShown: null,
				positionClass: 'toast-bottom-full-width',
				tapToDismiss: true,
				timeOut: 5000,
				titleClass: 'toast-title',
				toastClass: 'toast'
			});

			$routeProvider.when('/create', {templateUrl: 'http://kidsit.cn/htmlapp/system/student/partials/create.html', controller: 'studentCreateCtrl'});
			$routeProvider.when('/student-list', {templateUrl: 'http://kidsit.cn/htmlapp/system/student/partials/index.html'});
			$routeProvider.when('/student-detail/:id', {templateUrl: 'http://kidsit.cn/htmlapp/system/student/partials/show.html', controller: 'studentDetailCtrl'});
			$routeProvider.otherwise({redirectTo: '/student-list'});
		}])
		.run(function(editableOptions) {
            editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
        });
})();