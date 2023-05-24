var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.user = {};
	$scope.user.ID = '';
	$scope.user.A_1 = '';
	$scope.user.A_2 = '';
	$scope.user.A_3 = '';
	$scope.user.A_4 = '';
	
	$scope.password = {};
	$scope.password.C_1 = '';
	$scope.password.C_2 = '';
	$scope.password.C_3 = '';
	
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminProfilelov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminProfilelov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			var details = data.detail;
			
			$scope.user.ID = userId;
			$scope.user.A_1 = details['firstName'];
			$scope.user.A_2 = details['lastName'];
			$scope.user.A_3 = details['email'];
			$scope.user.A_4 = details['phoneNumber'];
			
			$("#phone_number").val($scope.user.A_4);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminProfilelov();
	
	$scope.updateAdminProfile = function(){
		
		var data = {};
	    data.userId = userId;
	    data.user = $scope.user;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/updateAdminProfile',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})	
			
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.updateAdminPassword = function(){
		
		var data = {};
	    data.userId = userId;
	    data.password = $scope.password;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/updateAdminPassword',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$scope.password.C_1 = '';
				$scope.password.C_2 = '';
				$scope.password.C_3 = '';
			
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
