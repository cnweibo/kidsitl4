// mathskillList.ctrl.js created by zhenghua@kidsit.cn on 08/03/2015 
(function () {
    'use strict';
    angular
        .module('mathskillApp')
        .controller('mathskillListCtrl',mathskillListCtrl);
        mathskillListCtrl.$inject = ['$scope','$window','toastr','$location','khttp','$q','simplevalidate'];

            function mathskillListCtrl($scope,$window,toastr,$location,khttp,$q,simplevalidate) {
                /*jshint validthis: true */
                var vm = this;
                var promise;
                vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/math/skill");
                promise.then(
                    function(mathskillsdata) {/*success*/
                        $scope.mathskills = mathskillsdata.resp.data;
                        },
                    function(status) {console.log("error status code:"+status);}
                );
                vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/math/skillcat");
                promise.then(
                    function(mathskillcatdata) {/*success*/
                        $scope.mathskillcats = mathskillcatdata.resp.data;
                        },
                    function(status) {console.log("error status code:"+status);}
                );
                vm.deleteMathskill = function(mathskill){

                    khttp.destroy("http://kidsit.cn/admin/api/math/skill/",mathskill).then(
                        
                        function(res){
                            $scope.mathskills.splice($scope.mathskills.indexOf(mathskill),1);
                            toastr.success(res.resp.message);
                        },
                        function(error){
                            toastr.error(res.resp.message);
                        }
                    );
                    $location.path('/mathskill-list');
                };
                vm.getMathskillsubid = function (mathskill) {
                    return mathskill.catsubid.split(".")[1];
                };
                vm.updateMathcatsubid = function (data,field,mathskill) {
                    mathskill.catsubid = mathskill.category.catlabel+'.'+data;
                    this.saveMathskill(mathskill);
                };
                vm.saveMathskill = function(mathskill){
                    var d = $q.defer();
                    vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/math/skill/"+mathskill.id,mathskill);
                    promise.then(
                        function(mathskilldata) {/*success*/
                            if (mathskilldata.resp.code !==0 ){
                                d.resolve(mathskilldata.resp.message);
                                toastr.error(mathskilldata.resp.message);
                            }
                            else{
                                d.resolve();

                            }
                        },
                        function(status) {
                            d.resolve(status);
                            toastr.error('操作出错请重试！');
                        }
                    );
                };
                // check and save for the edit in place
                vm.checkAndSaveMathskill = function(data,field,mathskill,rules) {
                    console.log(data);
                var d = $q.defer();
                var returned = simplevalidate.dovalidateQuery(
                    'http://kidsit.cn/admin/api/math/skill/?catsubid='+mathskill.catsubid+'&mathskillcat_id='+_.findWhere($scope.mathskillcats,{catlabel:data}).id);
                returned.then(
                    function (response) {
                        if (response){
                            // already exist
                            d.resolve(response);
                            toastr.error(response);
                        }else{
                            // can use and 0 returned by simplevalidation service
                            mathskill.category.catlabel = data;
                            mathskill.category.id = _.findWhere($scope.mathskillcats,{catlabel:data}).id ;
                            mathskill.mathskillcat_id = mathskill.category.id ;

                            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/math/skill/"+mathskill.id,mathskill);
                            promise.then(
                                function(mathskilldata) {/*success*/
                                    if (mathskilldata.resp.code !==0 ){
                                        d.resolve(mathskilldata.resp.message);
                                        toastr.error(mathskilldata.resp.message);
                                    }
                                    else{
                                        d.resolve();
                                        toastr.success(_.findWhere($scope.mathskillcats,{catlabel:data}).catlabel+"更新成功！");
                                    }
                                },
                                function(status) {
                                    d.resolve(status);
                                    toastr.error(mathskill[field]+'操作出错请重试！');
                                }
                            );
                        }
                    },
                    function (response) {
                        d.resolve(response);
                        toastr.error(response);
                    }
                );
                    return d.promise;
                };
                $scope.owner = {
                    id: 5,
                    name: "chenxiu"
                };
                vm.loadMathskillSelectableOwners = function () {
                    khttp.getAll("http://kidsit.cn/admin/api/math/skill").then(
                    function(teacherkeys) {/*success*/
                        // console.log($scope.owners);
                        },
                    function(status) {console.log("error status code:"+status);}
                    );
                };
            }
        })();