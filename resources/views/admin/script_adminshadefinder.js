var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.option={};
	$scope.option.ID = optionId;
	$scope.option.P_1 = "";
	$scope.option.P_2 = "";
	
	$scope.level1={};
	$scope.level1.ID = "";
	$scope.level1.L_1 = "";
	$scope.level1.L_2 = "";
	
//	$scope.ingredientId = ingredientId;

//	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminShadeFinderlov = function(){
		
		var data = {};
	    data.userId = userId;
	    data.optionId = $scope.option.ID;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminShadeFinderlov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.productsLov = data.list1;
			
			
			
			$scope.option = data.optionDetail;
			if(data.level1Detail != null){
				$scope.level1 = data.level1Detail;
			}
			
//			if ($.fn.DataTable.isDataTable("#ingredientTable")) {
//				$('#ingredientTable').DataTable().clear().destroy();
//			}
//			
//			$scope.displayCollection = data.list;
//		
			setTimeout(function(){
				$("#LT1").select2({
				      placeholder: {
				          id: '-1', // the value of the option
				          text: 'Select an option'
				        }
				 });
			}, 500);
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminShadeFinderlov();
		
	
//	$scope.reset = function(){
//		$scope.ingredient={};
//		$scope.ingredient.ID = "";
//		$scope.ingredient.P_1 = "";
//		$scope.ingredient.P_2 = "";
//		$scope.ingredient.P_3 = "";
//		$scope.ingredient.P_4 = "";
//	
//		$("#p_att").html('');
//		
//		setTimeout(function(){
//			$("#quantity_in_stock").val($scope.ingredient.P_2).trigger('change');
//			$(".summernote").summernote("code", $scope.ingredient.P_4);
//		}, 500);
//		
//	}
	
	
	
	$scope.saveOptionInfo = function(){
		
		var data = {};
	    data.option = $scope.option;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderOptionInfo",
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
	
	$scope.saveShadeFinderLevel1Info = function(){
		
		var data = {};
		data.option = $scope.option;
	    data.level1 = $scope.level1;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel1Info",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.level1.ID = data.ID;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.level1Type={};
	$scope.level1Type.ID = "";
	$scope.level1Type.LT_1 = "";
	$scope.level1Type.LT_2 = "";
	
	$scope.addNewLevel1Type = function(){
	
		if($scope.level1.ID == ''){
			toastr.error('Save Level One info first, then proceed.', '', {timeOut: 3000});
			return;
		}else{
			$("#p_att").html('');
			
			setTimeout(function(){
				$(".summernote").summernote("code", '');
			}, 500);
			
			$("#addLevelOneLines_container").slideToggle("slow");
		}
	}
	$scope.closeAddNewLevel1Type = function(){
		$("#addLevelOneLines_container").slideUp("slow");
	}
	$scope.saveShadeFinderLevel1TypeInfo = function(){
		
		if($scope.level1.ID == ''){
			toastr.error('Save Level One info first, then proceed.', '', {timeOut: 3000});
			return;
		}
		if ($('#levelType_description').summernote('isEmpty')) {
			$scope.level1Type.LT_2 = '';
		}else{
			$scope.level1Type.LT_2 = $('#levelType_description').summernote('code');
		}
		
		var data = {};
		data.option = $scope.option;
		data.level1 = $scope.level1;
		data.level1Type = $scope.level1Type;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminShadeFinderLevel1TypeInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.level1.ID = data.ID;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
//	$scope.continouRecord = function(id){
//		
//		var data = {};
//	    data.recordId = id;
//	    data.userId = userId;
//    	var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+"/editAdminIngredient",
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//				
//			var details = data.details;
//			var images = data.images;
//			
//			$("#p_att").html('');
//			
//			if(details != '' && details != null){
//				
//				$scope.editView = 1;
//				$scope.ingredient.ID = details['ID'];
//				$scope.ingredient.P_1 = details['TITLE'];
//				$scope.ingredient.P_2 = details['QUANTITY'];
//				$scope.ingredient.P_3 = details['CATEGORY'];
//				$scope.ingredient.P_4 = details['DESCRIPTION'];
//				
//				setTimeout(function(){
//					$("#quantity_in_stock").val($scope.ingredient.P_2).trigger('change');
//					$(".summernote").summernote("code", $scope.ingredient.P_4);
//				}, 500);
//			}
//			
//			if(images != '' && images != null){
//				for(var i=0; i<images.length; i++){
//					
//					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
//									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
//									'<div class="overlay">'+
//										'<div class="text">'+
//											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
//											
//											if(images[i]["primFlag"] == '0'){
//												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
//											}
//											
//										html += '<div class="arrow-icon-move-box">'+
//												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
//												'<p>Move Position</p>'+
//											'</div>'+
//										'</div>'+
//									'</div>'+
//								'</div>';
//						
//						$("#p_att").append($compile(angular.element(html))($scope));
//				}
//			}
//			
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
//$scope.markPrimary = function(id){
//		
//		var data = {};
//	    data.recordId = id;
//	    data.ingredientId = $scope.ingredient.ID;
//	    data.userId = userId;
//    	var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+"/markPrimaryIngredientAttachment",
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//				
//			toastr.success(data.msg, '', {timeOut: 3000})
//			
//			var images = data.images;
//			
//			$("#p_att").html('');
//			
//			if(images != '' && images != null){
//				for(var i=0; i<images.length; i++){
//					
//					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
//									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
//									'<div class="overlay">'+
//										'<div class="text">'+
//											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
//											
//											if(images[i]["primFlag"] == '0'){
//												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
//											}
//											
//									html += '<div class="arrow-icon-move-box">'+
//												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
//												'<p>Move Position</p>'+
//											'</div>'+
//										'</div>'+
//									'</div>'+
//								'</div>';
//						
//						$("#p_att").append($compile(angular.element(html))($scope));
//				}
//			}
//			
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
//	$scope.deletePic = function(id){
//		
//		var data = {};
//	    data.recordId = id;
//	    data.ingredientId = $scope.ingredient.ID;
//	    data.userId = userId;
//    	var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+"/deleteIngredientAttachment",
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//				
//			toastr.success(data.msg, '', {timeOut: 3000})
//			
//			var images = data.images;
//			
//			$("#p_att").html('');
//			
//			if(images != '' && images != null){
//				for(var i=0; i<images.length; i++){
//					
//					var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+images[i]["ID"]+'">'+
//									'<img src="'+images[i]["downPath"]+'" alt="" class="image-box">'+
//									'<div class="overlay">'+
//										'<div class="text">'+
//											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+images[i]["ID"]+')" title="Delete Image">';
//					
//											if(images[i]["primFlag"] == '0'){
//												html += '<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+images[i]["ID"]+')" title="Mark Primary">';	
//											}
//					
//									html += '<div class="arrow-icon-move-box">'+
//												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
//												'<p>Move Position</p>'+
//											'</div>'+
//										'</div>'+
//									'</div>'+
//								'</div>';
//						
//						$("#p_att").append($compile(angular.element(html))($scope));
//				}
//			}
//			
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
//
//	$scope.statusChange = function(id){
//		
//		var data = {};
//	    data.recordId = id;
//	    data.userId = userId;
//    	var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+"/changeStatusIngredient",
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//				
//			toastr.success(data.msg, '', {timeOut: 3000})
//			$scope.getAllAdminIngredientlov();
//			
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}
//	$scope.deleteIngredient = function(id){
//		
//		var data = {};
//	    data.recordId = id;
//	    data.userId = userId;
//    	var temp = $.param({details: data});
//    	
//		$http({
//			data: temp+"&"+$scope.tokenHash,
//			url : site+"/deleteIngredient",
//			method: "POST",
//			async: false,
//			headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//
//		}).success(function(data, status, headers, config) {
//				
//			toastr.success(data.msg, '', {timeOut: 3000})
//			$scope.getAllAdminIngredientlov();
//			
//		})
//		.error(function(data, status, headers, config) {
//		});
//	}

//	$('#uploadattch').fileupload({
//		
// 		add: function (e, data) {
// 		    
// 			if($scope.ingredient.ID == ""){
// 				
// 				toastr.error('Save record first, then upload Images...', '', {timeOut: 3000})
// 				return false;
// 			
// 			}else{
// 				var jqXHR = data.submit();
// 			}
// 	    },
// 		beforeSend: function() {
//
// 		},
// 	    uploadProgress: function(event, position, total, percentComplete) {
//
// 	    },
// 	    success: function() {
//
// 	    },
// 	    complete: function(xhr) {
// 	    	
// 	    	xhr.responseText = jQuery.parseJSON(xhr.responseText);
// 	      	
// 	    	if(xhr.responseText[0] == 01){
// 	        	
// 	      		toastr.error("Error: Invalid File Format", '', {timeOut: 3000});
//
// 	      	}else if(xhr.responseText[0] == 02){
// 	        	
// 	      		toastr.error("Error : Unable To upload", '', {timeOut: 3000});
//
// 	      	}else if(xhr.responseText[0] == 03){
// 	        
// 	      		toastr.error("Error : Save record first, then upload Images...", '', {timeOut: 3000});
//
// 	      	}else{
//
// 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});
// 			    
// 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file_'+xhr.responseText[1]+'">'+
//								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
//								'<div class="overlay">'+
//									'<div class="text">'+
//										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deletePic('+xhr.responseText[1]+')" title="Delete Image">'+
//										'<img class="fa-pencil-alt" src="'+baseurl+'/images/admin/pencil-solid.svg" alt="" width="18" ng-click="markPrimary('+xhr.responseText[1]+')" title="Mark Primary">'+	
//										'<div class="arrow-icon-move-box">'+
//											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
//											'<p>Move Position</p>'+
//										'</div>'+
//									'</div>'+
//								'</div>'+
//							'</div>';
// 		  		
// 		  		$("#p_att").append($compile(angular.element(html))($scope));
//
// 	      	}
// 	   	}
// 	});
		
	
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




		
		
		
