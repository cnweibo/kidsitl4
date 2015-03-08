// parsers.ctrl.js created by zhenghua@kidsit.cn on 08/03/2015 
(function () {
    'use strict';
    angular
        .module('parsers',[])
        .directive('lowercase', function() {
			return {
				require: 'ngModel',
				restrict: 'A',
				link: function(scope, element, attr, ngModelCntrl) {
					ngModelCntrl.$parsers.push(function (text) {
						return text.toLowerCase();
					});
				}
			};
		})
		.directive('uppercase', function() {
			return {
				require: 'ngModel',
				restrict: 'A',
				link: function(scope, element, attr, ngModelCntrl) {
					ngModelCntrl.$parsers.push(function (text) {
						return text.toUpperCase();
					});
				}
			};
		});
})();