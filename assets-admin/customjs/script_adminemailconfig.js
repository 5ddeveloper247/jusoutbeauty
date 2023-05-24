var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {


	
	$scope.email = {};
	$scope.email.ID = '';
	$scope.email.A_1 = '';
	$scope.email.A_2 = '';
	$scope.email.A_3 = '';
	$scope.email.A_4 = '';
	$scope.email.A_5 = '';
	$scope.email.path = '';
	$scope.email.downpath = '';
	
	
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminEmailConfiglov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminEmailConfiglov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#emailConfigTable")) {
				$('#emailConfigTable').DataTable().clear().destroy();
			}
		
			$scope.displayCollectionEmailConfig = data.list;
			
			setTimeout(function(){
				$("#emailConfigTable").DataTable({
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
	$scope.getAllAdminEmailConfiglov();
	
	
	$scope.backToListing = function(){
		
		$scope.editView = 0;
		$scope.getAllAdminEmailConfiglov();
		
		$scope.email = {};
		$scope.email.ID = '';
		$scope.email.A_1 = '';
		$scope.email.A_2 = '';
		$scope.email.A_3 = '';
		$scope.email.A_4 = '';
		$scope.email.A_5 = '';
		$scope.email.path = '';
		$scope.email.downpath = '';
		
		
	}
	
	$scope.saveEmailConfigurations = function(){
		
		if ($('#message_description').summernote('isEmpty')) {
			$scope.email.A_4 = '';
		}else{
			$scope.email.A_4 = $('#message_description').summernote('code');
		}
		
		var data = {};
	    data.userId = userId;
	    data.email = $scope.email;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/saveEmailConfigDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000});
				$scope.editView = 0;
				$scope.getAllAdminEmailConfiglov();
				
			}else{
				
				toastr.error(data.msg, '', {timeOut: 3000})
				
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.continueRecord = function(id){
		
		var data = {};
	    data.userId = userId;
	    data.recordId = id;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/editEmailConfigDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.email = data.detail;
			
			$("#message_description").summernote("code", $scope.email.A_4);
			
			$scope.editView = 1;
		
		})
		.error(function(data, status, headers, config) {
		});
	}	
	
	$('#uploadattch').fileupload({
		
 		add: function (e, data) {
 		    
 			if($scope.email.ID == ""){
 				
 				toastr.error('Save record first, then upload Images...', '', {timeOut: 3000})
 				return false;
 			
 			}else{
 				
 				$.LoadingOverlay("show"); 
 				
 				var jqXHR = data.submit();
 			}
 	    },
 		beforeSend: function() {

 		},
 	    uploadProgress: function(event, position, total, percentComplete) {

 	    },
 	    success: function() {

 	    },
 	    complete: function(xhr) {

 	    	setTimeout(function(){
				$.LoadingOverlay("hide");
			}, 500);
 	    	
 	    	xhr.responseText = jQuery.parseJSON(xhr.responseText);
 	      	
 	    	if(xhr.responseText[0] == 01){
 	        	
 	      		toastr.error("Error: Invalid File Format", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 02){
 	        	
 	      		toastr.error("Error : Unable To upload", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 03){
 	        
 	      		toastr.error("Error : Save record first, then upload Images...", '', {timeOut: 3000});

 	      	}else if(xhr.responseText[0] == 04){
 	        
 	      		toastr.error("Error : Logo dimension must be minimum 170 X 70", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Logo Upload Successfully", '', {timeOut: 3000});
 			    
 		  		$scope.$apply(function () {

 		  			$scope.email.downpath = xhr.responseText[2];
 		  			
 		  		});
 		  		
 		  	}
 	   	}
 	});
	
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
