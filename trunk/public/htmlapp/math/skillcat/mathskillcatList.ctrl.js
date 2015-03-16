// mathskillcatList.ctrl.js created by zhenghua@kidsit.cn on 08/03/2015 
(function () {
    'use strict';
    angular
        .module('mathskillcatApp')
        .controller('mathskillcatListCtrl',mathskillcatListCtrl);
        mathskillcatListCtrl.$inject = ['$scope','$window','toastr','$location','khttp','$q','simplevalidate'];

            function mathskillcatListCtrl($scope,$window,toastr,$location,khttp,$q,simplevalidate) {
                /*jshint validthis: true */
                var vm = this;
                var promise;
                vm.currentPromise = promise = khttp.getAll("http://kidsit.cn/admin/api/math/skillcat");
                promise.then(
                    function(mathskillcatsdata) {/*success*/
                        $scope.mathskillcats = vm.mathskillcatsOrginal = mathskillcatsdata.resp.data;
                        },
                    function(status) {console.log("error status code:"+status);}
                );
                vm.deleteMathskillcat = function(mathskillcat){

                    khttp.destroy("http://kidsit.cn/admin/api/math/skillcat/",mathskillcat).then(
                        
                        function(res){
                            $scope.mathskillcats.splice($scope.mathskillcats.indexOf(mathskillcat),1);
                            toastr.success(res.resp.message);
                        },
                        function(error){
                            toastr.error(res.resp.message);
                        }
                    );
                    $location.path('/mathskillcat-list');
                };
                // check and save for the edit in place
                vm.checkAndSaveMathskillcat = function(data,field,mathskillcat,rules) {
                var d = $q.defer();
                var returned = simplevalidate.dovalidate(rules,data,
                                                        'http://kidsit.cn/admin/api/math/skillcat/');
                returned.then(
                    function (response) {
                        if (response){
                            // already exist
                            d.resolve(response);
                            toastr.error(response);
                        }else{
                            // can use and 0 returned by simplevalidation service
                            mathskillcat[field] = data;
                            vm.currentPromise = promise = khttp.update("http://kidsit.cn/admin/api/math/skillcat/"+mathskillcat.id,mathskillcat);
                            promise.then(
                                function(mathskillcatdata) {/*success*/
                                    if (mathskillcatdata.resp.code !==0 ){
                                        d.resolve(mathskillcatdata.resp.message);
                                        toastr.error(mathskillcatdata.resp.message);
                                    }
                                    else{
                                        d.resolve();
                                        if (field=='teacher_id'){
                                            // mathskillcat.owner.name = _.findWhere($scope.owners,{id:data}).name ;
                                            // mathskillcat.owner.id = data;
                                            // toastr.success(_.findWhere($scope.owners,{id:data}).name+"更新成功！");
                                        }
                                        else{
                                            toastr.success(data+" 更新成功！");
                                        }

                                    }
                                },
                                function(status) {
                                    d.resolve(status);
                                    toastr.error(mathskillcat[field]+'操作出错请重试！');
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
                $scope.owners=[];
                vm.loadMathskillcatSelectableOwners = function () {
                    khttp.getAll("http://kidsit.cn/admin/api/math/skillcat").then(
                    function(teacherkeys) {/*success*/
                        $scope.owners = teacherkeys.resp.data;
                        console.log($scope.owners);
                        },
                    function(status) {console.log("error status code:"+status);}
                    );
                };
            }
        })();