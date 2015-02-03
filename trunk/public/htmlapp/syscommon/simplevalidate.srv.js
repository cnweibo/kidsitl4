// simplevalidate.ctrl.js created by zhenghua@kidsit.cn on 03/02/2015 
(function () {
    'use strict';
    angular
        .module('simplevalidate',[])
        .factory('simplevalidate',['$http','khttp','$q',function($http,khttp,$q){
			return {
				dovalidate: function (rules,data) {
					if (rules){
						if (rules.minlength){
							if (data.length<rules.minlength){
								return "长度不符合要求，必需大于"+rules.minlength+"个字符！";
							}
						}
						if (rules.maxlength){
							if (data.length>rules.maxlength){
								return "长度不符合要求，必需小于"+rules.maxlength+"个字符！";
							}
						}
						if (rules.isEmail){
							var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/ ;
							if(!data.match(mailformat)){
								return "不符合mail格式要求！";
							}
						}
						if (rules.isallnumeric){
							var numbersformat = /^[0-9]+$/;
							if(!data.match(numbersformat)){
								return "要求全部为数字";
							}
						}
						if (rules.isallletter){
							var lettersformat = /^[0-9a-zA-Z]+$/;
							if (!data.match(lettersformat)){
								return "要求全部为字母或数字";
							}
						}
						if (rules.isurl){
							var urlformat = /^(?:http(?:s)?:\/\/)?(?:www\.)?(?:[\w-]*)\.\w{2,}$/;
							if (!data.match(urlformat)){
								return "不符合网址URL的合法格式！请使用http://xx.yy.zz或者https://xx.yy.zz";
							}
						}
						if (rules.canuse){
							var d = $q.defer();
							khttp.getOne('http://kidsit.cn/admin/api/system/classroom/',data).then(
								function (a) {
									return d.reject();
								},
								function (a) {
									d.resolve();
								}
							);
							return d.promise;
						}
						return 0;
					}
					return 0;
				}
			};
	}]);
})();