// gradeApp.mod.js created by zhenghua@kidsit.cn on 17/01/2015 
(function () {
    'use strict';
    document.write("<base href='http://kidsit.cn/admin/system/grade' />");
    var assetbase = "http://kidsit.cn/htmlapp/system/grade/";
    var indexpagebase = "http://kidsit.cn/admin/system/grade#";
    angular.module('gradeApp',['ngRoute','khttp','cgBusy','xeditable','toastr','ui.utils'])
    .config(['$routeProvider','$interpolateProvider', 'toastrConfig',function ($routeProvider,$interpolateProvider,toastrConfig) {
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

        
		$routeProvider.when('/create', {templateUrl: 'http://kidsit.cn/htmlapp/system/grade/partials/create.html', controller: 'gradeCreateCtrl'});
		$routeProvider.when('/grade-list', {templateUrl: 'http://kidsit.cn/htmlapp/system/grade/partials/index.html'});
		$routeProvider.when('/grade-detail/:id', {templateUrl: 'http://kidsit.cn/htmlapp/system/grade/partials/show.html', controller: 'gradeDetailCtrl'});
		$routeProvider.otherwise({redirectTo: '/grade-list'});

		}])
    .run(function(editableOptions) {
        editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    });
})();