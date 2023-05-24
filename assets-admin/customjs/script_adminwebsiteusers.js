var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminWebsiteUserslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminWebsiteUserslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#usersTable")) {
				$('#usersTable').DataTable().clear().destroy();
			}
		
			$scope.displayCollectionUsers = data.list;
			
			setTimeout(function(){
				$("#usersTable").DataTable({
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
	$scope.getAllAdminWebsiteUserslov();
	
	$scope.changeStatusWebsiteUser = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusWebsiteUser",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminWebsiteUserslov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.firstName = '';
	$scope.lastName = '';
	$scope.email = '';
	$scope.phoneNumber = '';
	$scope.registrationDate = '';
	$scope.status = '';
	
	$scope.viewWebsiteUserDetail = function(id){

		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/getSpecificWebsiteUserDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.detail;
			$scope.firstName = details['firstName'];
			$scope.lastName = details['lastName'];
			$scope.email = details['email'];
			$scope.phoneNumber = details['phoneNumber'];
			$scope.registrationDate = details['date'];
			$scope.status = details['status1'];
			
			$scope.editView = 1;
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.backToListing = function(){
		
		$scope.editView = 0;
		$scope.firstName = '';
		$scope.lastName = '';
		$scope.email = '';
		$scope.phoneNumber = '';
		$scope.registrationDate = '';
		$scope.status = '';
		
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
