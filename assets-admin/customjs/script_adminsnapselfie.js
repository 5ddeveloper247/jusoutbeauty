var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false;
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false;
//	});


	$scope.editView = 0;
    $scope.snapDetail = 1;
    $scope.Reply = {};
    $scope.Reply.R_1 = '';
    $scope.Reply.Products = {};
    $scope.ProductIds = {};
    $scope.UserDetail = {};
    $scope.UserDetail.USERNAME = '';
    $scope.UserDetail.USER_EMAIL = '';
    $scope.UserDetail.DATE = '';
    $scope.UserDetail.DOWNPATH = '';
    $scope.Ids = '';


	$scope.tokenHash = $("#csrf").val();

	$scope.getAllAdminSnapSelfielov = function(){

		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminSnapSelfielov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if ($.fn.DataTable.isDataTable("#snapselfieTable")) {
				$('#snapselfieTable').DataTable().clear().destroy();
			}

			$scope.displayCollectionSnapselfie = data.list;

			setTimeout(function(){
				$("#snapselfieTable").DataTable({
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
				});
			}, 500);
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminSnapSelfielov();
    $scope.selfieToBeDeleted = '';
    $scope.openConfirmDeleteModalForSelfie = function($id){
        $scope.selfieToBeDeleted = $id;
        $('#alertDelSelfie').modal('show');
    }
	// For delete Selfi
	$scope.deleteSelfieConfirmed = function(){

		var data = {};
		data.recordId = $scope.selfieToBeDeleted;

		var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSelfieDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
            $scope.selfieToBeDeleted = '';
            $('#alertDelSelfie').modal('hide');
			$scope.getAllAdminSnapSelfielov();

		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.showSelfieDetail = function(id){
        $scope.editView = 1;
        $scope.snapDetail = 0;
        var data = {};
        data.recordId = id;
        data.userId = userId;
        var temp = $.param({details: data});
        $http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/getSnapDetail/"+id,
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            // console.log(data.Ids)
            $scope.productlov = data.Products;
            $scope.UserDetail = data.SelfieDetails;

            if (data.SelfieReply !== '') {
                $scope.Reply.R_1 = data.SelfieReply.ADMIN_REPLY;
                $scope.checkId = 1;
                setTimeout(function(){
                    $scope.Reply.Products = data.Ids;
                    console.log($scope.Reply.Products);
                    $('#products').val(data.Ids).trigger('change');
                    console.log($scope.Reply);
                }, 1000);
            }else
            {
                $scope.checkId = 0;
                $scope.Reply.R_1 = '';
                console.log($scope.Reply);

            }




		})
		.error(function(data, status, headers, config) {
		});
    }

    $scope.backToSnaps = function (){
        $scope.getAllAdminSnapSelfielov();
        setTimeout(function(){
            $scope.editView = 0;
            $scope.snapDetail = 1;
        },100)

    }

    $scope.sendSelfieReply = function (){
        var data = {
            Reply: {
                Products: $scope.Reply.Products,
                R_1: $scope.Reply.R_1
            },
            UserDetail : $scope.UserDetail,
            SenderId : userId,
            BaseUrl : site
        };
        console.log(data);

        var temp = $.param({details: data});
        $http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/sendSelfieReply",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
            if (data.done == true || data.done == 'true') {

            toastr.success(data.msg, '', {timeOut: 3000})
            $scope.checkId = 1;
            }else{
            toastr.error(data.msg, '', {timeOut: 3000})
            $scope.checkId = 0;
            }
			// $scope.showSelfieDetail();
		})
		.error(function(data, status, headers, config) {
            toastr.error(data.msg, '', {timeOut: 3000})
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
				setTimeout(function(){
					$.LoadingOverlay("hide");
				}, 500);
				if(typeof response.data != 'object'){ //might have some error
					var temp = response.data.toLowerCase();
					if(temp.indexOf("error") >= 0){  //result may have error
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
				setTimeout(function(){
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
