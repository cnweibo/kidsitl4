// khttp.ctrl.js created by zhenghua@kidsit.cn on 18/01/2015 
(function () {
    'use strict';
            var scripts = document.getElementsByTagName("script");
            var currentScriptPath = scripts[scripts.length-1].src;
    // console.log(currentScriptPath);

    angular
        .module('khttp',[])
        .factory('khttp',['$http','$q',function($http,$q){
			
			return {

				getAll: function (baseurl) {
					var deferred = $q.defer();
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
					var deferred = $q.defer();
					$http({method: 'GET', url: baseurl+id}).
						success(function(data,status,headers,config){
							deferred.resolve(data);
							console.log(data);
						}).
						error(function  (data,status,headers,config) {
							
							console.log(status);
						    deferred.reject(status);
						});
					return deferred.promise;
				},
				store: function (baseurl,parameters) {
					var deferred = $q.defer();
					$http({method: 'POST', url: baseurl,data:parameters}).
						success(function(data){
							deferred.resolve(data);
						}).
						error(function  (data,status,headers,config) {
							deferred.reject(status);
						});
					return deferred.promise;
				},
				// return JSON.parse(localStorage.getItem(STORAGE_ID) || '[]');
				update: function (baseurl,parameters) {
					var deferred = $q.defer();
					var postData={};
					// postData._token = parameters._token;
					// postData.title = parameters.todo.title;
					// postData.id = parameters.todo.id;
					$http({method: 'PUT', url: baseurl,
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
				},
				destroy: function(baseurl, id){
					var deferred = $q.defer();
					$http.delete(baseurl+id)
					.success(function(data,status,headers,config){
						deferred.resolve(data);
					}).
					error(function(data,status,headers,config) {
						deferred.reject(status);
					});
					return deferred.promise;

				}
			};
		}]);
})();