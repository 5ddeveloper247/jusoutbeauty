var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

	
	$scope.user={};
    // $scope.allAdminUsers = "";
	$scope.user.ID = "";
	$scope.user.Name = "";
	$scope.user.Email = "";
	$scope.user.Password = "";
    $scope.user.ConfirmPassword = "";
    $scope.editView = 0;

	

	$scope.tokenHash = $("#csrf").val();
	
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
            console.log($scope.allAdminUsers);
		
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
	$scope.getAllAdminUserslov();
		
	$scope.reset = function(){
		
        $scope.user={};
        $scope.allAdminUsers = "";
	    $scope.user.ID = "";
	    $scope.user.Name = "";
	    $scope.user.Email = "";
	    $scope.user.Password = "";
        $scope.user.ConfirmPassword = "";
		
		$("#name").val('').trigger('change');
		$("#email").val('').trigger('change');
		$("#password").val('').trigger('change');
		$("#confirmpassword").val('').trigger('change');
		
	}

	$scope.quickAddProduct = function(){
		var data = {};
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminQuickProductBasicInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				console.log(data.id);
				toastr.success(data.msg, '', {timeOut: 3000})
				$('#productID').val(data.id);

				setTimeout(function(){
					$('#quickProductdetilsForm').submit();
				}, 500);

				
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.addNew = function(){
		
        $scope.user={};
        $scope.allAdminUsers = "";
	    $scope.user.ID = "";
	    $scope.user.Name = "";
	    $scope.user.Email = "";
	    $scope.user.Password = "";
        $scope.user.ConfirmPassword = "";
		
		if ($.fn.DataTable.isDataTable("#AdminTable")) {
			$('#AdminTable').DataTable().clear().destroy();
		}
	
		setTimeout(function(){
			$("#AdminTable").DataTable();
		}, 500);
		
		$scope.editView = 1;
		
	}
	$scope.backToListing = function(){
		$scope.getAllAdminUserslov();
		$scope.editView = 0;
	}

	$scope.editAdmin = function(id) {

		var data = {};
	    data.userId = id;
	    
    	var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminUser",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			//Setting the value 
			$scope.user.ID = data.USER_ID;
			$scope.user.Name = data.USER_NAME;
			$scope.user.Email = data.EMAIL;
			$scope.user.Password = data.ENCRYPTED_PASSWORD;
    		$scope.user.ConfirmPassword = data.ENCRYPTED_PASSWORD;

			setTimeout(function(){
                $("#name").val($scope.user.Name).trigger('change');
				$("#email").val($scope.user.Email).trigger('change');
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
                $scope.user.ID = data.ID;
				//set Value to Null
				$scope.user.Name = "";
				$scope.user.Email = "";
				$scope.user.Password = "";
    			$scope.user.ConfirmPassword = "";
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
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
	
	$scope.tempProId = '';
	$scope.markProdImagePriSec = function(id){
		
		$scope.tempProId = id;
		// $("#shadesModal").modal('hide');
		$("#confirmProdImageModal").modal('show');
	}
	$scope.closeProdImageModal = function(id){
		$scope.tempProId = '';
		// $("#shadesModal").modal('show');
		$("#confirmProdImageModal").modal('hide');
	}
	
	$scope.deleteProductShade = function(id){
		
		var data = {};
	    data.productId = $scope.product.ID;
	    data.productShadeId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteProductShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			if ($.fn.DataTable.isDataTable("#productShadesTable")) {
				$('#productShadesTable').DataTable().clear().destroy();
			}
				
			$scope.displayCollectionProdShades = data.shades;
			
			setTimeout(function(){
				$("#productShadesTable").DataTable();
			}, 500);
			
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.addNewUses = function(){
		
		$scope.uses={};
		$scope.uses.ID = "";
		$scope.uses.U_1 = "";
		$scope.uses.U_2 = "";
		$scope.uses.U_3 = "";
		$scope.uses.U_4 = "";
		$("#u1").val($scope.uses.U_1).trigger('change');
		
		$("#usesStepsModal").modal("show");
	}
	
	$scope.saveProductUses = function(){
		
		if($scope.product.ID == ''){
			toastr.error("Save Product Info first, then proceed...", '', {timeOut: 3000})
			return;
		}
		
		var data = {};
	    data.product = $scope.product;
	    data.uses = $scope.uses;
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminProductUses",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$scope.uses.ID = data.ID;
				
				if ($.fn.DataTable.isDataTable("#productUsesTable")) {
					$('#productUsesTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionProdUses = data.productuses;
			
				setTimeout(function(){
					$("#productUsesTable").DataTable();
				}, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.editProductUses = function(id){
		
		var data = {};
	    data.productUsesId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editProductUses",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.details != '' && data.details != null){
				
				$scope.uses = data.details;
				$("#usesStepsModal").modal('show');
				setTimeout(function(){
					$("#u1").val($scope.uses.U_1).trigger('change');
				}, 500);
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.alertDeleteMsg = '';
	
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
	
	$scope.closealertDeleteModal = function(id){
		
		$("#alertDel").modal('hide');
		$scope.alertDeleteMsg = '';
		
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






		
		
		
