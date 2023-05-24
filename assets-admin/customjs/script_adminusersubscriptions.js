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

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllUserSubscriptionslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminUserSubscriptionslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#subscriptionListing_table")) {
				$('#subscriptionListing_table').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionSubsc = data.list;
			
			setTimeout(function(){
				$("#subscriptionListing_table").DataTable();
			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllUserSubscriptionslov();
	
	$scope.backToListing = function(){
		$scope.editView = 0;
	}

	$scope.subsId = '';
	$scope.subsNumber = '';
	$scope.subsName = '';
	$scope.subsUsername = '';
	$scope.subsStatus = '';
	$scope.paymentStatus = '';
	$scope.subsDate = '';
	$scope.nextPayDate = '';
	$scope.productName = '';
	$scope.productPrimaryImage = '';
	$scope.productDesc = '';
	$scope.productUnitPrice = '';
	$scope.productQuantity = '';
	$scope.productTotalAmount = '';
	
	$scope.subsSubTotal = '0';
	$scope.subsTaxAmount = '0';
	$scope.subsTotalIncTax = '0';
	$scope.subsDiscount = '0';
	$scope.grandTotalAmount = '0';
	$scope.cloverGrandTotal = '0';
	
	$scope.viewSubscriptionDetail = function(subsId){
		
		$scope.editView = 1;
		
		var data = {};
	    data.userId = userId;
	    data.subsId = subsId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificAdminUserSubscriptionDetail',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			var detail = data.detail;
			
			if(detail != null){
				
				$scope.subsId = detail['USER_SUBSCRIPTION_ID'];
				$scope.subsNumber = detail['subscriptionNum'];
				$scope.subsName = detail['subsName'];
				$scope.subsUsername = detail['userFirstName']+' '+detail['userLastName'];
				$scope.subsStatus = detail['SUBSCRIPTION_STATUS'];
				$scope.paymentStatus = detail['PAYMENT_STATUS'];
				$scope.subsDate = detail['SUBSCRIPTION_DATE'];
				$scope.nextPayDate = detail['NEXT_PAYMENT_DATE'];
				
				$scope.productName = detail['productName'];
				$scope.productPrimaryImage = detail['primaryImage'];
				$scope.productDesc = detail['productDesc'];
				$scope.productUnitPrice = detail['UNIT_PRICE'];
				$scope.productQuantity = detail['QUANTITY'];
				$scope.productTotalAmount = detail['TOTAL_AMOUNT'];
				
				$scope.subsSubTotal = detail['TOTAL_AMOUNT'];
				$scope.subsTaxAmount = detail['totalVatAmount'];
				$scope.subsTotalIncTax = detail['IncVatTotalAmount'];
				$scope.subsDiscount = detail['subsDiscount'];
				$scope.grandTotalAmount = detail['grandTotal'];
				$scope.cloverGrandTotal = detail['cloverGrandTotal'];
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.updateSubcriptionStatusmy = function(){
		
		console.log($scope.subsId,'id');
		
		var data = {};
	    data.userId = userId;
	    data.subsId = $scope.subsId;
		data.flag = '0';// 1 for active
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/updateSpecificUserSubscriptionStatusAdmin',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			console.log(data.done);
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, 'Status Updated successfully', {timeOut: 3000})
				
				$scope.getAllUserSubscriptionslov();
				$scope.backToListing();
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




		
		
		
