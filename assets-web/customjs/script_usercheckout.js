var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on("click", "#chooseShadeBtn", function () {
//		
//		$("#chooseShade_container").slideToggle('slow');
//		
//	});
$scope.viewProductShadesCheckout = function(orderLineId){

	var data = {};
	data.orderLineId = orderLineId;
	
	var temp = $.param({details: data});
	
	$http({
		data: temp+"&"+$scope.tokenHash,
		url : site+'/getSpecificUserShadeNameDetailsUserCheckout',
		method: "POST",
		async: false,
		headers: {'Content-Type': 'application/x-www-form-urlencoded'}

	}).success(function(data, status, headers, config) {
		
		
		 $scope.displayCollectionCheckoutShadeName = data.shadename;
		 $('#show_shade_modal_checkout').modal('show');
	})
	.error(function(data, status, headers, config) {
	});
}
	$scope.cartId = '';
	$scope.subTotal = '0.00';
	$scope.totalTax = '0.00';
	$scope.totalIncVat = '0.00';
	$scope.totalDiscount = '0.00';
	$scope.grandTotal = '0.00';
	$scope.cloverPaymentgrandTotal1 = '0';
	
	$scope.formstep = '1';
	
	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllCheckoutPageLov = function(){
		
		var data = {};
	    data.userId = userId;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllCheckoutPageLov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.countryLov = data.list1;
			
			var cart = data.cart;
			
			$scope.displayCollectionCart = data.cartDetails;
			
			if(cart != null && cart != ''){
				$scope.cartId = cart['CART_ID'];
				
				$scope.subTotal = cart['ExtVatTotalAmount'];
				$scope.totalTax = cart['totalVatAmount'];
				$scope.totalIncVat = cart['IncVatTotalAmount'];
				$scope.totalDiscount = cart['totalDiscountAmount'];
				$scope.grandTotal = cart['grandTotal'];
				$scope.cloverPaymentgrandTotal1 = cart['cloverPaymentgrandTotal1'];
//				$scope.cartSubTotal = cart['ExtVatTotalAmount'];
//				$scope.cartTotalAmount = cart['cartAmount'];
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllCheckoutPageLov();

	$scope.shipping={};
	$scope.shipping.ID = "";
	$scope.shipping.S_1 = "";
	$scope.shipping.S_2 = "";
	$scope.shipping.S_3 = "";
	$scope.shipping.S_4 = "";
	$scope.shipping.S_5 = "";
	$scope.shipping.S_6 = "";
	$scope.shipping.S_7 = "";
	$scope.shipping.S_8 = "";
	$scope.shipping.S_9 = "";
	$scope.shipping.S_10 = "";
	$scope.shipping.S_11 = "";
	
	
	$scope.payment={};
	$scope.payment.ID = "";
	$scope.payment.payType = "credit"; // payment type
	$scope.payment.P_1 = "";
	$scope.payment.P_2 = "";
	$scope.payment.P_3 = "";
	$scope.payment.P_4 = "";
	
	$scope.postOrderCheckout = function(){
		
		if($scope.cartId == ''){
			
			toastr.error('Something went wrong...', '', {timeOut: 3000});
			return;
		
		}else{
		
			var data = {};
		    data.userId = userId;
		    data.cartId = $scope.cartId;
		    data.shipping = $scope.shipping;
		    data.payment = $scope.payment;
		    
//		    console.log(data);
//		    return;
		    
		    var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+'/postOrderCheckout',
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
				
				if(data.done == true || data.done == 'true'){
					
					toastr.success(data.msg, '', {timeOut: 3000});
					
					window.location = data.redirect_url;
					
				}else{
					toastr.error(data.msg, '', {timeOut: 3000})
				}
			})
			.error(function(data, status, headers, config) {
			});
		}
	}
	$scope.saveShippingInformation = function(){
		
		if($scope.cartId == ''){
			
			toastr.error('Something went wrong...', '', {timeOut: 3000});
			return;
		
		}else{
		
			var data = {};
		    data.userId = userId;
		    data.cartId = $scope.cartId;
		    data.shipping = $scope.shipping;
		    
//		    console.log(data);
//		    return;
		    
		    var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+'/saveShippingInfo',
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
				
				if(data.done == true || data.done == 'true'){
					
					toastr.success(data.msg, '', {timeOut: 3000});
					
					$scope.formstep = '2';
					
				}else{
					toastr.error(data.msg, '', {timeOut: 3000})
				}
			})
			.error(function(data, status, headers, config) {
			});
		}
	}

	$scope.paymentoption = function(i){
		
		$scope.payment={};
		$scope.payment.ID = "";
		$scope.payment.P_1 = "";
		$scope.payment.P_2 = "";
		$scope.payment.P_3 = "";
		$scope.payment.P_4 = "";
		if(i==1){
			$scope.payment.payType = 'paypal';
		}else{
			$scope.payment.payType = 'credit';
		}
		
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




		
		
		
