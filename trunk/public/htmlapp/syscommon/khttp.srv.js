// khttp.ctrl.js created by zhenghua@kidsit.cn on 18/01/2015 
(function () {
    'use strict';
            var scripts = document.getElementsByTagName("script");
            var currentScriptPath = scripts[scripts.length-1].src;
    console.log(currentScriptPath);

    angular
        .module('khttp',[])
        .factory('khttp',['$http','$q',function($http,$q){
			var deferred = $q.defer();
			return {

				getAll: function (baseurl) {
					$http({method: 'GET', url: baseurl}).
						success(function(data,status,headers,config){
							deferred.resolve(data);
						}).
						error(function(data,status,headers,config) {
							deferred.reject(status);
						});
					return deferred.promise;
				},
				getOne: function (baseurl,id) {
					$http({method: 'GET', url: baseurl+id}).
						success(function(){}).
						error(function  (data,status,headers,config) {
							deferred.reject(status);
						});
					return deferred.promise;
				},
				store: function (baseurl,id) {
					$http({method: 'GET', url: baseurl+id}).
						success(function(){}).
						error(function  (data,status,headers,config) {
							deferred.reject(status);
						});
					return deferred.promise;
				},
				// return JSON.parse(localStorage.getItem(STORAGE_ID) || '[]');
				update: function (baseurl,id,parameters) {
					var postData={};
					// postData._token = parameters._token;
					// postData.title = parameters.todo.title;
					// postData.id = parameters.todo.id;
					$http({method: 'POST', url: baseurl+id,
						// params: {
						//     _token: parameters._token
						// },
							data: parameters
					}).
					success(function(data,status,headers,config){
						deferred.resolve(data);
					}).
					error(function(data,status,headers,config) {
						deferred.reject(status);
					});
					return deferred.promise;
					// localStorage.setItem(STORAGE_ID, JSON.stringify(todos));
				}
			};
		}]);
})();