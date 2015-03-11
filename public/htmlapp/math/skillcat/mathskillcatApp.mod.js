// mathskillcatApp.mod.js created by zhenghua@kidsit.cn on 08/03/2015 
(function () {
    'use strict';

    document.write("<base href='http://kidsit.cn/admin/math/skillcat' />");
    var assetbase = "http://kidsit.cn/htmlapp/system/grade/";
    var indexpagebase = "http://kidsit.cn/admin/system/grade#";

	angular.module('mathskillcatApp',['khttp','cgBusy','xeditable','toastr','ui.utils','containerCtrl',
										'ui.bootstrap','angular.filter','ngMessages','dbrans.validate','simplevalidate',
										'cgBusy','parsers']);
})();