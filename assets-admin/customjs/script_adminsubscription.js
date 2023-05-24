var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

	$(document).on('click','.addNew',function(){
	    $('#addCity_modal').modal('show');return false; 
	});

	$(document).on('click','.modalClose',function(){
	    $('#addCity_modal').modal('hide');return false; 
	});
	
	$scope.subscription={};
	$scope.subscription.ID = "";
	$scope.subscription.S_1 = "";
	$scope.subscription.S_2 = "";
	$scope.subscription.S_3 = "";
	$scope.subscription.S_4 = "";
	$scope.subscription.S_5 = "";
	$scope.subscription.S_6 = "";
	$scope.subscription.S_7 = "";
	$scope.subscription.S_8 = "";
	$scope.subscription.S_9 = "";
	$scope.subscription.S_10 = "";
	
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminSubscriptionlov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminSubscriptionlov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			
			if ($.fn.DataTable.isDataTable("#subscriptionTable")) {
				$('#subscriptionTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionSubscription = data.list;
			
			setTimeout(function(){
				$("#subscriptionTable").DataTable({
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
	$scope.getAllAdminSubscriptionlov();
		
	
	// For delete subs
	$scope.deleteRecord = function(id){

		var data = {};
	    data.recordId = id;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/deleteAdminSubscription",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminSubscriptionlov();	
			$scope.editView = 0;
			
		})
		.error(function(data, status, headers, config) {
		});
	}		


	$scope.addNew = function(){
		
		$scope.subscription={};
		$scope.subscription.ID = "";
		$scope.subscription.S_1 = "";
		$scope.subscription.S_2 = "";
		$scope.subscription.S_3 = "";
		$scope.subscription.S_4 = "";
		$scope.subscription.S_5 = "";
		$scope.subscription.S_6 = "";
		$scope.subscription.S_7 = "";
		$scope.subscription.S_8 = "";
		$scope.subscription.S_9 = "";
		$scope.subscription.S_10 = "";
		
		$scope.editView = 1;
	}
	$scope.backToListing = function(){
		$scope.editView = 0;
	}
	
	
	$scope.saveSubscription = function(){
		
		var data = {};
	    data.subscription = $scope.subscription;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminSubscription",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$scope.subscription.ID = data.ID;
				
				if ($.fn.DataTable.isDataTable("#subscriptionTable")) {
					$('#subscriptionTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionSubscription = data.list;
				$scope.editView = 0;
				setTimeout(function(){
					$("#subscriptionTable").DataTable({
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

	$scope.continouRecord = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/editAdminSubscription",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			$scope.subscription = data.details;
			
			$("#s2").val($scope.subscription.S_2);
			$("#s7").val($scope.subscription.S_7);
			$("#s8").val($scope.subscription.S_8);
			$("#s9").val($scope.subscription.S_9);
			
			$scope.editView = 1;
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.changeStatusSubscription = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusSubscription",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			if ($.fn.DataTable.isDataTable("#subscriptionTable")) {
				$('#subscriptionTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionSubscription = data.list;
			
			setTimeout(function(){
				$("#subscriptionTable").DataTable({
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




		
		
		
