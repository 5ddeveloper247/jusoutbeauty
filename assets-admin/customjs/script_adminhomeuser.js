var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

	
	$scope.banner={};
	$scope.banner.ID = "";
	$scope.banner.B_1 = "";
	$scope.banner.B_2 = "";
	$scope.banner.B_3 = "";
	$scope.banner.B_4 = "";
	$scope.banner.B_5 = "";
	$scope.banner.B_6 = "";
	
	
	
	$scope.tokenHash = $("#csrf").val();

	$scope.getAllAdminHomeUserlov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminHomeUserlov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.productLov = data.products;
			$scope.categoryLov  = data.categories;
			
			var banners = data.banners;
			var bestExc = data.bestExc;

			if ($.fn.DataTable.isDataTable("#trendingTable")) {
				$('#trendingTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#foryouTable")) {
				$('#foryouTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#todayofferTable")) {
				$('#todayofferTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollectionTrendingList = data.trending;
			$scope.displayCollectionForyouList = data.foryou;
			$scope.displayCollectionOffersList = data.offers;
			
			setTimeout(function(){
				$("#trendingTable").DataTable();
				$("#foryouTable").DataTable();
				$("#todayofferTable").DataTable();
			}, 500);
			
			if(banners != null){
				
				for(var i=0; i<banners.length; i++){
					
					var id = banners[i]['BANNER_ID'];
					var imgDpath = banners[i]['IMAGE_DOWNPATH'];
					var imgpath = banners[i]['IMAGE_PATH'];
					
					$("#b_title_"+id).val(banners[i]['TITLE']);
					$("#b_btntext_"+id).val(banners[i]['BUTTON_TEXT']);
					$("#b_btnlink_"+id).val(banners[i]['BUTTON_LINK']);
					$("#b_description_"+id).val(banners[i]['DESCRIPTION']);
					$("#b_imageDownPath_"+id).val(imgDpath);
					$("#b_imagePath_"+id).val(imgpath);
					
					
					var html = '<div class="col-2 image-overlay margin-r1" id="img_file">'+
									'<img src="'+imgDpath+'" alt="" class="image-box">'+
									'<div class="overlay">'+
										'<div class="text">'+
											'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteHomeBannerImage('+id+')" title="Delete Image">'+
											'<div class="arrow-icon-move-box">'+
												'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
												'<p>Move Position</p>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
						
					$("#p_att_"+id).html($compile(angular.element(html))($scope));
				}
			}
			
			setTimeout(function(){
				if(bestExc != null){
					for(var i=0; i<bestExc.length; i++){
						
						var id = bestExc[i]['BESTEXC_ID'];
						var imgDpath = bestExc[i]['IMAGE_DOWNPATH'];
						var imgpath = bestExc[i]['IMAGE_PATH'];
						
						$("#bs_title_"+id).val(bestExc[i]['TITLE']);
						$("#bs_heading_"+id).val(bestExc[i]['HEADING']);
						$("#bs_product_"+id).val(bestExc[i]['PRODUCT_ID']);
						$("#bs_imageDownPath_"+id).val(imgDpath);
						$("#bs_imagePath_"+id).val(imgpath);
						
						var html = '<div class="col-2 image-overlay margin-r1" id="img_file">'+
										'<img src="'+imgDpath+'" alt="" class="image-box">'+
										'<div class="overlay">'+
											'<div class="text">'+
												'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteHomeBestExcImage('+id+')" title="Delete Image">'+
												'<div class="arrow-icon-move-box">'+
													'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
													'<p>Move Position</p>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>';
							
							$("#p_att_bs_"+id).html($compile(angular.element(html))($scope));
					}
				}
			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.getAllAdminHomeUserlov();
	
	$scope.saveHeadertabsData = function(id){
		
		$scope.banner.ID = id;
		$scope.banner.B_1 = $("#b_title_"+id).val();
		$scope.banner.B_2 = $("#b_btntext_"+id).val();
		$scope.banner.B_3 = $("#b_btnlink_"+id).val();
		$scope.banner.B_4 = $("#b_description_"+id).val();
		$scope.banner.B_5 = $("#b_imageDownPath_"+id).val();
		$scope.banner.B_6 = $("#b_imagePath_"+id).val();
		
		if($scope.banner.B_3 != ''){
			var isUrl1 = /^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/gm.test($scope.banner.B_3);
		    if(!isUrl1) {
		      toastr.error('Enter valid url in Button Link',"", {timeOut: 1500,});return false;
		    }
		}
		
		var data = {};
	    data.banner = $scope.banner;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminHomeUserPageBanner",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.bestexc={};
	$scope.bestexc.ID = "";
	$scope.bestexc.B_1 = "";
	$scope.bestexc.B_2 = "";
	$scope.bestexc.B_3 = "";
	$scope.bestexc.B_4 = "";
	$scope.bestexc.B_5 = "";
	
	$scope.saveBestSellerExclusiveDetail = function(id){
		
		$scope.bestexc.ID = id;
		$scope.bestexc.B_1 = $("#bs_title_"+id).val();
		$scope.bestexc.B_2 = $("#bs_heading_"+id).val();
		$scope.bestexc.B_3 = $("#bs_product_"+id).val();
		$scope.bestexc.B_4 = $("#bs_imageDownPath_"+id).val();
		$scope.bestexc.B_5 = $("#bs_imagePath_"+id).val();
		
		var data = {};
	    data.bestexc = $scope.bestexc;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminHomeUserBestExc",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.deleteHomeBannerImage = function(bannerId){
		
		var data = {};
	    data.bannerId = bannerId;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/deleteHomeBannerImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
				$("#p_att_"+bannerId).html('');
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.deleteHomeBestExcImage = function(bestexcId){
		
		var data = {};
	    data.bestexcId = bestexcId;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/deleteHomeBestExcImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
				$("#p_att_bs_"+bestexcId).html('');
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.trending={};
	$scope.trending.ID = "";
	$scope.trending.T_1 = "";
	$scope.trending.T_2 = "";
	
	
	$scope.getproductsfromcategory = function(){
		
		if($scope.trending.T_1 != null){
			var data = {};
		    data.categoryId = $scope.trending.T_1.id;
		    data.userId = userId;
		   
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash, 
				url : site+"/getproductlovfromcategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.categoryProductLov = data.productLov;

			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.categoryProductLov = {};
		}
		
	}

	$scope.saveTrendingProduct = function(){
		
		var data = {};
	    data.trending = $scope.trending;
	    data.code = 'trending';
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveTrendingProductDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				$scope.trending={};
				$scope.trending.ID = "";
				$scope.trending.T_1 = "";
				$scope.trending.T_2 = "";
				
				$scope.categoryProductLov = {};
				
				if ($.fn.DataTable.isDataTable("#trendingTable")) {
					$('#trendingTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionTrendingList = data.list;
				
				setTimeout(function(){
					$("#trendingTable").DataTable();
				}, 500);
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	
	$scope.getproductsfromcategory1 = function(){
		
		if($scope.trending1.T_1 != null){
			var data = {};
		    data.categoryId = $scope.trending1.T_1.id;
		    data.userId = userId;
		   
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash, 
				url : site+"/getproductlovfromcategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.categoryProductfyLov = data.productLov;

			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.categoryProductfyLov = {};
		}
	}
	
	$scope.trending1={};
	$scope.trending1.ID = "";
	$scope.trending1.T_1 = "";
	$scope.trending1.T_2 = "";
	
	$scope.saveForyouProduct = function(){
		
		var data = {};
	    data.trending = $scope.trending1;
	    data.code = 'foryou';
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveTrendingProductDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				$scope.trending1={};
				$scope.trending1.ID = "";
				$scope.trending1.T_1 = "";
				$scope.trending1.T_2 = "";
				
				$scope.categoryProductfyLov = {};
				
				if ($.fn.DataTable.isDataTable("#foryouTable")) {
					$('#foryouTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionForyouList = data.list;
				
				setTimeout(function(){
					$("#foryouTable").DataTable();
				}, 500);
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.removeSectionRecord = function(sectionId){
		
		var data = {};
		data.sectionId = sectionId;
	    data.userId = userId;
		   
    	var temp = $.param({details: data});
	    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/deleteSectionRecord",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
					
			toastr.success(data.msg, '', {timeOut: 3000});
			
			if ($.fn.DataTable.isDataTable("#trendingTable")) {
				$('#trendingTable').DataTable().clear().destroy();
			}
			if ($.fn.DataTable.isDataTable("#foryouTable")) {
				$('#foryouTable').DataTable().clear().destroy();
			}
			
			
			$scope.displayCollectionTrendingList = data.trending;
			$scope.displayCollectionForyouList = data.foryou;
			
			setTimeout(function(){
				$("#trendingTable").DataTable();
				$("#foryouTable").DataTable();
			}, 500);

		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.offer={};
	$scope.offer.ID = "";
	$scope.offer.T_1 = "";
	$scope.offer.T_2 = "";
	$scope.offer.T_3 = "";
	$scope.offer.T_4 = "";
	$scope.offer.T_5 = "";
	
	$scope.getproductsfromcategory2 = function(){
		
		if($scope.offer.T_2 != null){
			var data = {};
		    data.categoryId = $scope.offer.T_2.id;
		    data.userId = userId;
		   
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash, 
				url : site+"/getproductlovfromcategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.categoryProductOfferLov = data.productLov;

			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.categoryProductOfferLov = {};
		}
	}
	
	$scope.resetOfferForm = function(){
		$scope.offer={};
		$scope.offer.ID = "";
		$scope.offer.T_1 = "";
		$scope.offer.T_2 = "";
		$scope.offer.T_3 = "";
		$scope.offer.T_4 = "";
		$scope.offer.T_5 = "";
		
		$scope.categoryProductOfferLov = {};
	}
	$scope.saveTodayofferDetails = function(){
		
		var data = {};
	    data.offer = $scope.offer;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveTodayofferDetails",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			
			if(data.done == true || data.done == 'true'){
				
				$scope.offer={};
				$scope.offer.ID = "";
				$scope.offer.T_1 = "";
				$scope.offer.T_2 = "";
				$scope.offer.T_3 = "";
				$scope.offer.T_4 = "";
				$scope.offer.T_5 = "";
				
				$scope.categoryProductOfferLov = {};
				
				if ($.fn.DataTable.isDataTable("#todayofferTable")) {
					$('#todayofferTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionOffersList = data.list;
				
				setTimeout(function(){
					$("#todayofferTable").DataTable();
				}, 500);
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.editOffer = function(offerId){
		
		var data = {};
	    data.offerId = offerId;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/editOfferRecord",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			$scope.categoryProductOfferLov = data.productLov;
			
			$scope.offer = data.details;

		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.removeOffer = function(offerId){
		
		var data = {};
	    data.offerId = offerId;
	    data.userId = userId;
	   
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/deleteOfferRecord",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				

			if(data.done == true || data.done == 'true'){
			
				if ($.fn.DataTable.isDataTable("#todayofferTable")) {
					$('#todayofferTable').DataTable().clear().destroy();
				}
				
				$scope.displayCollectionOffersList = data.list;
				
				setTimeout(function(){
					$("#todayofferTable").DataTable();
				}, 500);
				
				toastr.success(data.msg, '', {timeOut: 3000});
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}

		})
		.error(function(data, status, headers, config) {
		});
	}

	$('#uploadattch').fileupload({
		
 		add: function (e, data) {
 		    
 			$.LoadingOverlay("show"); 
 			
 			var jqXHR = data.submit();
 			
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
 	        
 	      		toastr.error("Error : Image dimension must be minimum 1170 X 880", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});
 			    
 		  		var sourceId = $("#sourceId").val();
 			    
 		  		$("#b_imageDownPath_"+sourceId).val(xhr.responseText[2]);
 		  		$("#b_imagePath_"+sourceId).val(xhr.responseText[3]);
 		  		
 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteHomeBannerImage('+sourceId+')" title="Delete Image">'+
										'<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
											'<p>Move Position</p>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					
					$("#p_att_"+sourceId).html($compile(angular.element(html))($scope));
					
 		  	}
 	   	}
 	});
	
	$('#uploadattch1').fileupload({
		
 		add: function (e, data) {
 		    
 			$.LoadingOverlay("show"); 
 			
 			var jqXHR = data.submit();
 			
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
 	        
 	      		toastr.error("Error : Image dimension must be minimum 630 X 580", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});
 			    
 		  		var sourceId = $("#sourceId1").val();
 			    
 		  		$("#bs_imageDownPath_"+sourceId).val(xhr.responseText[2]);
 		  		$("#bs_imagePath_"+sourceId).val(xhr.responseText[3]);
 		  		
 		  		var html = '<div class="col-2 image-overlay margin-r1" id="img_file">'+
								'<img src="'+xhr.responseText[2]+'" alt="" class="image-box">'+
								'<div class="overlay">'+
									'<div class="text">'+
										'<img class="fa-trash-alt" src="'+baseurl+'/images/admin/trash.svg" alt="" width="18" ng-click="deleteHomeBestExcImage('+sourceId+')" title="Delete Image">'+
										'<div class="arrow-icon-move-box">'+
											'<img class="arrow-center" src="'+baseurl+'/images/admin/feather-move.svg" alt="">'+
											'<p>Move Position</p>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>';
					
					$("#p_att_bs_"+sourceId).html($compile(angular.element(html))($scope));
					
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




		
		
		
