// mathskillApp.mod.js created by zhenghua@kidsit.cn on 09/03/2015 
(function () {
    'use strict';

    document.write("<base href='http://kidsit.cn/admin/math/skill' />");
    var assetbase = "http://kidsit.cn/htmlapp/system/grade/";
    var indexpagebase = "http://kidsit.cn/admin/math/skill#";

	angular.module('mathskillApp',['ngRoute','khttp','cgBusy','xeditable','toastr','ui.utils','containerCtrl',
										'ui.bootstrap','angular.filter','ngMessages','dbrans.validate','simplevalidate',
										'cgBusy','parsers'])

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

			$routeProvider.when('/create', {templateUrl: 'http://kidsit.cn/htmlapp/math/skill/partials/create.html', controller: 'mathskillCreateCtrl'});
			$routeProvider.when('/skill-list', {templateUrl: 'http://kidsit.cn/htmlapp/math/skill/partials/index.html'});
			$routeProvider.when('/skill-detail/:id', {templateUrl: 'http://kidsit.cn/htmlapp/math/skill/partials/show.html', controller: 'mathskillDetailCtrl'});
			$routeProvider.otherwise({redirectTo: '/skill-list'});
		}])
		.run(function(editableOptions) {
            editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
        });
})();