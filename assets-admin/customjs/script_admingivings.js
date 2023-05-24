var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	
	$scope.editView = 0;
//
	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminGivings = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminGivings',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#givingsTable")) {
				$('#givingsTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionGivings = data.givings;
			
			setTimeout(function(){
				$("#givingsTable").DataTable({
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
	$scope.getAllAdminGivings();
	
		
	$scope.backToListing = function(){
		$scope.editView = 0;
		
		$scope.customerName = '';
		$scope.userEmail = '';
		$scope.userPhone = '';
		$scope.amount = '';
		$scope.paymentDate = '';
		$scope.paymentType = '';
		$scope.transactionId = '';
		$scope.paymentStatus = '';
		
	}
	
	$scope.customerName = '';
	$scope.userEmail = '';
	$scope.userPhone = '';
	$scope.amount = '';
	$scope.paymentDate = '';
	$scope.paymentType = '';
	$scope.transactionId = '';
	$scope.paymentStatus = '';
	
	$scope.viewSpecificAdminGivingDetail = function(givingId){
		
		var data = {};
	    data.userId = userId;
	    data.givingId = givingId;
	    
		
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificAdminGivingDetail',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			
		}).success(function(data, status, headers, config) {
			
			var detail = data.details;
			if(detail != null){
				$scope.customerName = detail['USERNAME'];
				$scope.userEmail = detail['USER_EMAIL'];
				$scope.userPhone = detail['USER_PHONE'];
				$scope.amount = detail['AMOUNT'];
				$scope.paymentDate = detail['PAYMENT_DATE'];
				$scope.paymentType = detail['PAYMENT_TYPE'];
				$scope.transactionId = detail['TRANSACTION_ID'];
				$scope.paymentStatus = detail['PAYMENT_STATUS'];
				// console.log($scope.customerName);
			}
			
			$scope.editView = 1;
			
		})
		.error(function(data, status, headers, config) {
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
