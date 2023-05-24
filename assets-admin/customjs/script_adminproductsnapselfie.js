var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.selfi = {};
	$scope.selfi.ID = "";
	$scope.selfi.name = "";
	$scope.selfi.email = "";
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminProductSnapSelfielov = function(){
		
		var data = {};
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminProductSnapSelfielov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#snapselfieTable")) {
				$('#snapselfieTable').DataTable().clear().destroy();
			}
			console.log('selfie');
			console.log(data.productselfi);
			$scope.displayCollectionSnapselfie = data.productselfi;
			
			setTimeout(function(){
				$("#snapselfieTable").DataTable({
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

	 $scope.getAllAdminProductSnapSelfielov();

	 $scope.deleteselfiemodal= function(id){

		$('#selfieid').val('');
		$('#selfieid').val(id);

		$('#alertDel').modal('show');

	 }

	 $scope.deletespecificselfie = function(){
	
		var data = {};
	    data.productSelfiID =$('#selfieid').val();

		var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/deletespecificselfie',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			if(data.done == true){
				toastr.success(data.message, '', {timeOut: 3000})
				$scope.getAllAdminProductSnapSelfielov();
				$('#alertDel').modal('hide');
				$('#selfieid').val('');

			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteSelectedSelfi= function(id){
		var data = {};

		data.productSelectedSelfiID = id;

		var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/deletSelectedSelfie',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			// $('#selfiemodal').modal('hide');
			 $('.img_remove_'+data.id).remove();

			$scope.getAllAdminProductSnapSelfielov();
		})
		.error(function(data, status, headers, config) {
		});
	}


	$scope.getspecifiselfie = function(id){
	
		var data = {};
		$scope.selfies={};
	    data.productSelfiID = id;

		var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/get_selfies',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			if(data == ''){
				toastr.error('No Selfies Exist', '', {timeOut: 3000})
			}else {
				
					$scope.selfies = data;
					  
					// for (var i=0; i<data.length; i++){
	
					// 	var html = '<div class="col-2  margin-r1 img_remove" id="img_file_'+data["ID"]+'">'+
					// 	'<img src="'+data["DOWNPATH"]+'" alt="" class="image-box">'+
					// 	'<div class="overlay">'+
					// 		   '</div>'+
					// 	   '</div>';
					//  }
	
					//  $("#img_file").append($compile(angular.element(html))($scope));
					 $('#selfiemodal').modal('show');
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.changeStatus = function(productSelfiID){
	
		var data = {};
	    data.productSelfiID = productSelfiID;

		var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/ChangeAdminProductSnapSelfieStatus',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})	
			
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}

			$scope.getAllAdminProductSnapSelfielov();
		})
		.error(function(data, status, headers, config) {
		});
	}

	$('#uploadatt6').fileupload({
		
		add: function (e, data) {
			
			if($scope.selfi.ID == ""){
				
				toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
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
			
				  toastr.error("Error : Save Basic Info first, then upload Images...", '', {timeOut: 3000});

			  }else if(xhr.responseText[0] == 04){
			
				  toastr.error("Error : Image dimensions must be minimum 270 X 370", '', {timeOut: 3000});

			  }else{

				  toastr.success("Image Upload Successfully", '', {timeOut: 3000});
				
				  var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
							   '<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
							   '<div class="overlay">'+
								   '<div class="text">'+
									   '<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteProductImage('+xhr.responseText[1]+')" title="Delete Image">'+
									   '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimaryProdImage('+xhr.responseText[1]+')" title="Mark Primary">'+	
									   '<div class="arrow-icon-move-box">'+
										   '<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
										   '<p>Move Position</p>'+
									   '</div>'+
								   '</div>'+
							   '</div>'+
						   '</div>';
				  
				  $("#p_att").append($compile(angular.element(html))($scope));

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
