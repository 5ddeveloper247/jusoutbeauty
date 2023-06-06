var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

	$scope.user={};
    $scope.allAdminUsers = "";
	$scope.user.ID = "";
	$scope.user.FirstName = "";
	$scope.user.LastName = "";
	$scope.user.UserRole = "";
	$scope.user.PhoneNumber = "";
	$scope.user.EmailAddress = "";
	$scope.user.Password = "";
    $scope.user.ConfirmPassword = "";
	$scope.user.Enable = "";
	$scope.allNavLinks = "";
	$scope.user.NavLinksRegistered = "";
    $scope.editView = 0;

    $scope.allNavLinks = '';
    $scope.tokenHash = $("#csrf").val();

	$scope.saveAdminUserPermission = function(){

	}

	$scope.getAllAdminUserslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminUserslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#AdminTable")) {
				$('#AdminTable').DataTable().clear().destroy();
			}
			
			$scope.allAdminUsers = data.allAdminUsers;
		
			setTimeout(function(){
				$('#AdminTable').DataTable( {
					order: [],
		            aLengthMenu: [
		                          [10, 25, 50, 100, 200, -1],
		                          [10, 25, 50, 100, 200, "All"]
		                      ]
		        } );
			}, 500);
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.getAllNavLinksLov = function(){
    	
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllNavLinksLov',
			method: "GET",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.allNavLinks = data.allNavLinks;			
			
		})
		.error(function(data, status, headers, config) {
		});
	}

    $scope.getAllAdminUserslov();
	$scope.getAllNavLinksLov();

	$scope.reset = function(){
		
		$scope.user={};
		$scope.allAdminUsers = "";
		$scope.user.ID = "";
		$scope.user.Name = "";
		$scope.user.EmailAddress = "";
		$scope.user.Password = "";
		$scope.user.ConfirmPassword = "";
		
		$("#name").val('').trigger('change');
		$("#email").val('').trigger('change');
		$("#password").val('').trigger('change');
		$("#confirmpassword").val('').trigger('change');
		
	}

	$scope.addNew = function(){
		
        $scope.user={};
        $scope.allAdminUsers = "";
		$scope.user.ID = "";
		$scope.user.FirstName = "";
		$scope.user.LastName = "";
		$scope.user.UserRole = "";
		$scope.user.PhoneNumber = "";
		$scope.user.EmailAddress = "";
		$scope.user.Password = "";
		$scope.user.ConfirmPassword = "";
		$scope.user.Enable = "";
		
		if ($.fn.DataTable.isDataTable("#AdminTable")) {
			$('#AdminTable').DataTable().clear().destroy();
		}
	
		setTimeout(function(){
			$("#AdminTable").DataTable();
		}, 500);

		$(".menu_check").prop('checked',false);
		
		$('#menu_1').prop("checked", true);
		$('#menu_1').prop("disabled", true);
		
		$scope.editView = 1;
		
	}
	$scope.backToListing = function(){
		$scope.getAllAdminUserslov();
		$scope.editView = 0;
	}

	$scope.editAdmin = function(id) {

		var data = {};
	    data.userId = id;
		$scope.user.FirstName = "";
		$scope.user.LastName = "";
		$scope.user.UserRole = "";
		$scope.user.PhoneNumber = "";
		$scope.user.EmailAddress = "";
	    
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminUser",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			// console.log(data);
			//Setting the value 
			$status = data['AdminDetail'].USER_STATUS == 'active' ? true : false ;
			$scope.user.ID = data['AdminDetail'].USER_ID;
			$scope.user.FirstName = data['AdminDetail'].FIRST_NAME;
			$scope.user.LastName = data['AdminDetail'].LAST_NAME;
			$scope.user.UserRole = data['AdminDetail'].USER_ROLE;
			$scope.user.PhoneNumber = data['AdminDetail'].PHONE_NUMBER;
			$scope.user.EmailAddress = data['AdminDetail'].EMAIL;
			$scope.user.Password = data['AdminDetail'].ENCRYPTED_PASSWORD;
    		$scope.user.ConfirmPassword = data['AdminDetail'].ENCRYPTED_PASSWORD;
			$scope.user.NavLinksRegistered = data['AdminDetail'].RegisteredLinks;
			$scope.user.Enable = $status;

			var navLinksRegistered = data['getAdminControlOptions'];

			$(".menu_check").prop('checked',false);

			$('#menu_1').prop("checked", true);
			$('#menu_1').prop("disabled", true);

			for(var i=0; i<navLinksRegistered.length ; i++){

				$("#menu_"+navLinksRegistered[i]['MENU_ID']).prop('checked',true);
			}

			setTimeout(function(){
                $("#firstname").val($scope.user.FirstName).trigger('change');
				$("#secondname").val($scope.user.LastName).trigger('change');
				$("#userrole").val($scope.user.UserRole).trigger('change');
				$("#email").val($scope.user.EmailAddress).trigger('change');
				$("#password").val($scope.user.Password).trigger('change');
				$("#confirmpassword").val($scope.user.ConfirmPassword).trigger('change');
			},500);

			$scope.editView = 1;
		})
		.error(function(data, status, headers, config) {
		});
	}
	
    $scope.saveAdminUser = function(){
		
		var data = {};
	    data.user = $scope.user;
	    data.updateduserId = $scope.user.ID;
	    
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminUser",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
                $scope.user.ID = data.id;
				//set Value to Null
				$scope.user.FirstName = "";
				$scope.user.LastName = "";
				$scope.user.UserRole = "";
				$scope.user.PhoneNumber = "";
				$scope.user.EmailAddress = "";
				$scope.user.Password = "";
				$scope.user.ConfirmPassword = "";
				$scope.user.Enable = "";

				$scope.getAllAdminUserslov();

				// $scope.editView = 0;
				
			}else{
				
				
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
			
		});
	}

	$scope.deleteAdmin = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSpecificAdmin",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminUserslov();
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.changeStatusAdmin = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusAdmin",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminUserslov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.saveAdminUserMenuControls=function(){

		if($scope.user.ID != ''){
			var menu_ids = new Array();
			i=0;
			$('div[id*=menu_list_]').each(function(){
				if($(this).find("[id*=menu_]").is(":checked")==true){
					menu_ids[i] =  $(this).find("[id*=menu_]").val();
					i++;
	 			}
	 		});
			
			if(menu_ids.length <= 0){
				toastr.error('Error : First Choose Menu Controls ', '', {timeOut: 3000});
				return ;
			}

			//Now, get the index values
			var data = {};
			data.userId = $scope.user.ID;
			data.selected_options = menu_ids;
			var temp = $.param({details: data});
			
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/menuControlOptions",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminUserslov();
				$scope.editView = 0;
				
			})
		.error(function(data, status, headers, config) {
		});
	}else{
		toastr.error("Save User Details First", '', {timeOut: 3000})
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






		
		
		
