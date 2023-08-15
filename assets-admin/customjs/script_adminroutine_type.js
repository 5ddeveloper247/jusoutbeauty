var myApp = angular.module('project1', ["smart-table"], function () { });
myApp.controller('projectinfo1', function ($scope, $compile, $rootScope, $timeout, $http, $window, $filter, $q, $routeParams) {


    $scope.routinetype = {};
    $scope.routinetype.ID = "";

    $scope.remove_routine_type_name = function () {

        // $scope.alertDeleteMsg = 'Are You Sure You want to delete this step';

        // $("#alertDel").modal('show');
        var data = {};

        data.typenameid = $('#routine_type_remove_id').val();
        //  data.typeid= $scope.routinename.ID;
        data.userId = userId;
        var temp = $.param({ details: data });
        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/remove_routine_type_name",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {

                $scope.getAllAdminRoutinenamelov();
                toastr.success(data.msg, '', { timeOut: 3000 })
                $('#alertroutinetypemodal').modal('hide');

            } else {
                toastr.error(data.msg, '', { timeOut: 3000 })
                $('#alertroutinetypemodal').modal('hide');

            }
        })
            .error(function (data, status, headers, config) {
            });
    }
    $scope.continuetypename = function (id) {

        var data = {};
        data.recordId = id;
        data.userId = userId;


        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/routine_type_name_edit",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            var details = data.typename;
            $scope.routinetype.C_1 = details['name'];
            $scope.routinetype.ID = details['ID'];
            $('#RoutineTypeModal').modal('show');


        })
            .error(function (data, status, headers, config) {
            });
    }

    $scope.removetypenamemodal = function (id) {

        $('#routine_type_remove_id').val('');
        $('#routine_type_remove_id').val(id);
        $('#alertroutinetypemodal').modal('show');
    }

    $scope.addtype = function () {
        $scope.routinetype.C_1 = "";
        $scope.routinetype.ID = "";
        $('#RoutineTypeModal').modal('show');

    }

    $scope.getAllAdminRoutinenamelov = function () {

        var data = {};
        data.userId = userId;
        data.ingredientId = $scope.routinenameId;
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + '/getAllAdminroutinetype',
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if ($.fn.DataTable.isDataTable("#type_table")) {
                $('#type_table').DataTable().clear().destroy();
            }

            //  $scope.displayCollection = data.list;

            $scope.getAllRoutineTypes = data.routinetypes;

            console.log(data.routinetypes);
            // $scope.RoutineTypelov=data.routinetypessteps;

            setTimeout(function () {
                $("#type_table").DataTable({
                    order: [],
                    aLengthMenu: [
                        [10, 25, 50, 100, 200, -1],
                        [10, 25, 50, 100, 200, "All"]
                    ]
                });
            }, 500);
        })
            .error(function (data, status, headers, config) {
            });
    }
    $scope.getAllAdminRoutinenamelov();

    $scope.activeInactivetypeName = function (id){
        var data = {};
        data.routineId = id;
        data.userId = userId;
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/change_routine_type_status",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {

                // $scope.getTypeNameLov();
                toastr.success(data.msg, '', { timeOut: 3000 })

                $scope.getAllAdminRoutinenamelov();

            } else {
                toastr.error(data.msg, '', { timeOut: 3000 })
            }
        })
            .error(function (data, status, headers, config) {
            });
    }

    $scope.saveTypename = function () {

        var data = {};

        data.routinetype = $scope.routinetype;
        // data.typeid= $scope.routinename.ID;
        data.userId = userId;
        var temp = $.param({ details: data });

        $http({
            data: temp + "&" + $scope.tokenHash,
            url: site + "/add_routine_type_name",
            method: "POST",
            async: false,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }

        }).success(function (data, status, headers, config) {

            if (data.done == true || data.done == 'true') {

                // $scope.getTypeNameLov();
                toastr.success(data.msg, '', { timeOut: 3000 })

                $scope.getAllAdminRoutinenamelov();
                $('#RoutineTypeModal').modal('hide');
                // 	setTimeout(function(){
                // 	$('#type_table').DataTable().destroy();

                // 	$('#type_table').DataTable( {
                // 	 order: [],
                // 	 aLengthMenu: [
                // 				   [10, 25, 50, 100, 200, -1],
                // 				   [10, 25, 50, 100, 200, "All"]
                // 			   ]
                //  } );
                // }, 1000);


                // $scope.routinename.ID = data.ID;
                //				window.location = data.redirect_url;

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


// 	$('#searchInListing').on("keyup", function (e)  {
//            var tr = $('.identify');
//
//            if ($(this).val().length >= 1) {//character limit in search box.
//                var noElem = true;
//                var val = $.trim(this.value).toLowerCase();
//                el = tr.filter(function() {
//                    return $(this).find('.grid-p-searchby').text().toLowerCase().match(val);
//                });
//                if (el.length >= 1) {
//                    noElem = false;
//                }
//                if(el.length<1) {
////    		            	$('#tabContentNoData').show();
//                } else {
////    		            	$('#tabContentNoData').hide();
////    		            	$('#tabContentData').show();
//                	}
//                tr.not(el).hide();
//                el.fadeIn();
//            } else {
//                tr.fadeIn();
//                if(veiwMoreShowGlobal==true){
//                }
//                else{
//                }
////    	            	$('#tabContentNoData').hide();
//
//            }
//        });







