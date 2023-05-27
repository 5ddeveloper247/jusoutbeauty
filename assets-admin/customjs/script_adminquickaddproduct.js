var myApp = angular.module('project1', ["smart-table"], function () { });
myApp.controller('projectinfo1', function ($scope, $rootScope, $timeout, $http, $window, $filter, $q, $routeParams) {


    $scope.basicEditView = 0;

    $scope.QuickProduct = {};
    $scope.QuickProduct.ID = productId;
    $scope.QuickProduct.P_1 = "";
    $scope.QuickProduct.P_2 = "";
    $scope.QuickProduct.P_3 = "";
    $scope.QuickProduct.P_4 = "";
    $scope.QuickProduct.P_5 = "";
    $scope.QuickProduct.P_6 = "";

    $scope.getQuickAddAdminProduct = function () {
        var data = {};
        data.userId = userId;
        data.productId = $scope.QuickProduct.ID;

        var temp = $.param({ details: data });

        $http({
            data: temp ,
            url: site + "/getQuickAddAdminProduct",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            $scope.QuickProduct = data.productDetails;
            // console.log($scope.QuickProduct.NAME, 'asd');
            setTimeout(function () {
                $("#p1").val($scope.QuickProduct.P_1).trigger('change');
                $("#p2").val($scope.QuickProduct.P_2).trigger('change');
                $("#p3").val($scope.QuickProduct.P_3).trigger('change');
                $("#p4").val($scope.QuickProduct.P_4).trigger('change');
                $("#p5").val($scope.QuickProduct.P_5).trigger('change');
                $("#p6").val($scope.QuickProduct.P_6).trigger('change');
             
            }, 500);
        })
            .error(function (data, status, headers, config) {
            });
    }
    $scope.getQuickAddAdminProduct();
    $scope.editBasicInfo = function () {
       
        setTimeout(function () {
            $("#p1").val($scope.QuickProduct.P_1).trigger('change');
            $("#p2").val($scope.QuickProduct.P_2).trigger('change');
            $("#p3").val($scope.QuickProduct.P_3).trigger('change');
            $("#p4").val($scope.QuickProduct.P_4).trigger('change');
            $("#p5").val($scope.QuickProduct.P_5).trigger('change');
            $("#p6").val($scope.QuickProduct.P_6).trigger('change');

        }, 500);
        $scope.basicEditView = 1;

        
    }

    $scope.cancelBasicInfo = function () {
        $scope.basicEditView = 0;
    }

    $scope.updateBasicInfo = function () {

        var data = {};
        data.userId = userId;
        data.record = $scope.QuickProduct;
        
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/updateAdminQuickProductBasicInfo",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {
                
                console.log($scope.QuickProduct.P_1,'1213');
                setTimeout(function () {
                    $("#p7").html($scope.QuickProduct.P_1).trigger('change');
                    $("#p8").html($scope.QuickProduct.P_2).trigger('change');
                    $("#p9").html($scope.QuickProduct.P_3).trigger('change');
                    $("#p10").html($scope.QuickProduct.P_4).trigger('change');
                    $("#p11").html($scope.QuickProduct.P_5).trigger('change');
                    $("#p12").html($scope.QuickProduct.P_6).trigger('change');
                    
                }, 500);
                $scope.basicEditView = 0;
                toastr.success(data.msg, '', { timeOut: 3000 })

            } else {
                toastr.error(data.msg, '', { timeOut: 3000 })
            }
        })
        .error(function (data, status, headers, config) {
        });


    }















})
    .config(function ($httpProvider, $provide) {
        $provide.factory('httpInterceptor', function ($q, $rootScope) {
            return {
                'request': function (config) {
                    $.LoadingOverlay("show");

                    $rootScope.$broadcast('httpRequest', config);
                    return config || $q.when(config);
                },
                'response': function (response) {
                    setTimeout(function () {
                        $.LoadingOverlay("hide");
                    }, 500);
                    if (typeof response.data != 'object') { //might have some error

                        var temp = response.data.toLowerCase();
                        if (temp.indexOf("error") >= 0) {  //result may have error
                            console.log("Response is not obj and has Error");
                            $("div#error").html(response.data);
                            jQuery("#errorModal").modal('show');
                            return
                        }

                    }
                    $rootScope.$broadcast('httpResponse', response);
                    return response || $q.when(response);
                },
                'requestError': function (rejection) {
                    console.log("requestError");
                    $.LoadingOverlay("hide");
                    $("div#error").html(rejection.data);
                    jQuery("#errorModal").modal('show');
                    $rootScope.$broadcast('httpRequestError', rejection);
                    return $q.reject(rejection);
                },
                'responseError': function (rejection) {
                    setTimeout(function () {
                        $.LoadingOverlay("hide");
                    }, 500);
                    console.log("responseError");
                    $("div#error").html(rejection.data);
                    jQuery("#errorModal").modal('show');
                    $rootScope.$broadcast('httpResponseError', rejection);
                    return $q.reject(rejection);
                }
            };
        });
        $httpProvider.interceptors.push('httpInterceptor');
    })