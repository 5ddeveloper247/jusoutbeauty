var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$compile,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});

//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});
	
	$scope.bundle={};
	$scope.bundle.ID = "";
	$scope.bundle.P_1 = "";		//Name
	$scope.bundle.P_2 = "";		//Sub Title
	$scope.bundle.P_3 = "";		//Unit
	$scope.bundle.P_4 = "";		//Minimum Purchase Qty
	$scope.bundle.P_5 = "";		//Tags
	$scope.bundle.P_6 = "";		//Barcode
	$scope.bundle.P_7 = true;	//Refundable
	$scope.bundle.P_8 = "";		//Category
	$scope.bundle.P_9 = "";		//Sub Category
	$scope.bundle.P_10 = "";	//Slug
	$scope.bundle.P_11 = "";	//Sub Sub Category
	$scope.bundle.P_12 = "";	//VAT Rate
	$scope.bundle.P_13 = "";	//Total Amount
	$scope.bundle.P_14 = "";	//Short Description
	$scope.bundle.P_15 = "";	//Discounted Amount
	$scope.bundle.P_16 = "";	//Inv. Quantity
	$scope.bundle.image = '';	//bundle image
	
	$scope.editView = 0;

	$scope.tokenHash = $("#csrf").val();
	
	$scope.getAllAdminProductBundlelov = function(){
		
		var data = {};
	    data.userId = userId;
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllAdminProductBundlelov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.categoryLov = data.list1;
			$scope.productsLov = data.list2;
			$scope.subCategoryLov = {};
			if ($.fn.DataTable.isDataTable("#bundlesTable")) {
				$('#bundlesTable').DataTable().clear().destroy();
			}
			
			$scope.displayCollection = data.list;
		
			setTimeout(function(){
				$('#bundlesTable').DataTable( {
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
	$scope.getAllAdminProductBundlelov();
		
	$scope.reset = function(){
		$scope.bundle={};
		$scope.bundle.ID = "";
		$scope.bundle.P_1 = "";		//Name
		$scope.bundle.P_2 = "";		//Sub Title
		$scope.bundle.P_3 = "";		//Unit
		$scope.bundle.P_4 = "";		//Minimum Purchase Qty
		$scope.bundle.P_5 = "";		//Tags
		$scope.bundle.P_6 = "";		//Barcode
		$scope.bundle.P_7 = true;	//Refundable
		$scope.bundle.P_8 = "";		//Category
		$scope.bundle.P_9 = "";		//Sub Category
		$scope.bundle.P_10 = "";	//Slug
		$scope.bundle.P_11 = "";	//Sub Sub Category
		$scope.bundle.P_12 = "";	//VAT Rate
		$scope.bundle.P_13 = "";	//Total Amount
		$scope.bundle.P_14 = "";	//Short Description
		$scope.bundle.P_15 = "";	//Discounted Amount
		$scope.bundle.P_16 = "";	//Inv. Quantity
		$scope.bundle.image = '';	//bundle image
		
		$("#p4").val('').trigger('change');
		$("#p8").val('').trigger('change');
		$("#p9").val('').trigger('change');
		$("#p11").val('').trigger('change');
	}
	
	$scope.addNew = function(){
		
		$scope.bundle={};
		$scope.bundle.ID = "";
		$scope.bundle.P_1 = "";		//Name
		$scope.bundle.P_2 = "";		//Sub Title
		$scope.bundle.P_3 = "";		//Unit
		$scope.bundle.P_4 = "";		//Minimum Purchase Qty
		$scope.bundle.P_5 = "";		//Tags
		$scope.bundle.P_6 = "";		//Barcode
		$scope.bundle.P_7 = true;	//Refundable
		$scope.bundle.P_8 = "";		//Category
		$scope.bundle.P_9 = "";		//Sub Category
		$scope.bundle.P_10 = "";	//Slug
		$scope.bundle.P_11 = "";	//Sub Sub Category
		$scope.bundle.P_12 = "";	//VAT Rate
		$scope.bundle.P_13 = "";	//Total Amount
		$scope.bundle.P_14 = "";	//Short Description
		$scope.bundle.P_15 = "";	//Discounted Amount
		$scope.bundle.P_16 = "";	//Inv. Quantity
		$scope.bundle.image = '';	//bundle image
		
		$("#p4").val('').trigger('change');
//		$("#p8").val('').trigger('change');
//		$("#p9").val('').trigger('change');
//		$("#p11").val('').trigger('change');
		
//		$scope.product = {};
		$scope.subCategoryLov = {};
		$scope.subSubCategoryLov = {};
		
		$scope.editView = 1;
	}
	$scope.backToListing = function(){
		$scope.getAllAdminProductBundlelov();
		$scope.editView = 0;
	}
	$scope.saveProductBundleBasic = function(){
		
		var data = {};
	    data.bundle = $scope.bundle;
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminBundleProductBasicInfo",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.bundle.ID = data.ID;
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.continouRecord = function(id){
		
		var data = {};
	    data.bundleId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/editAdminBundleProduct",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.details != '' && data.details != null){
				
				if ($.fn.DataTable.isDataTable("#productsTable")) {
					$('#productsTable').DataTable().clear().destroy();
				}
				
				$scope.editView = 1;
				$scope.bundle = data.details;
				$scope.subCategoryLov = data.subCategory;
				$scope.subSubCategoryLov = data.subSubCategory;

				$scope.displayCollectionProducts = data.bundleLines;
				
				setTimeout(function(){
					$("#productsTable").DataTable({
						order: [],
			            aLengthMenu: [
			                          [10, 25, 50, 100, 200, -1],
			                          [10, 25, 50, 100, 200, "All"]
			                      ]
					});
				}, 500);
				
				setTimeout(function(){
					$("#p4").val($scope.bundle.P_4).trigger('change');
					$("#p8").val($scope.bundle.P_8).trigger('change');
					$("#p9").val($scope.bundle.P_9).trigger('change');
					$("#p11").val($scope.bundle.P_11).trigger('change');
				}, 500);
			}
		})
		.error(function(data, status, headers, config) {
		});
	}

	$scope.deleteBundleImage = function(id){
		
		var data = {};
	    data.bundleId = $scope.bundle.ID;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBundleProductImage",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			toastr.success(data.msg, '', {timeOut: 3000})
			
			$scope.bundle.image = '';
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	$scope.product = {};
	$scope.product.ID = '';
	$scope.product.P_1 = '';
	
	$scope.addProduct = function(){
		
		if($scope.bundle.ID != ''){
			
			$scope.product = {};
			$scope.product.ID = '';
			$scope.product.P_1 = '';
			
			$("#bp1").val($scope.product.P_1).trigger('change');
			$("#productsModal").modal('show');
		
		}else{
			toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
		}
	}
	$scope.closeProductModal = function(){
		
		$scope.product = {};
		$scope.product.ID = '';
		$scope.product.P_1 = '';
		$("#bp1").val($scope.product.P_1).trigger('change');
		$('#productsModal').modal('hide');
	}
	
	$scope.saveBundleProductLine = function(){
		
		if($scope.bundle.ID == ''){
			toastr.error('Save Basic Info first, then upload Images...', '', {timeOut: 3000})
			return;
		}

		var data = {};
	    data.bundleId = $scope.bundle.ID;
	    data.product = $scope.product;
	    data.userId = userId;
	    
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash, 
			url : site+"/saveAdminBundleProductLine",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				
				$scope.closeProductModal();
				$scope.continouRecord($scope.bundle.ID);
				
				// if ($.fn.DataTable.isDataTable("#productsTable")) {
				// 	$('#productsTable').DataTable().clear().destroy();
				// }
				
				$scope.getAllAdminProductBundlelov();

				// $scope.displayCollectionProducts = data.bundleLines;
				
				// setTimeout(function(){
				// 	$("#productsTable").DataTable({
				// 		order: [],
			    //         aLengthMenu: [
			    //                       [10, 25, 50, 100, 200, -1],
			    //                       [10, 25, 50, 100, 200, "All"]
			    //                   ]
				// 	});
				// }, 500);
				
			}else{
				toastr.error(data.msg, '', {timeOut: 3000})
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.deleteBundleLine = function(id){
		
		var data = {};
	    data.bundleId = $scope.bundle.ID;
	    data.bundleLineId = id;
	    data.userId = userId;
    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteBundleProductLine",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){
				
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.continouRecord($scope.bundle.ID);
				
			}else{
			
				$scope.alertDeleteMsg = data.msg;
				$("#alertDel").modal('show');
			}
			
			
		})
		.error(function(data, status, headers, config) {
		});
	}

	
$scope.getSubCategoriesWrtCategory = function(){
		console.log($scope.bundle.P_8);
		if($scope.bundle.P_8 != null){
			var data = {};
		    data.category = $scope.bundle.P_8;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubCategoriesWrtCategory1",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.subCategoryLov = data.subCategory;
				
			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subCategoryLov = {};
		}
	}
	$scope.getSubSubCategoriesWrtSubCategory = function(){
		
		if($scope.bundle.P_9 != null){
			var data = {};
		    data.subcategory = $scope.bundle.P_9;
		    data.userId = userId;
		    
	    	var temp = $.param({details: data});
	    	
			$http({
				data: temp+"&"+$scope.tokenHash,
				url : site+"/getSubSubCategoriesWrtSubCategory",
				method: "POST",
				async: false,
				headers: {'Content-Type': 'application/x-www-form-urlencoded'}

			}).success(function(data, status, headers, config) {
					
				$scope.subSubCategoryLov = data.subSubCategory;
				
			})
			.error(function(data, status, headers, config) {
			});
		}else{
			$scope.subSubCategoryLov = {};
		}
	}
	
	$scope.changeStatusBundle = function(id){
		
		var data = {};
	    data.recordId = id;
	    data.userId = userId;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/changeStatusBundle",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			if(data.done == true || data.done == 'true'){
				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminProductBundlelov();

			}else{
				toastr.error(data.msg, '', {timeOut: 3000});
			}
		})
		.error(function(data, status, headers, config) {
			

		});
	}

	$scope.alertDeleteMsg = '';
	$scope.BundleModelId = '';

	$scope.openAlertModel = function(id){
		
		$scope.BundleModelId = id;
		$("#alertBundleDel").modal('show');

	}

	$scope.closeBundleDeleteModal = function(id){
		$("#alertBundleDel").modal('hide');
		$scope.alertDeleteMsg = '';
		$scope.BundleModelId = '';
		
	}

	$scope.deleteBundle = function(id){
		
		var data = {};
	    data.recordId = $scope.BundleModelId;
	    data.userId = userId;

    	var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+"/deleteSpecificBundle",
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
				
			if(data.done == true || data.done == 'true'){

				$("#alertBundleDel").modal('hide');
				$scope.BundleModelId = '';

				toastr.success(data.msg, '', {timeOut: 3000})
				$scope.getAllAdminProductBundlelov();
				
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
	
	$('#uploadattch').fileupload({
		
 		add: function (e, data) {
 		    
 			if($scope.bundle.ID == ""){
 				
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
 	        
 	      		toastr.error("Error : Image dimension must be minimum 270 X 370", '', {timeOut: 3000});

 	      	}else{

 		  		toastr.success("Image Upload Successfully", '', {timeOut: 3000});
 			    
 		  		$scope.$apply(function() {
 		  			$scope.bundle.image = xhr.responseText[2];
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




		
		
		
