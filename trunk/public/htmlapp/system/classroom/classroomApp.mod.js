// classroomApp.mod.js created by zhenghua@kidsit.cn on 26/01/2015 
(function () {
    'use strict';

    document.write("<base href='http://kidsit.cn/admin/system/classroom' />");
    var assetbase = "http://kidsit.cn/htmlapp/system/classroom/";
    var indexpagebase = "http://kidsit.cn/admin/system/classroom#";

	angular.module('classroomApp',['ngRoute','khttp','cgBusy','xeditable','toastr','ui.utils','containerCtrl'])

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

			$routeProvider.when('/create', {templateUrl: 'http://kidsit.cn/htmlapp/system/classroom/partials/create.html', controller: 'classroomCreateCtrl'});
			$routeProvider.when('/classroom-list', {templateUrl: 'http://kidsit.cn/htmlapp/system/classroom/partials/index.html'});
			$routeProvider.when('/classroom-detail/:id', {templateUrl: 'http://kidsit.cn/htmlapp/system/classroom/partials/detail.html', controller: 'classroomDetailCtrl'});
			$routeProvider.otherwise({redirectTo: '/classroom-list'});
		}])
		.run(function(editableOptions) {
            editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
		});
})();