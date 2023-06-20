var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});
//
//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.editView = 0;
//
	$scope.tokenHash = $("#csrf").val();

	$scope.resetGlobal = function(){
		$scope.search.S_1 = '';
		$scope.search.S_2 = '';
		$scope.search.S_3 = '';
		$('#search_4').val('');
		$('#search_5').val('');
	}
//	
	$scope.getAllUserOrderslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllUserOrderslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.categoryLov = data.list1;
			$scope.subcategoryLov = data.list2;
			
			if ($.fn.DataTable.isDataTable("#orderListing_table")) {
				$('#orderListing_table').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionOrders = data.list;
			
			setTimeout(function(){
				$("#orderListing_table").DataTable({
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
	$scope.getAllUserOrderslov();
		
	$scope.backToListing = function(){
		$scope.editView = 0;
		$scope.getAllUserOrderslov();
	}
	$scope.viewProductShades = function(orderLineId){
		var data = {};
	    data.orderLineId = orderLineId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificUserShadeNameDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			 $scope.displayCollectionShadesName = data.shadename;
			$('#show_shade_modal').modal('show');
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.viewOrderDetails = function(orderId){
		
		var data = {};
	    data.userId = userId;
	    data.orderId = orderId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificUserOrderDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.editView = 1;
			var order = data.order;
			var shipping = data.shipping;
			var payment = data.payment;
			var shipment = data.shipment;
			var tracking = data.tracking;
			
			$scope.displayCollectionOrderLines = data.details;
			$scope.displayCollectionOrderTracking = data.tracking;
			
			$scope.orderId = order['ORDER_ID'];
			$scope.orderNumber = order['ORDER_NUM'];
			$scope.orderStatus = order['ORDER_STATUS'];
			$scope.orderDate = order['ORDER_DATE'];

			$scope.ordersubTotal = order['ExtVatTotalAmount'];
			$scope.orderTaxAmount = order['totalVatAmount'];
			$scope.orderTotalIncTax = order['IncVatTotalAmount'];
			$scope.orderDiscount = order['totalDiscountAmount'];
			$scope.orderTotalAmount = order['grandTotal'];
			
			$scope.orderPayType = payment['PAYMENT_TYPE'];
			
			$scope.orderShipName = shipping['FIRST_NAME']+' '+shipping['LAST_NAME'];
			$scope.orderShipEmail = shipping['EMAIL'];
			$scope.orderShipPhone = shipping['PHONE_NUMBER'];
			$scope.orderShipAdres = shipping['ADDRESS'];
			$scope.orderShipCountry = shipping['COUNTRY_NAME'];
			
			$scope.shipment.ID = shipment['SHIPPING_ID'];
			$scope.shipment.S_1 = shipment['SHIPPING_COMPANY_NAME'];
			$scope.shipment.S_2 = shipment['STATUS'];
			$scope.shipment.S_3 = shipment['TRACKING_NUMBER'];
			$scope.shipment.S_4 = shipment['EXPECTED_DELIVERY_DATE'];
			
		})
		.error(function(data, status, headers, config) {
		});
	}
//	$scope.orderStatusShipmentConfirm = function(){
//		
//		var data = {};
//	    data.userId = userId;
//	    data.orderId = $scope.orderId;
//	    var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+'/orderStatusShipmentConfirm',
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//			
//			$scope.viewOrderDetails($scope.orderId);
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
	
	$scope.shipment = {};
	$scope.shipment.ID = '';
	$scope.shipment.S_1 = '';
	$scope.shipment.S_2 = '';
	$scope.shipment.S_3 = '';
	$scope.shipment.S_4 = '';
	
//	$scope.addShipmentInfo = function(){
//		
//		var data = {};
//	    data.userId = userId;
//	    data.orderId = $scope.orderId;
//	    data.shipment = $scope.shipment;
//	    
//	    var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+'/addOrderShipmentDetail',
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//			
//			if(data.done == true || data.done == 'true'){
//				
//				toastr.success(data.msg, '', {timeOut: 3000})
//				
//				var shipment = data.shipment;
//				$scope.shipment.ID = shipment['SHIPPING_ID'];
//				$scope.shipment.S_1 = shipment['SHIPPING_COMPANY_NAME'];
//				$scope.shipment.S_2 = shipment['STATUS'];
//				$scope.shipment.S_3 = shipment['TRACKING_NUMBER'];
//				$scope.shipment.S_4 = shipment['EXPECTED_DELIVERY_DATE'];
//				
//			}else{
//				toastr.error(data.msg, '', {timeOut: 3000})
//			}
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
	
//	$scope.shipmentStatusUpdate = function(flag){
//		
//		var data = {};
//	    data.userId = userId;
//	    data.shippingId = $scope.shipment.ID;
//	    data.orderId = $scope.orderId;
//	    data.flag = flag;
//	    var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+'/shipmentStatusUpdate',
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//			
//			$scope.viewOrderDetails($scope.orderId);
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
	$scope.search = {};
	$scope.search.S_1 = '';
	$scope.search.S_2 = '';
	$scope.search.S_3 = '';
	$scope.search.S_4 = '';
	$scope.search.S_5 = '';
	
	
	$scope.searchGlobal = function(){
		
		$scope.search.S_4 = $("#search_4").val();
		$scope.search.S_5 = $("#search_5").val();
		
		var data = {};
	    data.userId = userId;
	    data.search = $scope.search;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/searchShipmentUserOrders',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			
			if(data.done == true || data.done == 'true'){
				
				if ($.fn.DataTable.isDataTable("#orderListing_table")) {
					$('#orderListing_table').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionOrders = data.order;
				
				setTimeout(function(){
					$("#orderListing_table").DataTable({
						order: [],
			            aLengthMenu: [
			                          [10, 25, 50, 100, 200, -1],
			                          [10, 25, 50, 100, 200, "All"]
			                      ]
					});
				}, 500);				
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
			
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




		
		
		
