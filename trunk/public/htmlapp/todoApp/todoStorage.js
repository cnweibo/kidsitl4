/*global todomvc */
/*jslint node: true */
'use strict';

/**
 * Services that persists and retrieves TODOs from localStorage
 */
todomvc.factory('todoStorage', function ($http,$q) {
    var STORAGE_ID = 'todos-angularjs-perf';
    var deferred = $q.defer();
    return {

        getAll: function () {
            $http({method: 'GET', url: '/api/todo'}).
                success(function(data,status,headers,config){
                    deferred.resolve(data);
                }).
                error(function(data,status,headers,config) {
                    deferred.reject(status);
                });
              return deferred.promise;
        },
        getOne: function (id) {
            $http({method: 'GET', url: '/api/todo/'+id}).
                success(function(){}).
                error(function  (data,status,headers,config) {
                    deferred.reject(status);
                });
              return deferred.promise;

        },
        store: function (id) {
            $http({method: 'GET', url: '/api/todo/'+id}).
                success(function(){}).
                error(function  (data,status,headers,config) {
                    deferred.reject(status);
                });
              return deferred.promise;

        },
            // return JSON.parse(localStorage.getItem(STORAGE_ID) || '[]');
        update: function (parameters) {
            var postData={};
            postData._token = parameters._token;
            postData.title = parameters.todo.title;
            postData.id = parameters.todo.id;
        
            $http({method: 'POST', url: '/api/todo/'+parameters.todo.id,
                    // params: {
                    //     _token: parameters._token
                    // },
                    data: postData
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
});