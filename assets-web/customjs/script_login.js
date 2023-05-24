var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

   
	$scope.store = {};
	$scope.store.A_1 = '';
	$scope.store.A_2 = '';
	$scope.store.A_3 = '';
	$scope.store.A_4 = '';
	$scope.store.A_5 = '';
	$scope.store.A_6 = '';
	$scope.store.A_7 = false;
	$scope.tokenHash = $("#csrf").val();
		
	$scope.zakana = function(){
		if($("#termsOfUse1").is(':checked')){
			$scope.store.A_7 = '1';
	
		}else{

			$scope.store.A_7 = '0';
		}
		var data = {};
		data.reg = $scope.store; 
		var temp = $.param({details: data});
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/UserReg',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data) {
			
			if(data.done == true  || data.done == 'true'){
				
				toastr.success(data.msg, 'Account Created Successfully!', {timeOut: 3000})
	            $scope.store.A_1 = '';
	            $scope.store.A_2 = '';
	            $scope.store.A_3 = '';
	            $scope.store.A_4 = '';
	            $scope.store.A_5 = '';
	            $scope.store.A_6 = '';
	            $(".show").addClass('d-none');
	            
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
    
		})
	}
	
	$scope.resetpass = {};
	$scope.resetpass.R_1 = '';
		
	$scope.resetPass = function(){
		
		$scope.resetpass.R_1 = '';
		$('#reset_email').show();
		$('#otp_num').hide();
		$('#reset_pass_form').hide();

		$('#user_otp').val('');
		$('#resetPassword_modal').modal('show');
		
	}
	$scope.cpass = {};
	$scope.cpass.C_1 = '';
	$scope.cpass.C_2 = '';
	$scope.cpass.C_3 = '';

	$scope.validatePassword = function(){
		var data = {};
		$scope.cpass.C_1 = $('#user_con_id').val();

		if($scope.cpass != undefined){
			data.vpass = $scope.cpass;
		}
		 
		let password_reset = $("#password_reset").val();
		let con_password_reset = $("#con_password_reset").val();

		if(password_reset == '' || con_password_reset == ''){
			toastr.error(data.msg, 'Please fill both fields!', {timeOut: 3000});
			return;
		}

		if(password_reset != con_password_reset){
			toastr.error(data.msg, 'Password Does not Match!', {timeOut: 3000});
			return;
		}

		var temp = $.param({details: data});
		$http({
			data: temp,//+"&"+$scope.tokenHash,
			url : site+'/UserValidatePass',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data) {
			if(data.done == true ){
				
				toastr.success(data.msg, '', {timeOut: 3000})

				$('#resetPassword_modal').modal('hide');
				$('#reset_email').show();
				$('#otp_num').hide();
				$('#reset_pass_form').show();
				$('#otp_num').hide();
				$('#user_con_id').val('');
				$('#user_otp').val('');
				$('#reset_email').val('');
				
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
    
		})
	}

	$scope.votp = {};
	$scope.votp.V_1 = '';
	$scope.votp.V_2 = '';
	$scope.votp.V_3 = '';
	$scope.votp.V_4 = '';
	$scope.votp.V_5 = '';
	$scope.votp.V_6 = '';
	$scope.votp.V_7 = '';


	$scope.validateOTP = function(){
		var data = {};

		$scope.votp.V_7 = $('#user_otp').val();

		if($scope.votp != undefined){
			data.otp = $scope.votp;
		}
		 

		var temp = $.param({details: data});
		$http({
			data: temp,//+"&"+$scope.tokenHash,
			url : site+'/UserValidateOTP',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data) {
			if(data.done == true ){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$('#reset_email').hide();
				$('#otp_num').hide();
				$('#reset_pass_form').show();
				$('#otp_num').hide();
				$('#user_con_id').val(data.user_id_otp);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
    
		})
	}

	$scope.reset = {};
	$scope.reset.R_3 = '';

	$scope.resetPassFunction = function(){
		
		var data = {};
		data.res = $scope.reset; 

		let check_email = $("#reset_user_pass").val();

		if(check_email == ''){
			toastr.error(data.msg, 'Please Enter Register Email!', {timeOut: 3000});
			return;
		}
		
		var temp = $.param({details: data});
		$http({
			data: temp,//+"&"+$scope.tokenHash,
			url : site+'/UserResetPass',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data) {
			if(data.done == true ){
				
				toastr.success(data.msg, '', {timeOut: 3000})

				$('#user_otp').val(data.user_id_otp);
				$('#reset_email').hide();
				$('#otp_num').show();
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
    
		})
	}
	
	$scope.resetPasswordStep1 = function(){
		
		var data = {};
		data.resetpass = $scope.resetpass; 
		var temp = $.param({details: data});
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/UserReg',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data) {
			if(data.message == true ){
				
				toastr.success(data.msg, 'Account Created Successfully!', {timeOut: 3000})
	            $scope.store.A_1 = '';
	            $scope.store.A_2 = '';
	            $scope.store.A_3 = '';
	            $scope.store.A_4 = '';
	            $scope.store.A_5 = '';
	            $scope.store.A_6 = '';
	            $(".show").addClass('d-none');
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
    
		})
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