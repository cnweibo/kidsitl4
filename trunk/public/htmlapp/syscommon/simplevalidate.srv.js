// simplevalidate.ctrl.js created by zhenghua@kidsit.cn on 03/02/2015 
(function () {
    'use strict';
    angular
        .module('simplevalidate',[])
        .factory('simplevalidate',['$http','khttp','$q',function($http,khttp,$q){
			return {
				dovalidate: function (rules,data,validateurl) {
					var d = $q.defer();
					if (rules){
						if (rules.minlength){
							if (data.length<rules.minlength){
								d.resolve("长度不符合要求，必需大于"+rules.minlength+"个字符！");
							}
						}
						if (rules.maxlength){
							if (data.length>rules.maxlength){
								d.resolve(data+  "长度不符合要求，必需小于"+rules.maxlength+"个字符！");
							}
						}
						if (rules.isEmail){
							var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
							if(!data.match(mailformat)){
								d.resolve(data+  "不符合mail格式要求！");
							}
						}
						if (rules.isallnumeric){
							var numbersformat = /^[0-9]+$/;
							if(!data.match(numbersformat)){
								d.resolve(data+  "要求全部为数字");
							}
						}
						if (rules.isallletter){
							var lettersformat = /^[0-9a-zA-Z]+$/;
							if (!data.match(lettersformat)){
								d.resolve(data+  "要求全部为字母或数字");
							}
						}
						if (rules.isurl){
							var urlformat = /^(?:http(?:s)?:\/\/)?(?:www\.)?(?:[\w-]*)\.\w{2,}$/;
							if (!data.match(urlformat)){
								d.resolve(data+ " 不符合网址URL的合法格式:http://xx.yy");
							}
						}
						// if no async checking , we should resolve the promise with null message so that state can change.
						if (!rules.canuse){
							// here we resolve the promise as a total response for above synchronous validation
							d.resolve();
						}
						if (rules.canuse){
							// if there is async checking, let the d.resolve() here 
							
							khttp.getOne(validateurl,data).then(
								function (a) {
									d.resolve(data+"已经存在，请更改后重试！");
								},
								function (a) {
									// return 0;
									d.resolve();
								}
							);
						}
						return d.promise;
					}
					// if no validation rule existed, we just return the null resolve promise
					d.resolve();
					return d.promise;
				}
			};
	}]);
})();