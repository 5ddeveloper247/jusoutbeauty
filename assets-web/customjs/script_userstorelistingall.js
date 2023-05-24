var myApp = angular.module('project1',["smart-table"], function(){});
myApp.controller('projectinfo1',function($scope,$rootScope,$timeout,$http,$window,$filter,$q,$routeParams) {

//	$(document).on('click','.addNew',function(){
//	    $('#addCity_modal').modal('show');return false; 
//	});
//
//	$(document).on('click','.modalClose',function(){
//	    $('#addCity_modal').modal('hide');return false; 
//	});

	$(document).on("click", ".shadeAccord-btn", function () {
		var i = $(this).attr('data-id');
		$("#chooseShade_container_"+i).slideToggle('slow');
		
	});

	$(document).on('click','.shade_filter',function(){
		$(".shade_filter").removeClass('shade-active');
    	$(this).addClass('shade-active');
	});
	
	
	
//	$scope.sourceId = sourceId;
//	$scope.flag = flag;
	
//	if(subCategoryName == 'Bundles' || subCategoryName == 'Bundle'){
//		$scope.catFlag = 'Bundle';
//		$scope.productType = 'bundle';
//	}else{
		$scope.catFlag = '';
		$scope.productType = 'single';
//	}
	
	
	$scope.tokenHash = $("#csrf").val();

	$scope.quickView_name = '';
	$scope.bundleProductNames = '';
	$scope.category_name = '' ;
	$scope.subCategory_name = '' ;
	$scope.unit_price = '' ;
	$scope.short_description = '' ;
	$scope.productImagesLoop = '';
	$scope.productImagesBundle = '';
	$scope.displayCollectionBundleProductShadesQuickView = '';
	$scope.displayCollectionProductShadesQuickView = '';
	$scope.ProductShadesNameQuickView = '';

	$scope.resetQuickviewPopup = function(){
		$scope.prodShadeId = '';
        $scope.shadeId = '';
        $scope.productId = '';
        $scope.selectedShadeName = '';
        $scope.selectedShadeImg_p = '';
        $scope.selectedShadeImg_s = '';
        
        $scope.subs_id = '';
        
        $("#prodShadeId").val('');
    	$("#shadeId").val('');
    	$("#shadeName").val('');
    	$("#productId").val('');
        
    	$("input [id*=shadeId_]").val('');
    	$("input [id*=prodShadeId_]").val('');
    	$("input [id*=productId_]").val('');
    	$("input [id*=shadeName_]").val('');
    	$("input [id*=shadeName1_]").text('');
    	
    	$("#chooseShade_container_1").slideUp('slow');
    	$("div [id*=chooseShade_container_]").slideUp('slow')
    	
    	$("#single-sub").click();
	}

	$scope.quickViewProductDetails = function(productId){

		var data = {};
	    data.productId = productId;

	    data.productType = $scope.productType;
	    
	    var temp = $.param({details: data});

		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getQuickViewProductDetails',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {

			$scope.subscriptionLov = data.subscriptions;
			
			if($scope.productType == 'bundle'){
				
				var product_details = data.productDetails;
				var bundleLines = data.bundleLines;
				var product_shades_details = data.shades;

				if(product_details != null && product_details != ''){
					
					console.log(product_details);
					console.log(product_shades_details);
					
					$scope.QuickView_productId = product_details['BUNDLE_ID']; 
					$scope.QuickView_name = product_details['NAME']; 
					$scope.unit_price = product_details['DISCOUNTED_AMOUNT'];
					$scope.short_description = product_details['SHORT_DESCRIPTION'] ;
					$scope.productImagesBundle = product_details['primaryImage'];
					
					if(bundleLines != '' && bundleLines != null){
						for(var i=0; i<bundleLines.length; i++){
							if(i==0){
								$scope.bundleProductNames = bundleLines[i]['NAME'];
							}else{
								$scope.bundleProductNames = $scope.bundleProductNames +' | '+ bundleLines[i]['NAME'];
							}
						}
					}

					$scope.displayCollectionBundleProductShadesQuickView = product_shades_details;
				}
				
				$scope.resetQuickviewPopup();
		        
				$("#productQuickView").modal('show');
				
			}else{
				
				var product_details = data.productDetails;
				var product_shades_details = data.shades;

				if(product_details != null && product_details != ''){
					
					$scope.QuickView_productId = product_details['PRODUCT_ID']; 
					$scope.QuickView_name = product_details['NAME']; 
					$scope.category_name = product_details['CATEGORY_NAME'];
					$scope.subCategory_name = product_details['SUB_CATEGORY_NAME'];
					$scope.unit_price = product_details['UNIT_PRICE'];
					$scope.short_description = product_details['SHORT_DESCRIPTION'] ;
					$scope.productImagesLoop = product_details['images'];

					$scope.displayCollectionProductShadesQuickView = product_shades_details;
				}
				
				$scope.resetQuickviewPopup();
		        
				$("#productQuickView").modal('show');
			}
		})
		.error(function(data, status, headers, config) {
		});
	}
	 	
	$scope.chooseBundleProdShade = function(lineId, prodShadeId, shadeId, productId, shadeName, primaryImg, secondaryImg){
    	
    	$("#shadeId_"+lineId).val(shadeId);
    	$("#prodShadeId_"+lineId).val(prodShadeId);
    	$("#productId_"+lineId).val(productId);
    	$("#shadeName_"+lineId).val(shadeName);
    	$("#shadeName1_"+lineId).text(shadeName);
    	
    	$("#bundleLineShadeImg_"+lineId).attr('src', primaryImg);
    	$("#bundleLineShadeImg_"+lineId).show();
    	
    }
    $scope.confirmBundleProductShade = function(lineId){
    	
    	if($("#prodShadeId_"+lineId).val() != ''){
    		
        	$("#chooseShade_container_"+lineId).slideUp('slow');
        	
    	}else{
    		toastr.error('Please choose shade first...', '', {timeOut: 3000})
    	}
    }
    
	$scope.chooseProdShade = function(prodShadeId, shadeId, productId, shadeName, primaryImg, secondaryImg){
    	
    	$scope.prodShadeId = prodShadeId;
        $scope.shadeId = shadeId;
        $scope.productId = productId;
        $scope.selectedShadeName = shadeName;
        $scope.selectedShadeImg_p = primaryImg;
        $scope.selectedShadeImg_s = secondaryImg;
    
	}
	
	$scope.confirmProductShade = function(){
    	
    	if($scope.prodShadeId != ''){
    		$("#prodShadeId").val($scope.prodShadeId);
        	$("#shadeId").val($scope.shadeId);
        	$("#shadeName").val($scope.selectedShadeName);
        	$("#productId").val($scope.productId);
        	
        	$("#chooseShade_container_1").slideUp('slow');
        	
    	}else{
    		toastr.error('Please choose shade first...', '', {timeOut: 3000})
    	}
    }
    
    $scope.subs_id = '';
    	
	$(document).on("click", "#single-sub", function () {
		
//		$scope.$apply(function () {
			$scope.subs_id = '';
			$scope.subscriptionDetails = '';
			$scope.subscriptionNote1 = '';
			$scope.subscriptionNote2 = '';
//		});
	});
	
	$scope.showSubscrptionDetailModal = function(){
		if($scope.subscriptionDetails != '' && $("#subsOption").val() != ''){
			$('#learnmore_pop').modal('show');
		}else{
			toastr.error('Choose subscription first...', '', {timeOut: 3000})
		}
	}
	$scope.hideSubscrptionDetailModal = function(){
		$('#learnmore_pop').modal('hide');
	}
    $scope.fetchSubscriptionDetail = function(){
		
		var subscriptionId = $("#subsOption").val();
		
		var data = {};
	    data.userId = userId;
	    data.subscriptionId = subscriptionId; 
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getSpecificSubscriptionDetail',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			var detail = data.details;
			
			if(detail != '' && detail != null){
				
				$scope.subscriptionDetails = detail['S_10'];
				$scope.subscriptionNote1 = detail['S_5'];
				$scope.subscriptionNote2 = detail['S_6'];
				
			}else{
				$scope.subscriptionDetails = '';
				$scope.subscriptionNote1 = '';
				$scope.subscriptionNote2 = '';
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	
    $scope.lowerlimit = 0;
    $scope.hideLoadMore = 0;
    
	$scope.getAllUserStoreListingAllLov = function(){
		
		$scope.lowerlimit = 0;
		var data = {};
	    data.userId = userId;
	    data.lowerlimit = $scope.lowerlimit;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getAllUserStoreListingAllLov',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.displayCollectionProducts = data.products;
			
			$scope.displayCollectionShadeFilter = data.list1;
			
			$scope.displayCollectionSubCategoryFilter = data.list2;
			
			$scope.lowerlimit = $scope.lowerlimit + data.list2.length;
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	$scope.loadMoreSubCategoriesFilter = function(){
		
		var data = {};
	    data.userId = userId;
	    data.lowerlimit = $scope.lowerlimit;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/loadMoreSubCategoriesFilter',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			var catFilterArr = data.list2;
			
			$scope.displayCollectionSubCategoryFilter = $scope.displayCollectionSubCategoryFilter.concat(catFilterArr)
			
			$scope.lowerlimit = $scope.lowerlimit + catFilterArr.length;
			
			if(data.list2.length < 10){
				$scope.hideLoadMore = 1;
			}
			
		})
		.error(function(data, status, headers, config) {
		});
	}
	
	
	$scope.getAllUserStoreListingAllLov();

	$scope.search = {};
    $scope.search.subsubcategory = '';
    $scope.search.shadeId = '';
    $scope.search.price = 'all'; 
    
    $scope.resetFilter = function(){
    	$scope.search = {};
        $scope.search.subsubcategory = '';
        $scope.search.shadeId = '';
        $scope.search.price = 'all'; 
        $scope.search.sortingType = '';  // 1=>for price high to low , 2=>for price low to high , 3=> for random
        
        $(".category-filter").prop('checked', false);
        $(".shade_filter").removeClass('shade-active');
        $("#allPricing").prop('checked', true);
        
        $scope.filter();
    }
    
    $scope.shadeFilter = function(shadeId){
    	$scope.search.shadeId = shadeId;
    	$scope.filter();
    }

    $scope.sortingFilter = function(type){
    	$scope.search.sortingType = type;
    	$scope.filter();
    }
    
	$scope.filter = function(){
		
		var number1 = new Array(); 
		var i =0;
		$('li[id*=categoryFilter_]').each(function(){
			if($(this).find("input[id*=categoryFilterInput_]").is(":checked")==true){
				number1[i] =  $(this).find("input[id*=categoryFilterInput_]").val();
				i++;
			}
		});
		$scope.search.subsubcategory = number1;
		
		$scope.search.price = $('input[name="price"]:checked').val();
		
		var data = {};
	    data.userId = userId;
	    data.search = $scope.search;
	    
	    var temp = $.param({details: data});
    	
		$http({
			data: temp+"&"+$scope.tokenHash,
			url : site+'/getUserSearchStoreListingAll',
			method: "POST",
			async: false,
			headers: {'Content-Type': 'application/x-www-form-urlencoded'}

		}).success(function(data, status, headers, config) {
			
			$scope.displayCollectionProducts = data.products;
			
			setTimeout(function(){
				if($('.filter-sidebarr').is(':visible')){
					$(".productshop-listing").removeClass("col-xl-3");
		 			$(".productshop-listing").addClass("col-xl-4");
		 		}else{
					$(".productshop-listing").removeClass("col-xl-4");
		 			$(".productshop-listing").addClass("col-xl-3");
		 		}
				
			}, 500);
			
		})
		.error(function(data, status, headers, config) {
		});
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




		
		
		
