// mathApp.mod.js created by zhenghua@kidsit.cn on 11/03/2015 
(function () {
    'use strict';

    document.write("<base href='http://kidsit.cn/admin/math' />");
    var assetbase = "http://kidsit.cn/htmlapp/system/grade/";
    var indexpagebase = "http://kidsit.cn/htmlapp/math/";

	angular.module('mathApp',['khttp','cgBusy','xeditable','toastr','ui.utils','containerCtrl',
										'ui.bootstrap','angular.filter','ngMessages','dbrans.validate','simplevalidate',
										'cgBusy','parsers','ui.router','mathskillcatApp'])
		// use ui.router in replace of angular native routeProvider
		.config(['$stateProvider','$urlRouterProvider','$interpolateProvider','toastrConfig',function($stateProvider,$urlRouterProvider,$interpolateProvider,toastrConfig) {
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
			$stateProvider
				.state("skillcat",{url: "/skillcat", templateUrl: indexpagebase+"skillcat/partials/index.html"})
					.state("skillcat-list",{parent: "skillcat", url: "/list", templateUrl: indexpagebase+"skillcat/partials/index.html"})
					.state("skillcat-create",{parent: "skillcat", url: "/create", templateUrl: indexpagebase+"skillcat/partials/create.html"});
			$urlRouterProvider.otherwise("/skillcat/list");
		}])
		.run(function(editableOptions) {
            editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
        });
})();