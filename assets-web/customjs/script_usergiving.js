var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on("click", "#chooseShadeBtn", function () {
//		
//		$("#chooseShade_container").slideToggle('slow');
//		
//	});
	
	$scope.giving={};
	$scope.giving.G_1 = "";
	$scope.giving.G_2 = "";
	$scope.giving.G_3 = "";
	$scope.giving.G_4 = "";
	$scope.giving.G_5 = "5";
	$scope.cloverGivingAmount = '500';
	
	$scope.paymentStep = 1;
	
	$scope.backtoStep1 = function(){
		$scope.paymentStep = 1;
		$("#clover_second").hide(1000);
        $("#clover_first").show(1000);
	}
	
	$scope.makePayment = function(){
		
		if($scope.paymentStep == 1){
			
			console.log($scope.giving);
			if($scope.giving.G_1 == ''){
				toastr.error('First Name is required.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_1.length > 100){
				toastr.error('First Name must be less then 100 characters.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_2 == ''){
				toastr.error('Last Name is required.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_2.length > 100){
				toastr.error('Last Name must be less then 100 characters.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_3 == ''){
				toastr.error('Email is required.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_3 != ''){
			
				var email = $scope.giving.G_3;
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				
				if( !emailReg.test( email )) {
					toastr.error('Email is not valid.', '', {timeOut: 3000});return;
				}
			}
			if($scope.giving.G_4 == '' || $scope.giving.G_4 == null){
				toastr.error('Phone Number is required.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_4.length < 10){
				toastr.error('Phone Number is not valid', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_5 == ''){
				toastr.error('Amount is required.', '', {timeOut: 3000});return;
			}
			if($scope.giving.G_5 <= 0){
				toastr.error('Amount must be greater then zero.', '', {timeOut: 3000});return;
			}
			
			$scope.cloverGivingAmount = $scope.giving.G_5 * 100;
			$scope.paymentStep = 2;
			$("#clover_second").show(1000);
		    $("#clover_first").hide(1000);
			
		}else if($scope.paymentStep == 2){
		
			$('#payNow_btn').click();
		
		}
	}
	$scope.close_giving_modal_clover = function(){
		
		$scope.paymentStep = 1;
		$("#clover_first").show(1000);
		$("#clover_second").hide(1000);
        $("#show_giving_modal_clover").modal('hide');
	}
	
	$scope.donatePayment = function(){
		alert('12');
		// $scope.giving={};
		// $scope.giving.G_1 = "";
		// $scope.giving.G_2 = "";
		// $scope.giving.G_3 = "";
		// $scope.giving.G_4 = "";
		// $scope.giving.G_5 = "5";
		// $scope.cloverGivingAmount = '500';
		
		// $scope.paymentStep = 1;
		
		// $("#clover_first").show(1000);
		// $("#clover_second").hide(1000);
        // $("#show_giving_modal_clover").modal('show');
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




		
		
		
