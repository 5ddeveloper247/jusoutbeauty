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
	
	$scope.getAllAdminPaymentslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminPaymentslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#paymentsTable")) {
				$('#paymentsTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionPayments = data.payments;
			
			setTimeout(function(){
				$("#paymentsTable").DataTable({
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
	$scope.getAllAdminPaymentslov();
	
		
	$scope.backToListing = function(){
		$scope.editView = 0;
		
		$scope.customerName = '';
		$scope.orderNumber = '';
		$scope.totalAmount = '';
		$scope.taxAmount = '';
		$scope.paymentDate = '';
		$scope.paymentStatus = '';
		$scope.transactionId = '';
		$scope.paymentMethod = '';
		
	}
	
	$scope.customerName = '';
	$scope.orderNumber = '';
	$scope.totalAmount = '';
	$scope.taxAmount = '';
	$scope.paymentDate = '';
	$scope.paymentStatus = '';
	$scope.transactionId = '';
	$scope.paymentMethod = '';
	
	$scope.viewPaymentDetails = function(paymentId){
		
		var data = {};
	    data.userId = userId;
	    data.paymentId = paymentId;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificAdminPaymentDetail',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			var detail = data.details;
			console.log(detail);
			
			if(detail != null){
				$scope.customerName = detail['USERNAME'];
				$scope.orderNumber = detail['ORDER_NUMBER'];
				$scope.totalAmount = detail['totalOrderAmount'];
				$scope.taxAmount = detail['totalVatAmount'];
				$scope.paymentDate = detail['PAYMENT_DATE'];
				$scope.paymentStatus = detail['PAYMENT_STATUS'];
				$scope.transactionId = detail['TRANSACTION_ID'];
				$scope.paymentMethod = detail['PAYMENT_TYPE'];
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
