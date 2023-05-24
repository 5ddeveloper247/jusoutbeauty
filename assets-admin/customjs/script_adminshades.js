var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.shades={};
	$scope.shades.ID = "";
	$scope.shades.P_1 = "";
	$scope.shades.P_2 = "";
	
	$scope.editView = 0;
//
	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminShadeslov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminShadeslov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			if ($.fn.DataTable.isDataTable("#shadesTable")) {
				$('#shadesTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollection = data.list;
		
			setTimeout(function(){
				$("#shadesTable").DataTable({
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
	$scope.getAllAdminShadeslov();
		
	
	$scope.reset = function(){
		$scope.shades={};
		$scope.shades.ID = "";
		$scope.shades.P_1 = "";
		$scope.shades.P_2 = "";
		$("#p_att").html('');
		$(".summernote").summernote("code", '');
	}
	
	$scope.addNew = function(){
		$scope.shades={};
		$scope.shades.ID = "";
		$scope.shades.P_1 = "";
		$scope.shades.P_2 = "";
		$("#p_att").html('');
		$(".summernote").summernote("code", '');
		
		$scope.editView = 1;
	}
	$scope.backToListing = function(){
		$scope.getAllAdminShadeslov();
		$scope.editView = 0;
	}
	$scope.saveShade = function(){
		
		if ($('.summernote').summernote('isEmpty')) {
			$scope.shades.P_2 = '';
		}else{
			$scope.shades.P_2 = $('#summernote').summernote('code');
		}
		
		var data = {};
	    data.shades = $scope.shades;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShades",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.shades.ID = data.ID;
				
				var image_div = $("#p_att").html();

				if(image_div != ''){
					$scope.getAllAdminShadeslov();
					$scope.editView = 0;
				}
				
				
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
			url : site+"/editAdminShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			var details = data.details;
			var images = data.images;
			
			$("#p_att").html('');
			
			if(details != '' && details != null){
				
				$scope.editView = 1;
				$scope.shades.ID = details['ID'];
				$scope.shades.P_1 = details['TITLE'];
				$scope.shades.P_2 = details['DESCRIPTION'];
				
				setTimeout(function(){
					$(".summernote").summernote("code", $scope.shades.P_2);
				}, 500);
			}
			
			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){
					
					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
											
											if(images[i]["primFlag"] == '0'){
												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
											}
											
										html += '<div class="arrow-icon-move-box">'+
												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
												'<p>Move Position</p>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
						
						$("#p_att").append($compile(angular.element(html))($scope));
				}
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.markPrimary = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.shadeId = $scope.shades.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/markPrimaryShadeAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			var images = data.images;
			
			$("#p_att").html('');
			
			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){
					
					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
											
											if(images[i]["primFlag"] == '0'){
												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
											}
											
									html += '<div class="arrow-icon-move-box">'+
												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
												'<p>Move Position</p>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
						
						$("#p_att").append($compile(angular.element(html))($scope));
				}
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	
	$scope.deletePic = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.shadeId = $scope.shades.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteShadeAttachment",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			var images = data.images;
			
			$("#p_att").html('');
			
			if(images != '' && images != null){
				for(var i=0; i<images.length; i++){
					
					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
					
											if(images[i]["primFlag"] == '0'){
												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
											}
					
									html += '<div class="arrow-icon-move-box">'+
												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
												'<p>Move Position</p>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
						
						$("#p_att").append($compile(angular.element(html))($scope));
				}
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.statusChange = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			$scope.getAllAdminShadeslov();
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	

	$scope.ShadeModelId = '';

	$scope.openAlertModel = function(id){
		
		$scope.ShadeModelId = id;
		$("#alertShadeDel").modal('show');

	}

	$scope.closealertDeleteModal = function(id){
		
		$("#alertShadeDel").modal('hide');
		$scope.alertDeleteMsg = '';
		$scope.ShadeModelId = '';
		
	}

	$scope.deleteShade = function(id){
		
		var data = {};
	    data.recordId = $scope.ShadeModelId;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteShade",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){

				$scope.ShadeModelId = '';
				$("#alertShadeDel").modal('hide');

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminShadeslov();
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.alertDeleteMsg = '';
	$scope.closealertDeleteModal = function(id){
		
		$("#alertDel").modal('hide');
		$scope.alertDeleteMsg = '';
		
	}

	$('#uploadattch').fileupload({
		
 		add: function (e, data) {
 		    
 			if($scope.shades.ID == ""){
 				
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
 	        
 	      		toastr.error("Error : Image dimensions must be minimum 24 X 24", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});
 			    
 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+xhr.responseText[1]+')" title="Delete Image">'+
										'<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+xhr.responseText[1]+')" title="Mark Primary">'+	
										'<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
											'<p>Move Position</p>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
 		  		
 		  		$("#p_att").append($compile(angular.element(html))($scope));
				   $scope.$apply(() => {
 		        		  
					$scope.getAllAdminShadeslov();
					$scope.editView = 0;
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




		
		
		
