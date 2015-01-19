// gradeApp.mod.js created by zhenghua@kidsit.cn on 17/01/2015 
(function () {
    'use strict';
    document.write("<base href='http://kidsit.cn/htmlapp/system/grade/' />");
   
    angular.module('gradeApp',['ngRoute','khttp','cgBusy','xeditable'])
    .config(['$routeProvider','$interpolateProvider', function ($routeProvider,$interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');

        
		$routeProvider.when('/create', {templateUrl: 'partials/create.html', controller: 'createCtrl'});
		$routeProvider.when('/grade-list', {templateUrl: 'partials/index.html'});
		$routeProvider.when('/grade-detail/:id', {templateUrl: 'system/grade/partials/show.html', controller: 'gradeDetailCtrl'});
		$routeProvider.otherwise({redirectTo: '/grade-list'});

		}])
    .run(function(editableOptions) {
        editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
    });
})();