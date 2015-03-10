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
                        $scope.mathskills = vm.mathskillsOrginal = mathskillsdata.resp.data;
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
                    return mathskill.skilllabel.split(".")[1];
                };
                vm.updateMathskilllabel = function (data,field,mathskill) {
                    mathskill.skilllabel = mathskill.category.catlabel+'.'+data;
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
                var d = $q.defer();
                var returned = simplevalidate.dovalidate(rules,data,
                                                        'http://kidsit.cn/admin/api/math/skill/');
                returned.then(
                    function (response) {
                        if (response){
                            // already exist
                            d.resolve(response);
                            toastr.error(response);
                        }else{
                            // can use and 0 returned by simplevalidation service
                            mathskill[field] = data;
                            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/math/skill/"+mathskill.id,mathskill);
                            promise.then(
                                function(mathskilldata) {/*success*/
                                    if (mathskilldata.resp.code !==0 ){
                                        d.resolve(mathskilldata.resp.message);
                                        toastr.error(mathskilldata.resp.message);
                                    }
                                    else{
                                        d.resolve();
                                        if (field=='teacher_id'){
                                            mathskill.owner.name = _.findWhere($scope.owners,{id:data}).name ;
                                            mathskill.owner.id = data;
                                            toastr.success(_.findWhere($scope.owners,{id:data}).name+"更新成功！");
                                        }
                                        else{
                                            toastr.success(data+" 更新成功！");
                                        }

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